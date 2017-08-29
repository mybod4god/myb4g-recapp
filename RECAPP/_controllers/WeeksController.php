<?php
require('../../models/Week.php');
class WeeksController{
  public $connection;
  public $Week;
  public $id;

  public function __construct($connection){
    $this->connection = $connection;
    $this->Week = new Week($this->connection);
  }

  public function index(){
    return $this->Week->get_all_weeks();
  }
  public function show($id){
    return $this->Week->get_week_by_id($id);
  }
  public function create($params){
    $this->Week->add_week($params);
    header('Location: ./index.php');
  }
  public function update($params){
    $this->Week->edit_week($params);
    header('Location: ./index.php');
  }
  public function delete($id){
    $this->Week->delete_week($id);
    header('Location: ./index.php');
  }

  public function get_rows(){
    $this->Week->get_all_weeks();
    return $this->Week->rows;
  }

  public function get_max(){
    return $this->Week->get_max_id();
  }

  public function id_exist($id){
    return $this->Week->id_exist($id);
  }

  public function get_prev($id){
    return $this->Week->get_previous($id);
  }
  public function get_next($id){
    return $this->Week->get_next($id);
  }

}
 ?>
