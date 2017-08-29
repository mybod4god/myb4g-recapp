<?php
require('../../models/Team.php');
class TeamsController{
  public $connection;
  public $Team;
  public $id;

  public function __construct($connection){
    $this->connection = $connection;
    $this->Team = new Team($this->connection);
  }

  public function index(){
    return $this->Team->get_all_teams();
  }
  public function show($id){
    return $this->Team->get_team_by_id($id);
  }
  public function create($params){
    $this->Team->add_team($params);
    header('Location: ./index.php');
  }
  public function update($params){
    $this->Team->edit_team($params);
    header('Location: ./index.php');
  }
  public function delete($id){
    $this->Team->delete_team($id);
    header('Location: ./index.php');
  }

  public function get_rows(){
    $this->Team->get_all_teams();
    return $this->Team->rows;
  }

  public function get_max(){
    return $this->Team->get_max_id();
  }

  public function id_exist($id){
    return $this->Team->id_exist($id);
  }

  public function get_prev($id){
    return $this->Team->get_previous($id);
  }
  public function get_next($id){
    return $this->Team->get_next($id);
  }

}
 ?>
