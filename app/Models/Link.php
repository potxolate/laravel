<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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
        } catch (\Throwable $e) {
            Log::error("{$this->url} - Error al obtener el precio: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Extraer el precio de la URL.
     *
     * @return string|null
     */
    protected function extractPriceFromUrl(): ?string
    {
        Log::info("Iniciando extracción de precio de URL: {$this->product->name}");

        $domainToPriceSelector = $this->loadPriceSelectors();
        $domain = $this->getDominioAttribute();
        $priceSelector = $domainToPriceSelector[$domain] ?? 'span[itemprop="price"]';

        Log::info("Dominio: {$domain} | Selector: {$priceSelector}");

        $html = $this->fetchHtmlFromUrl();
        $crawler = new Crawler($html);

        try {
            switch ($priceSelector) {
                case 'span[itemprop="price"]':
                    return $crawler->filterXPath('//span[@itemprop="price"]')->attr('content');
                case 'meta':
                    return $crawler->filterXPath('//meta[@itemprop="price"]')->attr('content');
                default:
                    return $crawler->filter($priceSelector)->first()->text();
            }
        } catch (\InvalidArgumentException $e) {
            Log::warning("No se pudo encontrar el selector: {$priceSelector} en {$this->url}");
            return null;
        }
    }

    /**
     * Cargar selectores de precio desde un archivo JSON.
     *
     * @return array
     */
    protected function loadPriceSelectors(): array
    {
        $configPath = base_path('/public/price_selectors.json');

        if (!file_exists($configPath)) {
            Log::error("El archivo de configuración de selectores no existe: {$configPath}");
            return [];
        }

        $configContent = file_get_contents($configPath);
        $config = json_decode($configContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Error al parsear JSON: " . json_last_error_msg());
            return [];
        }

        return $config;
    }

    /**
     * Obtener el HTML desde la URL.
     *
     * @return string
     */
    protected function fetchHtmlFromUrl(): string
    {
        try {
            $client = new Client(['timeout' => 10]); // Se agrega un timeout de 10s
            $response = $client->request('GET', $this->url, ['headers' => ['User-Agent' => 'Mozilla/5.0']]);
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            Log::error("Error al obtener HTML desde {$this->url}: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Parsear el texto del precio a un float.
     *
     * @param string|null $priceText
     * @return float|null
     */
    protected function parsePriceText(?string $priceText): ?float
    {
        if (!$priceText) {
            Log::warning("El texto del precio está vacío o es nulo para URL: {$this->url}");
            return null;
        }

        $priceText = preg_replace('/[^0-9,.]/', '', $priceText);
        return floatval(str_replace(',', '.', $priceText));
    }

    /**
     * Obtener el dominio de la URL.
     *
     * @return string|null
     */
    public function getDominioAttribute(): ?string
    {
        return parse_url($this->url, PHP_URL_HOST) ?: null;
    }

}
