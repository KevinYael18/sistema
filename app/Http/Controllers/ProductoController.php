<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use App\Events\ProductoGuardado;
use App\Jobs\GenerarReporteCsv;

class ProductoController extends Controller
{
    // 🔥 LISTADO
    public function index()
    {
        // ✅ Evita errores si no hay relación
        $productos = Producto::with('categoria')->get();

        return view('productos.index', compact('productos'));
    }

    // 🔥 FORM CREAR
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // 🔥 GUARDAR
   public function store(Request $request)
{
    // 1. VALIDACIÓN (primero)
    $data = $request->validate([
        'nombre' => 'required|string|max:100',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpg,png,webp|max:2048'
    ]);

    // 2. AUTORIZACIÓN (después)
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403);
    }

    try {
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                ->store('productos', 'public');
        }

        $producto = Producto::create($data);

        event(new ProductoGuardado($producto, 'creado', auth()->user()));

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente');

    } catch (\Exception $e) {
        return back()->with('error', 'Error al crear producto');
    }
}
    // 🔥 EDITAR
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // 🔥 ACTUALIZAR
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        try {

            if ($request->hasFile('imagen')) {

                if ($producto->imagen) {
                    Storage::disk('public')->delete($producto->imagen);
                }

                $data['imagen'] = $request->file('imagen')
                    ->store('productos', 'public');
            }

            $producto->update($data);

            if (auth()->check()) {
                event(new ProductoGuardado($producto, 'actualizado', auth()->user()));
            }

            return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    // 🔥 ELIMINAR
    public function destroy(Producto $producto)
    {
        try {

            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $producto->delete();

            if (auth()->check()) {
                event(new ProductoGuardado($producto, 'eliminado', auth()->user()));
            }

            return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    // 🔥 PDF
    public function exportPdf()
    {
        $productos = Producto::with('categoria')
            ->orderBy('nombre')
            ->limit(100)
            ->get();

        $pdf = Pdf::loadView('reportes.productos-pdf', compact('productos'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('productos-' . now()->format('Ymd') . '.pdf');
    }

    // 🔥 EXCEL
    public function exportExcel()
    {
        return Excel::download(
            new ProductosExport(),
            'productos-' . now()->format('Ymd') . '.xlsx'
        );
    }

    // 🔥 CSV (JOB)
    public function exportarCsv(Request $request)
    {
        $filtro = $request->input('search') ?? '';

        if (auth()->check()) {
            GenerarReporteCsv::dispatch(auth()->user(), $filtro)
                ->onQueue('reportes');
        }

        return back()->with('success', 'El reporte se está generando. Recibirás un correo.');
    }
}