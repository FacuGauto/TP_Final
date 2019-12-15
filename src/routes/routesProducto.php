<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\Producto;
use App\Models\ORM\ProductoController;


include_once __DIR__ . '/../../src/app/modelORM/producto.php';
include_once __DIR__ . '/../../src/app/modelORM/productoController.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->group('/producto', function () {

    $this->get('/', ProductoController::class . ':traerTodos');

    $this->post('/', ProductoController::class . ':cargarUno');

    $this->put('/', ProductoController::class . ':modificarUno');

    $this->delete('/', ProductoController::class . ':borrarUno');

  });

};

