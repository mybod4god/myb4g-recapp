<?php
require('../../models/Competition.php');
class CompetitionsController{
  public $connection;
  public $Competition;
  public $id;

  public function __construct($connection){
    $this->connection = $connection;
    $this->Competition = new Competition($this->connection);
  }

  public function index(){
    return $this->Competition->get_all_competitions();
  }
  public function show($id){
    return $this->Competition->get_competition_by_id($id);
  }
  public function create($params){
    $this->Competition->add_competition($params);
    header('Location: ./index.php');
  }
  public function update($params){
    $this->Competition->edit_competition($params);
    header('Location: ./index.php');
  }
  public function delete($id){
    $this->Competition->delete_competition($id);
    header('Location: ./index.php');
  }

  public function get_rows(){
    $this->Competition->get_all_competitions();
    return $this->Competition->rows;
  }

  public function get_max(){
    return $this->Competition->get_max_id();
  }

  public function id_exist($id){
    return $this->Competition->id_exist($id);
  }

  public function get_prev($id){
    return $this->Competition->get_previous($id);
  }
  public function get_next($id){
    return $this->Competition->get_next($id);
  }

}
 ?>
