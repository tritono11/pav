<?php

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
| N.B. Il file .env di default serve per capire in quale environment ci troviamo,
|      di conseguenza viene caricato il file .env.local con le informazioni di configurazione
*/
$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../.env';
    $setEnv = trim(file_get_contents($environmentPath));
    if (file_exists($environmentPath))
    {
        putenv("$setEnv");
        if (getenv('APP_ENV') && file_exists(__DIR__.'/../' . '.env.' . getenv('APP_ENV') )) {
            $dotenv = new Dotenv\Dotenv(__DIR__.'/../', '.env.' . getenv('APP_ENV'));
            $dotenv->load();
        } 
    }
});

