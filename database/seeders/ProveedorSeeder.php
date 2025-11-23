<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            'Distribuidora El Sabor', 'Mercado Central', 'AgroInsumos Valencia', 'Lácteos Los Andes', 'Coca Cola Venezuela'
        ];
        foreach ($proveedores as $i => $prov) {
            Proveedor::create([
                'nombre' => $prov,
                'contacto' => 'Contacto ' . ($i + 1),
                'telefono' => '0414' . rand(1000000, 9999999),
                'email' => strtolower(str_replace(' ', '', $prov)) . '@gmail.com',
                'direccion' => 'Valencia, Carabobo',
                'estado' => 1
            ]);
        }
    }
}
