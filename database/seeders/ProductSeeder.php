<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $product->slug = Str::slug($product->name);
            if (Product::where('slug', Str::slug($product->name))->exists()) {                
                $product->slug .= (string)$product->id;
            }            
            $product->save();
        }
    }
}