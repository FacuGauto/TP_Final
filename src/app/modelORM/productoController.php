<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Producto;
use App\Models\IApiControler;

include_once __DIR__ . '/producto.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ProductoController implements IApiControler 
{
  public function TraerTodos($request, $response, $args) {
    $todosLosProductos=producto::all();
    $newResponse = $response->withJson($todosLosProductos, 200);  
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
    $descripcion = $array_params["descripcion"];
    $precio = $array_params["precio"];

    $producto = new producto;
    $producto->descripcion = $descripcion;
    $producto->precio = $precio;
    $producto->save();

    $newResponse = $response->withJson($producto, 200);  
    return $newResponse;
  }
  
  public function BorrarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $id = $array_params["id"];
    $producto= producto::where('id','=',$id)->delete();
    if($producto){
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
      $producto = Producto::find($id);

      if($id != null && $producto != null){ 
            
        if(array_key_exists("descripcion", $array_params)){
          $producto->descripcion = $array_params["descripcion"];
        }
        if(array_key_exists("precio", $array_params)){
          $producto->precio = $array_params["precio"];
        }
        $producto->save();
        $newResponse = $response->withJson($producto, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson('Introduzca un id valido', 200);
      }
      else if($id != null && $producto == null){
        $newResponse = $response->withJson("No hay un producto con ese id", 200);
      }
    }
    else
    {
      $newResponse = $response->withJson('Introduzca un id valido', 200);
    }
    return 	$newResponse;
  }
}