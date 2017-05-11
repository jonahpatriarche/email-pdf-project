<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\\Repositories\\PDFRepositoryInterface',
            'App\\Repositories\\SnappyPdfRepository'
        );
    }
}
