<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\ORM\Mesa;
use App\Models\IApiControler;

include_once __DIR__ . '/mesa.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class MesaController implements IApiControler 
{
  public function TraerTodos($request, $response, $args) {
    $todasLasMesas=mesa::all();
    $newResponse = $response->withJson($todasLasMesas, 200);  
    return $newResponse;
  }
  
  public function TraerUno($request, $response, $args) {
    $id = $args["id"];
    $mesa = Mesa::find($id);
    if($mesa != null){
      $newResponse = $response->withJson($mesa, 200);
    }else{
      $newResponse = $response->withJson("No existe la mesa", 200);
    }
    return $newResponse;
  }
  
  public function CargarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $files = $request->getUploadedFiles();
    $codigo_mesa = $array_params["codigo_mesa"];
    $id_estado_mesa = $array_params["id_estado_mesa"];
    
    $mesa = new mesa;
    $mesa->codigo_mesa = $codigo_mesa;
    $mesa->id_estado_mesa = $id_estado_mesa;
    //foto
    $foto = $files["foto"];
    $extension = $foto->getClientFilename();
    $extension = explode(".", $extension);
    $filename = "./Fotos/Mesas/" . $codigo_mesa . "." . $extension[1];
    $foto->moveTo($filename);
    $mesa->foto =  $filename;
    $mesa->save();

    $newResponse = $response->withJson($mesa, 200);  
    return $newResponse;
  }
  
  public function BorrarUno($request, $response, $args) {
    $array_params = $request->getParsedBody();
    $id = $array_params["id"];
    $mesa= mesa::where('id','=',$id)->delete();
    if($mesa){
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
    $files = $request->getUploadedFiles();

    if(array_key_exists("id", $array_params))
    {
      $id = $array_params['id'];
      $mesa = Mesa::find($id);

      if($id != null && $mesa != null){ 
            
        if(array_key_exists("codigo_mesa", $array_params)){
          $mesa->codigo_mesa = $array_params["codigo_mesa"];
        }
        if(array_key_exists("id_estado_mesa", $array_params)){
          $mesa->id_estado_mesa = $array_params["id_estado_mesa"];
        }
        if(array_key_exists("foto", $array_params)){
          //foto
           /* $foto = $files["foto"];
            $extension = $foto->getClientFilename();
            $extension = explode(".", $extension);
            $filename = "./Fotos/Mesas/" . $codigo_mesa . "." . $extension[1];
            $foto->moveTo($filename);
            $mesa->foto =  $filename;*/
        }
        $mesa->save();
        $newResponse = $response->withJson($mesa, 200);
      }
      else if($id == null){
        $newResponse = $response->withJson('Introduzca un id valido', 200);
      }
      else if($id != null && $mesa == null){
        $newResponse = $response->withJson("No hay un producto con ese id", 200);
      }
    }
    else
    {
      $newResponse = $response->withJson('Introduzca un id valido', 200);
    }
    return 	$newResponse;
  }

  public function obtenerMesaLibre($request, $response, $args){
      $mesaLibre = Mesa::where("id_estado_mesa","=","4")
      ->first();

      if($mesaLibre != null){
          $newResponse = $mesaLibre->codigoMesa;
          $mesaLibre->id_estado_mesa = 1;
          $mesaLibre->save();
          $newResponse = $response->withJson($mesaLibre, 200);
          //$this->cambiarEstado($mesaLibre->codigoMesa, 1);
      }else{
        $newResponse = $response->withJson('No hay mesas disponibles', 200);
      }
      return $newResponse;
  }
  
  public function cambiarEstado($codigoMesa, $nuevoEstado){
      /*echo "CODIGO";
      var_dump($codigoMesa);
      $mesa = Mesa::where('codigo_mesa','=',$codigoMesa)->first();
      var_dump($mesa);
      $mesa->id_estado_mesa = $nuevoEstado;
      */
      //$mesa->save();
    }
}