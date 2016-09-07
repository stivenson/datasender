<?php namespace Repositories;

interface RepositoryInterface {

  public function store(array $attributes);
  public function all($columns = array('*'));
  public function find($id, $columns = array('*'));
  public function destroy($ids);

}