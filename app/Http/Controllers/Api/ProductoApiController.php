<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoResource;
use App\Mail\StockBajoMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ProductoCreado;
use App\Models\User;


class ProductoApiController extends Controller
{

    // GET /api/productos
    public function index()
    {
        return ProductoResource::collection(Producto::paginate(10));
    }

    // GET /api/productos/{id}
    public function show($id)
{
    $producto = Producto::findOrFail($id);
    return new ProductoResource($producto);
}
    // POST /api/productos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string'
        ]);

        $producto = Producto::create($request->all());

        return (new ProductoResource($producto))
                ->response()
                ->setStatusCode(201);
                $producto = Producto::create($request->all());

$admins = User::where('rol', 'admin')->get();

foreach ($admins as $admin) {
    $admin->notify(new ProductoCreado($producto));
}
    }

    // PUT /api/productos/{id}
public function update(Request $request, Producto $producto)
{
    $producto->update($request->all());

    // 🔥 AQUÍ EL ENVÍO
   try {
    Mail::to('admin@uptex.edu.mx')
        ->send(new StockBajoMail($producto));

    return response()->json(['mensaje' => 'correo enviado']);
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()]);
}

    return new ProductoResource($producto);
}

    // DELETE /api/productos/{id}
    public function destroy($id)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    return response()->json([
        'message' => 'Producto eliminado correctamente'
    ]);
}
}