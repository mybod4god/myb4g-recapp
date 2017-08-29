<?php
  class Competition{
    public $connection;
    public $db_name = 'mybod4god';
    public $table_name = 'competitions';
    public $id;
    public $name;
    public $location;
    public $details;
    public $data;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
      $this->create_table();
    }

    public function create_competition(){
      $sql = "INSERT INTO `competitions` (
        `competition_ID`,
        `competition_name`,
        `competition_location`,
        `competition_details`,
        `competition_date_entered`
      ) VALUES (
        NULL,
        '$this->name',
        '$this->location',
        '$this->details',
        CURRENT_TIMESTAMP
      );";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There has been an ERROR!!!<br>');
      }else{
        // echo('Competition Added Successfully!!!<br>');
      }
    }

    public function get_table_name(){
      return $this->table_name;
    }

    public function get_db_name(){
      return $this->db_name;
    }

    public function create_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`competitions` ( ";
      $sql .= "`competition_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT , ";
      $sql .= "`competition_name` VARCHAR(100) NOT NULL , ";
      $sql .= "`competition_location` VARCHAR(100) NOT NULL , ";
      $sql .= "`competition_details` VARCHAR(100) NOT NULL , ";
      $sql .= "`competition_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , ";
      $sql .= "PRIMARY KEY (`competition_ID`)";
      $sql .= ") ENGINE = InnoDB;";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There was a problem creating the COMPETITIONS table!!!<br>');
      }

    }

    public function get_all_competitions(){
      $sql = "SELECT * FROM competitions";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_competition_data($result);
      }
    }
    public function get_competition_by_id($id){
      $sql = "SELECT * FROM competitions WHERE competition_ID='$id'";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_competition_data($result);
      }
    }
    public function add_competition($params){
      $this->name       =   $params['name'];
      $this->location   =   $params['location'];
      $this->details    =   $params['details'];
      $this->create_competition();
    }
    public function edit_competition($params){
      $this->id         =   $params['id'];
      $this->name       =   $params['name'];
      $this->location   =   $params['location'];
      $this->details    =   $params['details'];
      $this->update_competition();
    }
    public function delete_competition($id){
      $this->id = $id;
      $this->destroy_competition();
    }
// ***** Destroy Competition *****
    public function destroy_competition(){
      $sql = "DELETE FROM `competitions` WHERE competition_ID='$this->id';";
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('There has been an ERROR deleting competition...<br>');}
    }
// ***** Update Competition *****
    public function update_competition(){
      $sql = "UPDATE `competitions`
      SET `competition_name` = '$this->name',
      `competition_location` = '$this->location',
      `competition_details` = '$this->details'
      WHERE `competitions`.`competition_ID` = '$this->id';";

      prewrap($sql);

      $result = mysqli_query($this->connection, $sql);
      // if(!$result){
      //   echo('There has been a problem updating the competition...<br>');
      // }else{
      //   header('Location: ./index.php');
      // }
    }
// ***** Get Max ID *****
    public function get_max_id(){
      $sql = "SELECT * FROM competitions ORDER BY competition_ID DESC LIMIT 1";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        $competition = $this->get_competition_data($result);
        return $competition['id'];
      }
    }
// ***** Does ID Exist *****
    public function id_exist($id){
      $sql = "SELECT * FROM competitions WHERE competition_ID='$id';";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    // *** Get Previous Competition ***
      public function get_previous($id){
        $this->id = $id;
        $sql = "SELECT * FROM competitions
        WHERE competition_ID < '$this->id'
        ORDER BY competition_ID DESC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $competition = $this->get_competition_data($result);
          if(!$competition['id']){
            return $this->id;
          }
          return $competition['id'];
        }
      }
    // *** Get Next Competition ***
      public function get_next($id){
        $this->id = $id;
        $sql = "SELECT * FROM competitions
        WHERE competition_ID > '$this->id'
        ORDER BY competition_ID ASC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $competition = $this->get_competition_data($result);
          if(!$competition['id']){
            return $this->id;
          }
          return $competition['id'];
        }
      }

//*************** GET COMPETITOR DATA *****************
    public function get_competition_data($result){
      $this->rows = mysqli_num_rows($result);
      $this->data = array();
      if($this->rows > 1){
        while($row = mysqli_fetch_assoc($result)){
          $this->data[] = array(
            'id'              =>    $row['competition_ID'],
            'name'            =>    $row['competition_name'],
            'location'        =>    $row['competition_location'],
            'details'         =>    $row['competition_details'],
            'date_entered'    =>    $row['competition_date_entered']
          );
        }
        $this->json = json_encode($this->data);

      }else{
        $row = mysqli_fetch_assoc($result);
        $this->data = array(
          'id'              =>    $row['competition_ID'],
          'name'            =>    $row['competition_name'],
          'location'        =>    $row['competition_location'],
          'details'         =>    $row['competition_details'],
          'date_entered'    =>    $row['competition_date_entered']
        );

        $this->json = json_encode($this->data);
      }
      return $this->data;
    }

  }

 ?>
