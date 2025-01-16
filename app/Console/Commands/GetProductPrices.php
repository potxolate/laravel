<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;

class GetProductPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-product-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $links = Link::all(); // Obtiene todos los registros de la tabla 'links'

        foreach ($links as $link) {
            
            $link->update(['price' => $link->getPriceFromUrl()]);
            
        }
    }
}
