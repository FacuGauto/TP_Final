<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
//use App\Models\ORM\Empleado;
use App\Models\ORM\EmpleadoController;


//include_once __DIR__ . '/../../src/app/modelORM/empleado.php';
include_once __DIR__ . '/../../src/app/modelORM/empleadoController.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->group('/empleado', function () {

    $this->get('/', EmpleadoController::class . ':traerTodos');

    $this->get('/{id}', EmpleadoController::class . ':traerUno');

    $this->post('/', EmpleadoController::class . ':cargarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->put('/', EmpleadoController::class . ':modificarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->delete('/', EmpleadoController::class . ':borrarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->post('/login', EmpleadoController::class . ':login');

  });

};

