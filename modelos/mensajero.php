<?php
require_once "conexion.php";
class controladorids
{  
    public static function traerid($tabla,$id)
    {
           $sql = "select max($id) maximo from carta";

           $stmt1 = Conexion::conectar()->prepare($sql);
           $resultado=$stmt1->execute();

           if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
            $clave=$filas['maximo']."";
           }
           return $clave;
  }
    //http://localhost/proyecto/models/probando.php
   // $id="Cod_Cliente";
  //  $tabla ="persona";
  //  $clave =(string) Controladorid::traerid($tabla,$id);
    
  //  echo $clave;
  public static function traerestado($id)
  {
    
         $sql = "SELECT `Estado` FROM `casillero` WHERE Cod_casillero = $id";

         $stmt1 = Conexion::conectar()->prepare($sql);
         $resultado=$stmt1->execute();

         if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
            $clave=$filas['Estado']."";
         }
         return $clave;
  }
  
  public static function traerids($tabla,$ids)
  {
         $sql = "select max($ids) maximo from $tabla";

         $stmt1 = Conexion::conectar()->prepare($sql);
         $resultado=$stmt1->execute();

         if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
          $clave=$filas['maximo']."";
         }
         return $clave; 
  }

  public static function traerelemento($tabla,$elemento,$item,$valor)
  {
         $sql = "select $elemento maximo from $tabla where $item = $valor";
         $stmt1 = Conexion::conectar()->prepare($sql);
         $resultado=$stmt1->execute();
         if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
          $clave=$filas['maximo']."";
         }
         return $clave; 
  }


  public static function traerelementos($id)
  {
        //$temp='12450199LP';
         $sql = "select cod_user maximo from usuarios where dni = '$id'";
         
         $stmt1 = Conexion::conectar()->prepare($sql);
         $resultado=$stmt1->execute();

         if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
          $clave=$filas['maximo']."";
         }
         return $clave; 
  }

  public static function traercodigousuario($id)
  {
        //$temp='12450199LP';
         $sql = "select dni ci from usuarios where cod_user = $id";
         
         $stmt1 = Conexion::conectar()->prepare($sql);
         $resultado=$stmt1->execute();

         if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
          $clave=$filas['ci']."";
         }
         return $clave; 
  }


public static function traerid1($tabla,$id)
{
       $sql = "select max($id) maximo from $tabla";

       $stmt1 = Conexion::conectar()->prepare($sql);
       $resultado=$stmt1->execute();

       if($filas = $stmt1->fetch(PDO::FETCH_ASSOC)){
        $clave=$filas['maximo']."";
       }
       return $clave;
}
 }         
 
     

      
//       $clave2= '12450199LP'; 
//  //http://localhost/proyecto/models/probando.php
//   // $id="17";
//   //$tabla ="persona";
//   //$clave =(string) Controladorid::traerid($tabla,$id);
//    //echo $clave;console.log();
//    //http://localhost/sistema/modelos/mensajero.php
//   // $clave3= '';
// $clave2=4;
//    $clave3= controladorids::traercodigousuario($clave2);
//    echo $clave3;