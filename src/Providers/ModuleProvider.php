<?php

namespace TypiCMS\Modules\Theme\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use File;

abstract class ModuleProvider extends ServiceProvider
{
    protected $themeName = '';
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/' => base_path('resources/themes/' . $this->themeName),
        ], 'themes');
        $this->addViews();
    }

    public function register()
    {
    }

    protected function addViews()
    {
        $list = File::directories(__DIR__.'/../resources/views');
        foreach ($list as $namespace) {
            $this->addView(basename($namespace));
        }
    }
    protected function addView($namespace)
    {
        if (is_dir($appPath = $this->app->basePath().'/resources/themes/'.$this->themeName.'/views/'.$namespace)) {
            $this->app['view']->prependNamespace($namespace, $this->app->basePath().'/resources/themes/'.$this->themeName.'/views/'.$namespace);
        }
    }
}
