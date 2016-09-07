<?php namespace Abstracts;

use Repositories\RepositoryInterface;
use \Illuminate\Database\QueryException;
/**
 * The Abstract Repository provides default implementations of the methods defined
 * in the base repository interface. These simply delegate static function calls 
 * to the right eloquent model based on the $modelClassName.
 */
abstract class Repository implements RepositoryInterface {
  
  protected $modelClassName;

  protected function saveorupdateObject($obj,$attributes){
    foreach ($attributes as $key => $value) { 
      try{ $obj->$key = $value; }catch(Exception $e){ continue; }
    }
    try{ $obj->save(); }catch(Exception $e){ return false;}
    return $obj;
  }
  /**
   * Keeps a record
   * @param associative array with fields and values of registry
   * @return false or object saved
   */
  public function store(array $attributes){ // Se puede sobreescribir a store en alǵun repositorio para agregar validaciones especiales sobre los campos

    $obj = new $this->modelClassName;
    return $this->saveorupdateObject($obj,$attributes); // metodo privado para reuso de for

  }
  /**
   * Updates a record
   * @param associative array with fields and values of registry
   * @return false or object updated
   */
  public function update($id,$attributes){ // Se puede sobreescribir a update en alǵun repositorio para agregar validaciones especiales sobre los campos
    $className = '\\'.$this->modelClassName;
    $obj = $className::find($id);
    return $this->saveorupdateObject($obj,$attributes); // metodo privado para reuso de for
  }

  public function all($columns = array('*'))
  {
    $className = '\\'.$this->modelClassName; 
    $arr = $className::orderBy('id','DESC')->select($columns)->get();
    return $arr;
  }
  public function find($id, $columns = array('*'))
  {
    return call_user_func_array("{$this->modelClassName}::find", array($id, $columns));
  }
  public function destroy($ids)
  {
    return call_user_func_array("{$this->modelClassName}::destroy", array($ids));
  }
  // inactivo - activo
  public function active($id){
    $obj = call_user_func_array("{$this->modelClassName}::find", array($id));
    ($obj->active == 1)?$obj->active=0:$obj->active=1;
    $obj->save();
  }

  // traer registro con usuario relacionado
  public function getInfoUser(){ 
    return \User::where('active',1)->find($iduser);
  }


  // traer todos las columnas recibidas con el usuario asociado en cada registro
  public function allwithoutUser(array $columns)
  {
    $className = '\\'.$this->modelClassName; 
    $arr = $className::where('active',1)
    ->select($columns)
    ->get();
    return $arr;
  }


  public function getLastRow(){
    $className = '\\'.$this->modelClassName; 
    return  $className::orderBy('id','DESC')->first();
  }

  public function amount(){
    $className = '\\'.$this->modelClassName; 
    return  $className::count();
  }

}