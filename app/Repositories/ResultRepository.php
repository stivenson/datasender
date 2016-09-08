<?php namespace Repositories;
use Abstracts\Repository as AbstractRepository;


class ResultRepository extends AbstractRepository implements ResultRepositoryInterface
{

  protected $modelClassName = 'Models\Result';


  public function allOfLottery($idLottery,$columns = array('*'))
  {
    $className = '\\'.$this->modelClassName; 
    $arr = $className::orderBy('id','DESC')->where('lottery_id',$idLottery)->select($columns)->get();
    return $arr;
  }



}