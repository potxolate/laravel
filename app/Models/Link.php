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
        $domainToPriceSelector = $this->loadDomainToPriceSelectorConfig();
        $parsedUrl = parse_url($this->url);
        $domain = $parsedUrl['host'];
        Log::info('Entramos al dominio -'.$domain);
        if (isset($domainToPriceSelector[$domain])) {
            $priceSelector = $domainToPriceSelector[$domain];
        } else {
            // Selector por defecto si el dominio no está en la configuración
            $priceSelector = 'span[itemprop="price"]';
        }
        
        Log::info($domain.'This is some useful information.'.$priceSelector);
        $html = $this->fetchHtmlFromUrl();
        $crawler = new Crawler($html);
        $priceElement = $crawler->filter($priceSelector)->first();

        if ($priceSelector == 'span[itemprop="price"]'){
            return $priceElement->attr('content');
        }else{
            return $priceElement->text();
        }
            

    }

    protected function loadDomainToPriceSelectorConfig(): array
    {
        // Aquí puedes cargar la configuración desde un archivo JSON o cualquier otra fuente de datos
        // Por ejemplo:
        // $config = json_decode(file_get_contents('domain_to_price_selector.json'), true);
        // return $config;

        // Por ahora, un array estático:
        return [
            'tecnocultivo.es' => '.current-price-value',
            'www.amazon.es' => '.aok-offscreen',
            'elcultivar.com' => '.preciocombinacion',
            'servovendi.com' => 'meta[itemprop="price"]',
            'eurogrow.es' => '.our_price_display',
            'sologrow.es' => '.current-price-value',
            'www.lahuertagrowshop.com' => '.att-precio-final',
            // Agrega más asociaciones según sea necesario
        ];
    }

    protected function loadPriceSelectors(): array
    {
        
        return [
            'tecnocultivo.es' => '.current-price-value',
            'www.amazon.es' => '.aok-offscreen',
            'elcultivar.com' => '.preciocombinacion',
            'servovendi.com' => 'meta[itemprop="price"]',
            'eurogrow.es' => '.our_price_display',
            'sologrow.es' => '.current-price-value',
            'www.lahuertagrowshop.com' => '.att-precio-final',
            // Agrega más asociaciones según sea necesario
        ];
        //$config = json_decode(file_get_contents('price_selectors.json'), true);
        //return $config ?: [];
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
