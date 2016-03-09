<?php

namespace TypiCMS\Modules\ThemeBasic\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    protected $themeName = 'basic';
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/themes/' . $this->$themeName),
        ], 'views');

    }

    public function register()
    {
    }

    protected function addViews()
    {
        $list = File::directories(__DIR__.'/../resources/views');
        foreach ($list as $namespace) {
            $this->addView($namespace);
        }
    }
    protected function addView($namespace)
    {
        if (is_dir($appPath = $this->app->basePath().'/resources/views/themes/'.$this->$themeName.'/'.$namespace)) {
            $this->app['view']->prependNamespace('core', $this->app->basePath().'/resources/views/themes/vendor/'.$namespace);
        }

    }
}
