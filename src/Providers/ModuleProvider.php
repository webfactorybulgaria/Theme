<?php

namespace TypiCMS\Modules\Theme\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use File;

abstract class ModuleProvider extends ServiceProvider
{
    protected $themeName = '';
    protected $sourceDir = __DIR__;
    public function boot()
    {
        $this->publishes([
            $this->sourceDir . '/../resources/' => base_path('resources/themes/' . $this->themeName),
        ], 'themes');
        $this->addViews();
    }

    public function register()
    {
    }

    protected function addViews()
    {
        $dir = base_path('resources/themes/' . $this->themeName . '/views/');
        if (is_dir($dir)) {
            $list = File::directories($dir);
            foreach ($list as $namespace) {
                $this->addView(basename($namespace));
            }
        }
    }
    protected function addView($namespace)
    {
        if (is_dir($appPath = $this->app->basePath() . '/resources/themes/' . $this->themeName . '/views/' . $namespace)) {
            $this->app['view']->prependNamespace($namespace, $this->app->basePath() . '/resources/themes/' . $this->themeName . '/views/' . $namespace);
        }
    }
}
