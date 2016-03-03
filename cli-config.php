<?php
  
    require 'vendor\autoload.php';
    
    require __DIR__.'/bootstrap/app.php';
    
    $provider = new App\Providers\DoctrineServiceProvider($app);
    
    $entityManger = $provider->getEntityManager();
    
    return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);