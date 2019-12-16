<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\Pedido;
use App\Models\ORM\PedidoController;


include_once __DIR__ . '/../../src/app/modelORM/pedido.php';
include_once __DIR__ . '/../../src/app/modelORM/pedidoController.php';

return function (App $app) {
  $container = $app->getContainer();

  $app->group('/pedido', function () {

    $this->get('/', PedidoController::class . ':traerTodos');

    $this->get('/{id}', PedidoController::class . ':traerUno');

    $this->post('/', PedidoController::class . ':cargarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->put('/', PedidoController::class . ':modificarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

    $this->delete('/', PedidoController::class . ':borrarUno')->add(Middleware::class . ":EsSocio")->add(Middleware::class . ":ValidarToken");

  });

};
