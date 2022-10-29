<?php
const HOST = 'localhost';
const DATABASE = 'szeleromuvek';
const USER = 'root';
const PASSWORD = '';
class Tables {


   
  /**
    *  @return Locations
    */
    public function getlocations(){
  
        $eredmeny = array("errorcode" => 0,
                          "msg" => "",
                          "locations" => Array());
        
        try {
            $connection = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          
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
            $connection = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          
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
            $connection = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          
          $connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
      
          $sql = "select id, darab, teljesitmeny, kezdev, helyszinid from torony order by id";
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
    public $locations;  
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
    public $counties;  
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
    public $towers;  
  }
