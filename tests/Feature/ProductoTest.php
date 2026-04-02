<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'rol' => 'admin',
        ]);
    }

    // ✅ PASO 3
    public function test_puede_ver_listado_de_productos(): void
    {
        Producto::factory(5)->create();

        $response = $this->actingAs($this->admin)
            ->get(route('productos.index'));

        $response->assertStatus(200);
        $response->assertSee('Productos');
    }

    public function test_admin_puede_crear_producto(): void
    {
        $data = Producto::factory()->make()->toArray();

        $response = $this->actingAs($this->admin)
            ->post(route('productos.store'), $data);

        $response->assertRedirect(route('productos.index'));

        $this->assertDatabaseHas('productos', [
            'nombre' => $data['nombre']
        ]);
    }

    // ✅ PASO 4
    public function test_no_puede_crear_producto_sin_nombre(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('productos.store'), [
                'precio' => 100
            ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_usuario_normal_no_puede_crear_producto(): void
    {
        $user = User::factory()->create([
            'rol' => 'user',
        ]);

        $data = Producto::factory()->make()->toArray();

        $response = $this->actingAs($user)
            ->post(route('productos.store'), $data);

        $response->assertStatus(403);
    }
}