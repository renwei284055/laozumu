<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $dh = opendir( base_path('routes') );

        while ( ($file = readdir($dh)) !== false ) {
            
            if(is_file(base_path('routes/'.$file)) )
            {
                $filename =  basename($file,".php");
      
                Route::prefix($filename)
                 ->namespace($this->namespace."\\".ucfirst( $filename ))
                 ->group(base_path('routes/'.$file));

            }  

        } 
        closedir($dh);

    }
}
