<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        TipoDocumento::create(['nombre' => 'Factura', 'descripcion' => 'Documento fiscal', 'estado' => 1]);
        TipoDocumento::create(['nombre' => 'Boleta', 'descripcion' => 'Venta al por menor', 'estado' => 1]);
    }
}
