<?php
class Tables {
  
  /**
    *  @return Users
    */
  public function getusers(){
  
	$eredmeny = array("errorcode" => 0,
					  "msg" => "",
					  "users" => Array());
	
	try {
      $connection = Database::getConnection();
	  
	  $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
  
	  $sql = "select id, csaladi_nev, utonev, bejelentkezes, jogosultsag from felhasznalok order by id";
	  $sth = $connection->prepare($sql);
	  $sth->execute(array());
	  $eredmeny['users'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
	  $eredmeny["errorcode"] = 1;
	  $eredmeny["msg"] = $e->getMessage();
	}
	
	return $eredmeny;
  }

  
   
  /**
    *  @return Locations
    */
    public function getlocations(){
  
        $eredmeny = array("errorcode" => 0,
                          "msg" => "",
                          "locations" => Array());
        
        try {
          $connection = Database::getConnection();
          
          $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
      
          $sql = "select id, nev, megyeid from helyszin order by id";
          $sth = $connection->prepare($sql);
          $sth->execute(array());
          $eredmeny['locations'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
          $eredmeny["errorcode"] = 1;
          $eredmeny["msg"] = $e->getMessage();
        }
        
        return $eredmeny;
      }
    

    /**
    *  @return Counties
    */
    public function getcounties(){
  
        $eredmeny = array("errorcode" => 0,
                          "msg" => "",
                          "counties" => Array());
        
        try {
          $connection = Database::getConnection();
          
          $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
      
          $sql = "select id, nev, regio from megye order by id";
          $sth = $connection->prepare($sql);
          $sth->execute(array());
          $eredmeny['counties'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
          $eredmeny["errorcode"] = 1;
          $eredmeny["msg"] = $e->getMessage();
        }
        
        return $eredmeny;
      }
  

      
    /**
    *  @return Towers
    */
    public function gettowers(){
  
        $eredmeny = array("errorcode" => 0,
                          "msg" => "",
                          "towers" => Array());
        
        try {
          $connection = Database::getConnection();
          
          $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
      
          $sql = "select id, darab, teljesitmeny, kezdev, helyszinid from megye order by id";
          $sth = $connection->prepare($sql);
          $sth->execute(array());
          $eredmeny['towers'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
          $eredmeny["errorcode"] = 1;
          $eredmeny["msg"] = $e->getMessage();
        }
        
        return $eredmeny;
      }
  
}


class User {
  /**
   * @var int
   */
  public $id;

  /**
   * @var string
   */
  public $csaladi_nev;

  /**
   * @var string
   */
  public $utonev;

  /**
   * @var string
   */
  public $bejelentkezes;

  /**
   * @var string
   */
  public $jogosultsag;  
}

class Users {
  /**
   * @var integer
   */
  public $errorcode;

  /**
   * @var string
   */
  public $msg;  

  /**
   * @var User[]
   */
  public $users;  
}

class Location {
    /**
     * @var int
     */
    public $id;
  
    /**
     * @var string
     */
    public $nev;
  
    /**
     * @var int
     */
    public $megyeid;
  
  }
  
  class Locations {
    /**
     * @var integer
     */
    public $errorcode;
  
    /**
     * @var string
     */
    public $msg;  
  
    /**
     * @var Location[]
     */
    public $Locations;  
  }
  
  class County{
    /**
     * @var int
     */
    public $id;
  
    /**
     * @var string
     */
    public $nev;
  
    /**
     * @var int
     */
    public $regio;
  
  }
  
  class Counties {
    /**
     * @var integer
     */
    public $errorcode;
  
    /**
     * @var string
     */
    public $msg;  
  
    /**
     * @var County[]
     */
    public $Counties;  
  }


  class Tower{
    /**
     * @var int
     */
    public $id;
  
    /**
     * @var int
     */
    public $darab;
  
    /**
     * @var int
     */
    public $teljesitmeny;

    /**
     * @var int
     */
    public $kezdev;

    /**
     * @var int
     */
    public $helyszinid;
  
  }
  
  class Towers {
    /**
     * @var integer
     */
    public $errorcode;
  
    /**
     * @var string
     */
    public $msg;  
  
    /**
     * @var Tower[]
     */
    public $Towers;  
  }


?>