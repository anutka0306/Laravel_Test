<?php

namespace App\Providers;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->getMenu();
    }
    private function getMenu(){
      \View::composer('layouts.main', function ($view){
          $view->with('menu',\view('main_menu'));
      });
    }
}
