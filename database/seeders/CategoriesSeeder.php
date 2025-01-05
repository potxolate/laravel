<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create(['name' => 'Fertilizantes']);
        Category::create(['name' => 'Aditivos']);
        Category::create(['name' => 'Estimuladores']);
        Category::create(['name' => 'Raíces']);
        Category::create(['name' => 'Packs y kits']);
        Category::create(['name' => 'Control de plagas']);
        Category::create(['name' => 'Nutrientes']);
        Category::create(['name' => 'Reguladores de pH']);
        Category::create(['name' => 'Iluminación']);
        Category::create(['name' => 'Bombillas']);
        Category::create(['name' => 'Balastros']);
        Category::create(['name' => 'Accesorios Iluminación']);
        Category::create(['name' => 'Reflectores y Pantallas']);
        Category::create(['name' => 'Relés']);
        Category::create(['name' => 'Equipos']);
        Category::create(['name' => 'Temporizadores']);
        Category::create(['name' => 'Led']);
        Category::create(['name' => 'Lec']);
        Category::create(['name' => 'Armarios de cultivo e Invernaderos']);
        Category::create(['name' => 'Armarios de Cultivo']);
        Category::create(['name' => 'Invernaderos']);
        Category::create(['name' => 'Control del clima']);
        Category::create(['name' => 'Extractores']);
        Category::create(['name' => 'Soporte Extractor']);
        Category::create(['name' => 'Conductos de Aire']);
        Category::create(['name' => 'Caja insonorizada']);
        Category::create(['name' => 'Complementos Extractor']);
        Category::create(['name' => 'Co2']);
        Category::create(['name' => 'Filtros Anti Olor']);
        Category::create(['name' => 'Humidificación']);
        Category::create(['name' => 'Equipos Controladores']);
        Category::create(['name' => 'Ventiladores']);
        Category::create(['name' => 'Accesorios']);
        Category::create(['name' => 'Filtros de Aire']);
        Category::create(['name' => 'Acoples y Reductores']);
        Category::create(['name' => 'Bandejas y Macetas']);
        Category::create(['name' => 'Cosecha']);
        Category::create(['name' => 'Peladoras']);
        Category::create(['name' => 'Polen y Resinas']);
        Category::create(['name' => 'Tijeras para podar']);
        Category::create(['name' => 'Secaderos']);
        Category::create(['name' => 'Envasado']);
        Category::create(['name' => 'Neutralización de Olores']);
        Category::create(['name' => 'Ambientadores']);
        Category::create(['name' => 'Ozonizadores']);
        Category::create(['name' => 'Sustratos']);
        Category::create(['name' => 'Sustratos Tierra']);
        Category::create(['name' => 'Sustratos Coco']);
        Category::create(['name' => 'Sustratos Hidro']);
        Category::create(['name' => 'Humus de lombríz']);
        Category::create(['name' => 'Pastillas Germinación']);
        Category::create(['name' => 'Varios']);
        Category::create(['name' => 'Herramientas y accesorios']);
        Category::create(['name' => 'Sistemas de Cultivo']);
        Category::create(['name' => 'Sistemas Hidropónicos']);
        Category::create(['name' => 'Sistemas Aeropónicos']);
        Category::create(['name' => 'Propagadores de esquejes']);
        Category::create(['name' => 'Accesorios para Sistemas de Cultivo']);
        Category::create(['name' => 'Medición']);
        Category::create(['name' => 'Dosificadores']);
        Category::create(['name' => 'Báscula']);
        Category::create(['name' => 'Temperatura y Humedad']);
        Category::create(['name' => 'Medidores Ec - pH - Lux']);
        Category::create(['name' => 'Microscopios']);
        Category::create(['name' => 'Riego']);
        Category::create(['name' => 'Pulverizadores']);
        Category::create(['name' => 'Bombas']);
        Category::create(['name' => 'Kits de riego']);
        Category::create(['name' => 'Accesorios']);
        Category::create(['name' => 'Depósitos']);
        Category::create(['name' => 'Mangueras']);
    }
}
