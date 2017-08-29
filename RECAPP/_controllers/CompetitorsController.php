<?php
require('../../models/Competitor.php');
class CompetitorsController{
  public $connection;
  public $Competitor;
  public $id;

  public function __construct($connection){
    $this->connection = $connection;
    $this->Competitor = new Competitor($this->connection);
  }

  public function index(){
    return $this->Competitor->get_all_competitors();
  }
  public function show($id){
    return $this->Competitor->get_competitor_by_id($id);
  }
  public function create($params){
    $this->Competitor->add_competitor($params);
    header('Location: ./index.php');
  }
  public function update($params){
    $this->Competitor->edit_competitor($params);
    header('Location: ./index.php');
  }
  public function delete($id){
    $this->Competitor->delete_competitor($id);
    header('Location: ./index.php');
  }

  public function get_rows(){
    $this->Competitor->get_all_competitors();
    return $this->Competitor->rows;
  }

  public function get_max(){
    return $this->Competitor->get_max_id();
  }

  public function id_exist($id){
    return $this->Competitor->id_exist($id);
  }

  public function get_prev($id){
    return $this->Competitor->get_previous($id);
  }
  public function get_next($id){
    return $this->Competitor->get_next($id);
  }

}
 ?>
