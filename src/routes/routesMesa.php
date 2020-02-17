<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\Mesa;
use App\Models\ORM\MesaController;


include_once __DIR__ . '/../../src/app/modelORM/mesa.php';
include_once __DIR__ . '/../../src/app/modelORM/mesaController.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->group('/mesa', function () {

    $this->get('/', MesaController::class . ':traerTodos')->add(Middleware::class . ":ValidarToken");

    $this->get('/traerUnaMesa/{id}', MesaController::class . ':traerUno');

    $this->post('/', MesaController::class . ':cargarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->put('/', MesaController::class . ':modificarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->delete('/', MesaController::class . ':borrarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->get('/obtenerMesaLibre', MesaController::class . ':obtenerMesaLibre')->add(Middleware::class . ":ValidarToken");


  });

};

