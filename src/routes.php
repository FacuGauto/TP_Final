<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\empleado;
use App\Models\empleadoApi;



return function (App $app) {
    $container = $app->getContainer();

    // Rutas ORM
    $routes = require __DIR__ . '/../src/routes/routesORM.php';
    $routes($app);

    // Rutas Empleado
    $routes = require __DIR__ . '/../src/routes/routesEmpleado.php';
    $routes($app);

    // Rutas Producto
    $routes = require __DIR__ . '/../src/routes/routesProducto.php';
    $routes($app);

    // Rutas JWT
    $routes = require __DIR__ . '/../src/routes/routesJWT.php';
    $routes($app);


    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        // $container->get('logger')->addCritical('Hey, a critical log entry!');
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });




};
