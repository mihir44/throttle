<?php
header('Server: IDfy');
header('X-Powered-By: IDfy');
header("Content-Security-Policy: default-src  'self'  blob: ; style-src 'self' https://fonts.googleapis.com 'unsafe-inline' ;connect-src 'self' https://ka-f.fontawesome.com/releases/v6.4.0/css/;font-src 'self' https://ka-f.fontawesome.com/releases/v6.4.0/webfonts/ https://fonts.gstatic.com/ ; script-src 'self' 'unsafe-inline' ; object-src 'none';img-src 'self' https://storage.googleapis.com/ data:");

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
