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
        $this->getAdminMenu();
    }
    private function getMenu(){
      \View::composer('layouts.main', function ($view){
          $view->with('menu',\view('main_menu'));
      });
    }

    private function getAdminMenu(){
        \View::composer('layouts.admin', function ($view){
           $view->with('admin_menu', \view('admin.admin_menu'));
        });
    }
}
