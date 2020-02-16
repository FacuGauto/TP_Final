<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Pedido;
use App\Models\ORM\MesaController;
use App\Models\IApiControler;

include_once __DIR__ . '/pedido.php';
include_once __DIR__ . '/mesaController.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class PedidoController implements IApiControler 
{
  public function TraerTodos($request, $response, $args) {
    $todosLosPedidos=pedido::all();
    $newResponse = $response->withJson($todosLosPedidos, 200);  
    return $newResponse;
  }
  
  public function TraerUno($request, $response, $args) {
    $id = $args["id"];
    $pedido = Pedido::find($id);
    if($pedido != null){
      $newResponse = $response->withJson($pedido, 200);
    }else{
      $newResponse = $response->withJson("No existe el pedido", 200);
    }
    return $newResponse;
  }
  
  public function CargarUno($request, $response, $args) {
    $token = $request->getHeader('token');
    $array_params = $request->getParsedBody();
    $token = AutentificadorJWT::ObtenerData($token[0]);
    $tiempo = 60;
    $codigo_pedido = $array_params["codigo_pedido"];
    $id_mesa = $array_params["id_mesa"];
    $productos = $array_params["productos"];
    //$id_empleado = $array_params["id_empleado"];

    //var_dump($productos);

    $pedido = new Pedido;
    $pedido->id_estado_pedido = 1;
    $pedido->codigo_pedido = $codigo_pedido;
    $pedido->id_mesa = $id_mesa;
    $pedido->id_empleado = $token->id;
    $pedido->productos = $productos;
    $pedido->tiempo = $tiempo;
    $pedido->save();

    //$mesa_disponible = mesaController::obtenerMesaLibre($request, $response, $args);
    //var_dump($pedido);

    $newResponse = $response->withJson($pedido, 200);  
    return $newResponse;
  }
  
  public function BorrarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $id = $array_params["id"];
    $pedido= pedido::where('id','=',$id)->delete();
    if($pedido){
      $mensaje=["mensaje"=>"Se dio de baja el id " . $id];
      $newResponse = $response->withJson($mensaje,200);
    }else{
      $mensaje=["mensaje"=>"No se encontro el id ingresado"];
      $newResponse = $response->withJson($mensaje,200);
    }
    return $newResponse;
  }
  
  public function ModificarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();

    if(array_key_exists("id", $array_params))
    {
      $id = $array_params['id'];
      $pedido = Pedido::find($id);

      if($id != null && $pedido != null){ 
            
        if(array_key_exists("id_estado_pedido", $array_params)){
          $pedido->id_estado_pedido = $array_params["id_estado_pedido"];
        }
        if(array_key_exists("codigo_pedido", $array_params)){
          $pedido->codigo_pedido = $array_params["codigo_pedido"];
        }
        if(array_key_exists("id_mesa", $array_params)){
          $pedido->id_mesa = $this->convertirAIdtipoEmpleado($id_mesa);
        }
        if(array_key_exists("id_empleado", $array_params)){
          $pedido->id_empleado = $array_params["id_empleado"];
        }
        if(array_key_exists("productos", $array_params)){
          $pedido->productos = $array_params["productos"];
        }
        if(array_key_exists("tiempo", $array_params)){
          $pedido->tiempo = $array_params["tiempo"];
        }
        $pedido->save();
        $newResponse = $response->withJson($pedido, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson(["mensaje"=>"Introduzca un id valido"], 200);
      }
      else if($id != null && $pedido == null){
        $newResponse = $response->withJson(["mensaje"=>"No hay un pedido con ese id"], 200);
      }
    }
    else
    {
      $newResponse = $response->withJson(["mensaje"=>"Introduzca un id valido"], 200);
    }
    return 	$newResponse;
  }

  public function PrepararPedido($request, $response, $args) {
    $array_params = $request->getParsedBody();
    if(array_key_exists("id_pedido", $array_params))
    {
      $id = $array_params['id_pedido'];
      $pedido = Pedido::find($id);
      if($id != null && $pedido != null){
        if(array_key_exists("tiempo", $array_params)){
          $pedido->tiempo = $array_params["tiempo"];
        }
        $pedido->id_estado_pedido = 2;
        $pedido->save();
        $newResponse = $response->withJson($pedido, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson('Introduzca un id valido', 200);
      }
      else if($id != null && $pedido == null){
        $newResponse = $response->withJson("No hay un pedido con ese id", 200);
      }
    }
    else
    {
      $newResponse = $response->withJson('Introduzcaaa un id valido', 200);
    } 
    return $newResponse;
  }

  
  public function ListoParaServirPedido($request, $response, $args) {
    $array_params = $request->getParsedBody();
    if(array_key_exists("id_pedido", $array_params))
    {
      $id = $array_params['id_pedido'];
      $pedido = Pedido::find($id);
      if($id != null && $pedido != null){
        $pedido->tiempo = 0;
        $pedido->id_estado_pedido = 3;
        $pedido->save();
        $newResponse = $response->withJson($pedido, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson('Introduzca un id valido', 200);
      }
      else if($id != null && $pedido == null){
        $newResponse = $response->withJson("No hay un pedido con ese id", 200);
      }
    }
    else
    {
      $newResponse = $response->withJson('Introduzcaaa un id valido', 200);
    } 
    return $newResponse;
  }
 
}