<?php
  class Team{
    public $connection;
    public $db_name = 'mybod4god';
    public $table_name = 'teams';
    public $id;
    public $name;
    public $leader;
    public $data;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
      $this->create_table();
    }

    public function create_team(){
      $sql = "INSERT INTO `teams` (
        `team_ID`,
        `team_name`,
        `team_leader`,
        `team_date_entered`
      ) VALUES (
        NULL,
        '$this->name',
        '$this->leader',
        CURRENT_TIMESTAMP
      );";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There has been an ERROR!!!<br>');
      }else{
        // echo('Team Added Successfully!!!<br>');
      }
    }

    public function get_table_name(){
      return $this->table_name;
    }

    public function get_db_name(){
      return $this->db_name;
    }

    public function create_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`teams` ( ";
      $sql .= "`team_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT , ";
      $sql .= "`team_name` VARCHAR(100) NOT NULL , ";
      $sql .= "`team_leader` VARCHAR(100) NOT NULL , ";
      $sql .= "`team_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , ";
      $sql .= "PRIMARY KEY (`team_ID`)";
      $sql .= ") ENGINE = InnoDB;";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There was a problem creating the TEAMS table!!!<br>');
      }

    }

    public function get_all_teams(){
      $sql = "SELECT * FROM teams";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_team_data($result);
      }
    }
    public function get_team_by_id($id){
      $sql = "SELECT * FROM teams WHERE team_ID='$id'";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_team_data($result);
      }
    }
    public function add_team($params){
      $this->name     =   $params['name'];
      $this->leader   =   $params['leader'];
      $this->create_team();
    }
    public function edit_team($params){
      $this->id       =   $params['id'];
      $this->name     =   $params['name'];
      $this->leader   =   $params['leader'];
      $this->update_team();
    }
    public function delete_team($id){
      $this->id = $id;
      $this->destroy_team();
    }
// ***** Destroy Team *****
    public function destroy_team(){
      $sql = "DELETE FROM `teams` WHERE team_ID='$this->id';";
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('There has been an ERROR deleting team...<br>');}
    }
// ***** Update Team *****
    public function update_team(){
      $sql = "UPDATE `teams`
      SET `team_name` = '$this->name',
      `team_leader` = '$this->leader'
      WHERE `teams`.`team_ID` = '$this->id';";

      prewrap($sql);

      $result = mysqli_query($this->connection, $sql);
      // if(!$result){
      //   echo('There has been a problem updating the team...<br>');
      // }else{
      //   header('Location: ./index.php');
      // }
    }
// ***** Get Max ID *****
    public function get_max_id(){
      $sql = "SELECT * FROM teams ORDER BY team_ID DESC LIMIT 1";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        $team = $this->get_team_data($result);
        return $team['id'];
      }
    }
// ***** Does ID Exist *****
    public function id_exist($id){
      $sql = "SELECT * FROM teams WHERE team_ID='$id';";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    // *** Get Previous Team ***
      public function get_previous($id){
        $this->id = $id;
        $sql = "SELECT * FROM teams
        WHERE team_ID < '$this->id'
        ORDER BY team_ID DESC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $team = $this->get_team_data($result);
          if(!$team['id']){
            return $this->id;
          }
          return $team['id'];
        }
      }
    // *** Get Next Team ***
      public function get_next($id){
        $this->id = $id;
        $sql = "SELECT * FROM teams
        WHERE team_ID > '$this->id'
        ORDER BY team_ID ASC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $team = $this->get_team_data($result);
          if(!$team['id']){
            return $this->id;
          }
          return $team['id'];
        }
      }

//*************** GET COMPETITOR DATA *****************
    public function get_team_data($result){
      $this->rows = mysqli_num_rows($result);
      $this->data = array();
      if($this->rows > 1){
        while($row = mysqli_fetch_assoc($result)){
          $this->data[] = array(
            'id'              =>    $row['team_ID'],
            'name'            =>    $row['team_name'],
            'leader'          =>    $row['team_leader'],
            'date_entered'    =>    $row['team_date_entered']
          );
        }
        $this->json = json_encode($this->data);

      }else{
        $row = mysqli_fetch_assoc($result);
        $this->data = array(
          'id'              =>    $row['team_ID'],
          'name'            =>    $row['team_name'],
          'leader'          =>    $row['team_leader'],
          'date_entered'    =>    $row['team_date_entered']
        );

        $this->json = json_encode($this->data);
      }
      return $this->data;
    }

  }

 ?>
