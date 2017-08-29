<?php
  class Competitor{
    public $connection;
    public $db_name = 'mybod4god';
    public $table_name = 'competitors';
    public $id;
    public $email;
    public $firstname;
    public $lastname;
    public $phone;
    public $data;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
      $this->create_table();
    }

    public function create_competitor(){
      $sql = "INSERT INTO `".$this->table_name."` (
        `competitor_ID`,
        `competitor_email`,
        `competitor_firstname`,
        `competitor_lastname`,
        `competitor_phone`,
        `competitor_team_ID`,
        `competitor_date_entered`
      ) VALUES (
        NULL,
        '$this->email',
        '$this->firstname',
        '$this->lastname',
        '$this->phone',
        NULL,
        CURRENT_TIMESTAMP
      );";
      prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There has been an ERROR!!!<br>');
      }else{
        // echo('Competitor Added Successfully!!!<br>');
      }
    }

    public function get_table_name(){
      return $this->table_name;
    }

    public function get_db_name(){
      return $this->db_name;
    }

    public function create_table(){
      $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`competitors` ( ";
      $sql .= "`competitor_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT , ";
      $sql .= "`competitor_firstname` VARCHAR(100) NOT NULL , ";
      $sql .= "`competitor_lastname` VARCHAR(100) NOT NULL , ";
      $sql .= "`competitor_email` VARCHAR(100) NOT NULL , ";
      $sql .= "`competitor_phone` VARCHAR(20) NOT NULL , ";
      $sql .= "`competitor_team_ID` INT UNSIGNED NOT NULL , ";
      $sql .= "`competitor_date_entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , ";
      $sql .= "PRIMARY KEY (`competitor_ID`)";
      $sql .= ") ENGINE = InnoDB;";

      $result = mysqli_query($this->connection, $sql);
      if(!$result){
        echo('There was a problem creating the COMPETITORS table!!!<br>');
      }

    }

    public function get_all_competitors(){
      $sql = "SELECT * FROM competitors";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_competitor_data($result);
      }
    }
    public function get_competitor_by_id($id){
      $sql = "SELECT * FROM competitors WHERE competitor_ID='$id'";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return $this->get_competitor_data($result);
      }
    }
    public function add_competitor($params){
      $this->email       =   $params['email'];
      $this->firstname   =   $params['firstname'];
      $this->lastname    =   $params['lastname'];
      $this->phone       =   $params['phone'];
      $this->create_competitor();
    }
    public function edit_competitor($params){
      $this->id          =   $params['id'];
      $this->email       =   $params['email'];
      $this->firstname   =   $params['firstname'];
      $this->lastname    =   $params['lastname'];
      $this->phone       =   $params['phone'];
      $this->update_competitor();
    }
    public function delete_competitor($id){
      $this->id = $id;
      $this->destroy_competitor();
    }
// ***** Destroy Competitor *****
    public function destroy_competitor(){
      $sql = "DELETE FROM `competitors` WHERE competitor_ID='$this->id';";
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('There has been an ERROR deleting competitor...<br>');}
    }
// ***** Update Competitor *****
    public function update_competitor(){
      $sql = "UPDATE `competitors`
      SET `competitor_email` = '$this->email',
      `competitor_firstname` = '$this->firstname',
      `competitor_lastname` = '$this->lastname',
      `competitor_phone` = '$this->phone'
      WHERE `competitors`.`competitor_ID` = '$this->id';";

      prewrap($sql);

      $result = mysqli_query($this->connection, $sql);
      // if(!$result){
      //   echo('There has been a problem updating the competitor...<br>');
      // }else{
      //   header('Location: ./index.php');
      // }
    }
// ***** Get Max ID *****
    public function get_max_id(){
      $sql = "SELECT * FROM competitors ORDER BY competitor_ID DESC LIMIT 1";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        $competitor = $this->get_competitor_data($result);
        return $competitor['id'];
      }
    }
// ***** Does ID Exist *****
    public function id_exist($id){
      $sql = "SELECT * FROM competitors WHERE competitor_ID='$id';";
      $result = mysqli_query($this->connection, $sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    // *** Get Previous Competitor ***
      public function get_previous($id){
        $this->id = $id;
        $sql = "SELECT * FROM competitors
        WHERE competitor_ID < '$this->id'
        ORDER BY competitor_ID DESC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $competitor = $this->get_competitor_data($result);
          if(!$competitor['id']){
            return $this->id;
          }
          return $competitor['id'];
        }
      }
    // *** Get Next Competitor ***
      public function get_next($id){
        $this->id = $id;
        $sql = "SELECT * FROM competitors
        WHERE competitor_ID > '$this->id'
        ORDER BY competitor_ID ASC LIMIT 1;";
        $result = mysqli_query($this->connection, $sql);
        if($result){
          $competitor = $this->get_competitor_data($result);
          if(!$competitor['id']){
            return $this->id;
          }
          return $competitor['id'];
        }
      }

//*************** GET COMPETITOR DATA *****************
    public function get_competitor_data($result){
      $this->rows = mysqli_num_rows($result);
      $this->data = array();
      if($this->rows > 1){
        while($row = mysqli_fetch_assoc($result)){
          $this->data[] = array(
            'id'              =>    $row['competitor_ID'],
            'firstname'       =>    $row['competitor_firstname'],
            'lastname'        =>    $row['competitor_lastname'],
            'email'           =>    $row['competitor_email'],
            'phone'           =>    $row['competitor_phone'],
            'team_ID'         =>    $row['competitor_team_ID'],
            'date_entered'    =>    $row['competitor_date_entered']
          );
        }
        $this->json = json_encode($this->data);

      }else{
        $row = mysqli_fetch_assoc($result);
        $this->data = array(
          'id'              =>    $row['competitor_ID'],
          'firstname'       =>    $row['competitor_firstname'],
          'lastname'        =>    $row['competitor_lastname'],
          'email'           =>    $row['competitor_email'],
          'phone'           =>    $row['competitor_phone'],
          'team_ID'         =>    $row['competitor_team_ID'],
          'date_entered'    =>    $row['competitor_date_entered']
        );

        $this->json = json_encode($this->data);
      }
      return $this->data;
    }

  }

 ?>
