<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Importa tus modelos
use App\Models\Product;
use App\Models\Categories;
use App\Models\SpecialityArea;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-custom'; // Nombre del comando
    
    /**
     * The console command description.
    *
    * @var string
    */
    protected $description = 'Genera el sitemap.xml personalizado';
    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generando sitemap...');

        // 1. Iniciar el sitemap
        $sitemap = Sitemap::create();

        // 2. Añadir URLs estáticas (HomePage, Contacto, etc.)
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0)
        );
        
        // $sitemap->add(Url::create('/contacto')->setPriority(0.5));
        // $sitemap->add(Url::create('/nosotros')->setPriority(0.5));

        // 3. Añadir todos los PRODUCTOS
        // Usamos chunk para no agotar la memoria si tienes miles de productos
        Product::where('active', 1)->chunk(200, function ($products) use ($sitemap) {
            foreach ($products as $product) {
                $slug = Str::slug($product->name); // "Refrigerador de Plomo" -> "refrigerador-de-plomo"
                $url = route('product.show', $slug);

                $sitemap->add(
                    Url::create($url)
                        ->setLastModificationDate($product->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.9) // Prioridad alta para productos
                );
            }
        });

        // 4. Añadir todas las CATEGORÍAS
        $categories = Categories::all(); 
        foreach ($categories as $category) {
            $slug = Str::slug($category->name);
            $url = route('product.show', $slug);

            $sitemap->add(
                Url::create($url)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8) // Prioridad media-alta
            );
        }

        // 5. Añadir todas las ÁREAS DE ESPECIALIDAD
        $areas = SpecialityArea::all(); // <-- Asumo que tu modelo es SpecialityArea
        foreach ($areas as $area) {
            $slug = Str::slug($area->name);
            $url = route('product.show', $slug);

            $sitemap->add(
                Url::create($url)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8) // Prioridad media-alta
            );
        }

        // 6. Escribir el archivo final
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generado exitosamente en public/sitemap.xml');
        return 0;
    }
}
