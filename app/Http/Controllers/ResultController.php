<?php

namespace datasender\Http\Controllers;

use Illuminate\Http\Request;

use datasender\Http\Requests;
use Repositories\ResultRepository as RepoResult;
use Repositories\LotteryRepository as RepoLottery;
use Excel;

class ResultController extends Controller
{
  private $repo;
  private $months;

  function __construct(RepoResult $repo,Request $request){
    $this->repo = $repo;
    $this->request = $request;
    $this->months = ['enero'=>'01',
                    'febrero'=>'02',
                    'marzo'=>'03',
                    'abril'=>'04',
                    'mayo'=>'05',
                    'junio'=>'06',
                    'julio'=>'07',
                    'agosto'=>'08',
                    'septiembre'=>'09',
                    'octubre'=>'10',
                    'noviembre'=>'11',
                    'diciembre'=>'12'];
  }

  // get
  public function index(){
    $list = $this->repo->all();
    return \Response::json($list, 200);
  }

  // get with filter
  public function indexOfLottery($idLottery){
    $list = $this->repo->allOfLottery($idLottery);
    return \Response::json($list, 200);
  }


  // post
  public function import(RepoLottery $repolottery){

    try{
      Excel::load($this->request->file('file'), function ($reader) use ($repolottery) {
       $reader->each(function($sheet) use ($repolottery) {
          $arrObj = $sheet->toArray();
          
          $currenResult = [
            'date' => $this->formatMysql($arrObj['date']),
            'number' => $arrObj['number'],
            'lottery_id' => $repolottery->idFindOrCreateByName($arrObj['lottery_name'])
          ];

          try{
            $nobj = $this->repo->store($currenResult);
            echo 'Registro id '.$nobj->id.' exitoso<br/>';
          }catch(Exception $es){
            return "ERROR: ".$es;
            exit();
          }
        });
      });
      return 'LISTO !';
    }catch(Exception $e){
      return 'ERROR !';
      exit();
    }
  }


  private function formatMysql($date){
    $arrDate = explode(" ",trim($date));
    return $arrDate[2].'-'.$this->numberMonthText($arrDate[1]).'-'.$arrDate[0];
  }


  private function numberMonthText($name){
    try {
      return $this->months[strtolower($name)];
    } catch (Exception $e) {
      return 'Error, nombre de mes no encontrado en array';
      exit();
    }
  }


}
