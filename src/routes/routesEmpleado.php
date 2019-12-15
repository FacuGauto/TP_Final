<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\Empleado;
use App\Models\ORM\EmpleadoController;


include_once __DIR__ . '/../../src/app/modelORM/empleado.php';
include_once __DIR__ . '/../../src/app/modelORM/empleadoController.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->group('/empleado', function () {

    $this->get('/', EmpleadoController::class . ':traerTodos');

    $this->post('/', EmpleadoController::class . ':cargarUno');

    $this->put('/', EmpleadoController::class . ':modificarUno');

    $this->delete('/', EmpleadoController::class . ':borrarUno');

  });

};

