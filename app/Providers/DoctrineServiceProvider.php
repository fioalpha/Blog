<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DoctrineServiceProvider extends ServiceProvider
{
  
    private $entityManager;
    
    public function getEntityManager()
    {
      
      $path = array(__DIR__.'/../Models');
      
      $debug = isset($_ENV['APP_DEBUG']) ? $_ENV['APP_DEBUG'] : true;
      
      $database_array = require __DIR__.'/../../config/database.php';
      
      $database_connection = $database_array['connections']['default'];
      
       $config = Setup::createAnnotationMetadataConfiguration($path, $debug);
      
      
      return EntityManager::create($database_connection, $config );
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->entityManager = self::getEntityManager();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Doctrine\ORM\EntityManagerInterface', function($app){
		  	    return $this->entityManager;
		    });
    }
}
