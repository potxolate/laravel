<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use Exception;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';

    protected $fillable = [
        'product_id',
        'url',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtener el precio desde la URL del enlace.
     *
     * @return float|null
     */
    public function getPriceFromUrl(): ?float
    {
        try {
            // Extraer el precio de la URL
            $url = $this->url;
            
            $domainToPriceClass = [
                'www.amazon.es'=>'.aok-offscreen',                
                // Add more domain-class pairs as needed
            ];

            // Inicializar GuzzleHttp Client
            $client = new Client();
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();

            // Utilizar Symfony DomCrawler para analizar el HTML
            $crawler = new Crawler($html);

            // Obtener el dominio de la URL
            $parsedUrl = parse_url($url);
            $domain = $parsedUrl['host'];

            if (isset($domainToPriceClass[$domain])) {
                $priceClass = $domainToPriceClass[$domain];
                $priceElement = $crawler->filter($priceClass)->first();
                $priceText = $priceElement->text();
            } else {
                // Select the desired span element using CSS selector
                $priceElement = $crawler->filter('span[itemprop="price"]')->first();
                // Extract the price text from the content attribute
                $priceText = $priceElement->attr('content');
            }
            
            return floatval($priceText);

        } catch (Exception $e) {
            // Registrar el error de forma adecuada (por ejemplo, en un archivo de log)
            Log::error('Error al obtener el precio desde la URL: ' . $e->getMessage());
    
            return null;
        }
    }
    public function getDominioAttribute()
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

}
