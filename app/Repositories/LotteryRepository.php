<?php namespace Repositories;
use Abstracts\Repository as AbstractRepository;


class LotteryRepository extends AbstractRepository implements LotteryRepositoryInterface
{

  protected $modelClassName = 'Models\Lottery';


  public function idFindOrCreateByName($name)
  {

    $className = '\\'.$this->modelClassName;
    $res = $className::where('name',trim($name))->orderBy('id','DESC');

    if($res->count() < 1){
      $obj = new $this->modelClassName;
      $obj = $this->saveorupdateObject($obj,['name'=>trim($name)]);
    }else{
      $obj = $res->first();
    }
    return $obj->id;
  }

}