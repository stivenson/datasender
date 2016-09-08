<?php

namespace datasender\Http\Controllers;

use Illuminate\Http\Request;

use datasender\Http\Requests;
use Repositories\LotteryRepository as RepoResult;


class LotteryController extends Controller
{
  private $repo;

  function __construct(RepoResult $repo,Request $request){
    $this->repo = $repo;
    $this->request = $request;
  }

  // get
  public function index(){
    $list = $this->repo->all();
    return \Response::json($list, 200);
  }

  public function show($id){
    $item = $this->repo->find($id);
    return \Response::json($item, 200);
  }


}
