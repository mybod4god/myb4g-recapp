<?php
  class Week{
    public $connection;
    public $db_name = 'mybod4god';
    public $table_name = 'weeks';
    public $id;
    public $name;
    public $description;
    public $code;
    public $scripture;
    public $bod4god;
    public $sss;
    public $start;
    public $end;
    public $data;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
      $this->create_table();
    }

    public function create_week(){
      $sql = "INSERT INTO `weeks` (
        `week_ID`,
        `week_name`,
        `week_description`,
        `week_code`,
        `week_scripture`,
        `week_bod4god`,
        `week_sss`,
        `week_start`,
        `week_end`,
        `week_date_entered`
      ) VALUES (
        NULL,
        '$this->name',
        '$this->description',
        '$this->code',
        '$this->scripture',
        '$this->bod4god',
        '$this->sss',
        '$this->start',
        '$this->end',
        CURRENT_TIMESTAMP
      );";
      // prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There has been an ERROR!!!<br>');
      }else{
        // echo('Week Added Successfully!!!<br>');
      }
    }

    public function get_table_name(){
      return $this->table_name;
    }

    public function get_db_name(){
      return $this->db_name;
    }

    public function create_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`weeks` ( ";
      $sql .= "`week_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT , ";
      $sql .= "`week_name` VARCHAR(100) NOT NULL , ";
      $sql .= "`week_description` VARCHAR(100) NOT NULL , ";
      $sql .= "`week_code` VARCHAR(100) NOT NULL , ";
      $sql .= "`week_scripture` VARCHAR(255) NOT NULL , ";
      $sql .= "`week_bod4god` VARCHAR(255) NOT NULL , ";
      $sql .= "`week_sss` VARCHAR(255) NOT NULL , ";
      $sql .= "`week_start` VARCHAR(20) NOT NULL , ";
      $sql .= "`week_end` VARCHAR(20) NOT NULL , ";
      $sql .= "`week_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , ";
      $sql .= "PRIMARY KEY (`week_ID`)";
      $sql .= ") ENGINE = InnoDB;";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There was a problem creating the TEAMS table!!!<br>');
      }

    }

    public function get_all_weeks(){
      $sql = "SELECT * FROM weeks";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_week_data($result);
      }
    }
    public function get_week_by_id($id){
      $sql = "SELECT * FROM weeks WHERE week_ID='$id'";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_week_data($result);
      }
    }
    public function add_week($params){
      $this->name           =   $params['name'];
      $this->description    =   $params['description'];
      $this->code           =   $params['code'];
      $this->scripture      =   $params['scripture'];
      $this->bod4god        =   $params['bod4god'];
      $this->sss            =   $params['sss'];
      $this->start          =   $params['start'];
      $this->end            =   $params['end'];
      $this->create_week();
    }
    public function edit_week($params){
      $this->id             =   $params['id'];
      $this->name           =   $params['name'];
      $this->description    =   $params['description'];
      $this->code           =   $params['code'];
      $this->scripture      =   $params['scripture'];
      $this->bod4god        =   $params['bod4god'];
      $this->sss            =   $params['sss'];
      $this->start          =   $params['start'];
      $this->end            =   $params['end'];
      $this->update_week();
    }
    public function delete_week($id){
      $this->id = $id;
      $this->destroy_week();
    }
// ***** Destroy Week *****
    public function destroy_week(){
      $sql = "DELETE FROM `weeks` WHERE week_ID='$this->id';";
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('There has been an ERROR deleting week...<br>');}
    }
// ***** Update Week *****
    public function update_week(){
      $sql = "UPDATE `weeks`
      SET `week_name` = '$this->name',
      `week_description` = '$this->description',
      `week_code` = '$this->code',
      `week_scripture` = '$this->scripture',
      `week_bod4god` = '$this->bod4god',
      `week_description` = '$this->description',
      `week_description` = '$this->description',
      `week_description` = '$this->description',
      WHERE `weeks`.`week_ID` = '$this->id';";

      prewrap($sql);

      $result = mysqli_query($this->connection, $sql);
      // if(!$result){
      //   echo('There has been a problem updating the week...<br>');
      // }else{
      //   header('Location: ./index.php');
      // }
    }
// ***** Get Max ID *****
    public function get_max_id(){
      $sql = "SELECT * FROM weeks ORDER BY week_ID DESC LIMIT 1";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        $week = $this->get_week_data($result);
        return $week['id'];
      }
    }
// ***** Does ID Exist *****
    public function id_exist($id){
      $sql = "SELECT * FROM weeks WHERE week_ID='$id';";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    // *** Get Previous Week ***
      public function get_previous($id){
        $this->id = $id;
        $sql = "SELECT * FROM weeks
        WHERE week_ID < '$this->id'
        ORDER BY week_ID DESC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $week = $this->get_week_data($result);
          if(!$week['id']){
            return $this->id;
          }
          return $week['id'];
        }
      }
    // *** Get Next Week ***
      public function get_next($id){
        $this->id = $id;
        $sql = "SELECT * FROM weeks
        WHERE week_ID > '$this->id'
        ORDER BY week_ID ASC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $week = $this->get_week_data($result);
          if(!$week['id']){
            return $this->id;
          }
          return $week['id'];
        }
      }

//*************** GET COMPETITOR DATA *****************
    public function get_week_data($result){
      $this->rows = mysqli_num_rows($result);
      $this->data = array();
      if($this->rows > 1){
        while($row = mysqli_fetch_assoc($result)){
          $this->data[] = array(
            'id'              =>    $row['week_ID'],
            'name'            =>    $row['week_name'],
            'leader'          =>    $row['week_leader'],
            'date_entered'    =>    $row['week_date_entered']
          );
        }
        $this->json = json_encode($this->data);

      }else{
        $row = mysqli_fetch_assoc($result);
        $this->data = array(
          'id'              =>    $row['week_ID'],
          'name'            =>    $row['week_name'],
          'leader'          =>    $row['week_leader'],
          'date_entered'    =>    $row['week_date_entered']
        );

        $this->json = json_encode($this->data);
      }
      return $this->data;
    }

  }

 ?>
