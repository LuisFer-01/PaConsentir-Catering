<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            PermisoSeeder::class,
            DetallePermisoSeeder::class,
            CategoriaSeeder::class,
            UndMedidaSeeder::class,
            TipoDocumentoSeeder::class,
            TipoPagoSeeder::class,
            ProveedorSeeder::class,
            ClienteSeeder::class,
            MenuSeeder::class,
            PlatoSeeder::class,
            PlatoImgSeeder::class,
            ProductoSeeder::class,
            ProductoImgSeeder::class,
            StockSeeder::class,
            RecetaSeeder::class,
            UserSeeder::class,
            HprProductoSeeder::class,
            CompraSeeder::class,
            DetalleCompraSeeder::class,
            VentaSeeder::class,
            DetalleVentaSeeder::class,
            PagoSeeder::class,
            InventarioSeeder::class,
            TransaccionSeeder::class,
        ]);
    }
}
