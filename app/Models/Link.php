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
            $priceText = $this->extractPriceFromUrl();
            return $this->parsePriceText($priceText);
        } catch (Exception $e) {
            Log::error($this->url.' - Error al obtener el precio desde la URL: ' . $e->getMessage());
            return null;
        }
    }

    protected function extractPriceFromUrl(): string
    {
        $domainToPriceSelector = $this->loadPriceSelectors();
        $parsedUrl = parse_url($this->url);
        $domain = $parsedUrl['host'];
        
        $priceSelector = $domainToPriceSelector[$domain] ?? 'span[itemprop="price"]';
        
        Log::info($domain.' -- This is some useful information. -- '.$priceSelector);
        $html = $this->fetchHtmlFromUrl();
        $crawler = new Crawler($html);        

        if ($priceSelector == 'span[itemprop="price"]'){
            $priceElement = $crawler->filterXPath('//span[@itemprop="price"]');
            return $priceElement->attr('content');            

        }else{
            $priceElement = $crawler->filter($priceSelector)->first();
            return $priceElement->text();
        }           

    }    

    protected function loadPriceSelectors(): array
    {        
        $config = json_decode(file_get_contents('price_selectors.json'), true);
        return $config;
    }

    protected function fetchHtmlFromUrl(): string
    {
        $client = new Client();
        $response = $client->request('GET', $this->url);
        return $response->getBody()->getContents();
    }

    protected function parsePriceText(string $priceText): float
    {
        $priceText = preg_replace('/[^0-9,.]/', '', $priceText);
        return floatval(str_replace(',', '.', $priceText));
    }
    
    public function getDominioAttribute()
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

}
