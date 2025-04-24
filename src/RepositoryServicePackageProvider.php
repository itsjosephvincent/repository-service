<?php

namespace Joseph\RepositoryService;

use Illuminate\Support\ServiceProvider;
use Joseph\RepositoryService\Commands\MakeRepositoryService;

class RepositoryServicePackageProvider extends ServiceProvider
{
    public function register()
    {
        // Register the MakeRepositoryService command
        $this->commands([
            MakeRepositoryService::class,
        ]);
    }

    public function boot()
    {
        // Boot logic (if any, e.g., publishing config files, assets)
    }
}
