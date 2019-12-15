<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Pedido;
use App\Models\IApiControler;

include_once __DIR__ . '/pedido.php';
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
    //complete el codigo
    $arry_params = $request->getParsedBody();
    var_dump($arry_params);
    //$newResponse = $response->withJson("sin completar", 200);  
    //return $newResponse;
  }
  
  public function CargarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $nombre = $array_params["nombre"];
    $apellido = $array_params["apellido"];
    $tipo_empleado = $array_params["tipo_empleado"]; 
    $usuario = $array_params["usuario"];
    $clave = crypt($array_params['clave'],'st');

    $empleado = new empleado;
    $empleado->nombre = $nombre;
    $empleado->apellido = $apellido;
    $empleado->id_tipo_empleado = $this->convertirAIdtipoEmpleado($tipo_empleado);
    $empleado->usuario = $usuario;
    $empleado->clave = $clave;
    $empleado->save();

    $newResponse = $response->withJson($empleado, 200);  
    return $newResponse;
  }
  
  public function BorrarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $id = $array_params["id"];
    $empleado= empleado::where('id','=',$id)->delete();
    if($empleado){
      $mensaje=["mensaje"=>"Se dio de baja el id " . $id];
      $newResponse = $response->withJson($mensaje,200);
    }else{
      $mensaje=["mensaje"=>"No se encontro el usuario ingresado"];
      $newResponse = $response->withJson($mensaje,200);
    }
    return $newResponse;
  }
  
  public function ModificarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();

    if(array_key_exists("id", $array_params))
    {
      $id = $array_params['id'];
      $empleado = Empleado::find($id);

      if($id != null && $empleado != null){ 
            
        if(array_key_exists("nombre", $array_params)){
          $empleado->nombre = $array_params["nombre"];
        }
        if(array_key_exists("apellido", $array_params)){
          $empleado->apellido = $array_params["apellido"];
        }
        if(array_key_exists("tipo_empleado", $array_params)){
          $empleado->id_tipo_empleado = $this->convertirAIdtipoEmpleado($tipo_empleado);
        }
        if(array_key_exists("usuario", $array_params)){
          $empleado->usuario = $array_params["usuario"];
        }
        if(array_key_exists("clave", $array_params)){
          $empleado->clave = crypt($array_params['clave'],'st');
        }
        $empleado->save();
        $newResponse = $response->withJson($empleado, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson('Introduzca un id valido', 200);
      }
      else if($id != null && $empleado == null){
        $newResponse = $response->withJson("No hay un usuario con ese id", 200);
      }
    }
    else
    {
      $newResponse = $response->withJson('Introduzca un id valido', 200);
    }
    return 	$newResponse;
  }

  public function convertirAIdtipoEmpleado($descripcion_tipo_empleado){
    switch ($descripcion_tipo_empleado) {
      case "socio":
        $respuesta = 1;
        break;
      case "bartender":
        $respuesta = 2;
        break;
      case "cervecero":
        $respuesta = 3;
        break;
      case "cocinero":
        $respuesta = 4;
        break;
      case "mozo":
        $respuesta = 5;
        break;
    }
    return $respuesta;
  }
 
}