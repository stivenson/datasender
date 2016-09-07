<?php
namespace Helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 */
/**
 * Description of OperationsDate
 *
 * Dependence for operations on date
 *
 * @author stivenson
 */
use DateTime;

class OperationsDate {

  public function daysOfdayWeek($date){
    $weekDaysArray = array();
    $dto = new DateTime();
    $week = $this->weekOfDate($date);
    $year = $this->yearOfDate($date);
    $dto->setISODate($year, $week);
    for($i = 0; $i < 7; $i++) {
      array_push($weekDaysArray, $dto->format('Y-m-d'));
      $dto->modify("+1 days");
    }
    return $weekDaysArray;
  }

  public function weekOfDate($ddate){
    $date = new DateTime($ddate);
    $week = $date->format("W");
    return $week;
  }

  public function yearOfDate($ddate){
    $date = new DateTime($ddate);
    $year = $date->format("Y");
    return $year;
  }

  public function now(){

    date_default_timezone_set('america/bogota');

    $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
      'Miercoles', 'Jueves', 'Viernes', 'Sabado');

    return $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
  }

}