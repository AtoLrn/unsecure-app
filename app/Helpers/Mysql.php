<?php

namespace App\Helpers;

class Mysql
{
  public $conn;

  public function __construct()
  {
    $this->conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
    mysqli_set_charset($this->conn, 'utf-8');

    if ($this->conn->connect_errno) {
      echo "Failed to connect to MySQL";
      exit();
    }
  }

  private function clearString(?string $param): ?string
  {
    return is_null($param) ? $param : addslashes(htmlspecialchars($param));
  }

  public function like($table, $query = '*', $where = [])
  {
    $sql = 'SELECT '.$query.' FROM '.$table;

    if($where) {
      $output = ' WHERE ';

      foreach ($where as $key => $q) {

        $where[$key] = $key." LIKE '%".$this->clearString($q)."%'";
      }

      $output .= implode(' AND ', $where);
      $sql .= $output;
    }

    $result = mysqli_multi_query($this->conn, $sql);

    if(!$result) return $result;

    $output = [];

    if ($result = $this->conn->store_result()) {
       while($row = mysqli_fetch_assoc($result)) {
          $output[] = $row;
       }
    }
    return $output;
  }

  public function select($table, $query = '*', $where = [])
  {
    $sql = 'SELECT '.$query.' FROM '.$table;

    $values = array_values($where);

    if($where) {
      $output = ' WHERE ';

      foreach ($where as $key => $q) {
        $where[$key] = $key." = ?";
      }

      $output .= implode(' AND ', $where);
      $sql .= $output;
    }

    //$result = mysqli_multi_query($this->conn, $sql);
    $types = "";
    for($i = 0; $i < count($values); $i++) {
      $types .= "s";

    }
    $req =  mysqli_prepare($this->conn, $sql);
    mysqli_stmt_bind_param($req, $types, ...array_map(function($val) {
      return $this->clearString($val);
    }, $values));
    mysqli_stmt_execute($req);
    $result = mysqli_stmt_get_result($req);

    if(!$result)  return $result; 
    $output = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      $output [] = $row;
      
   }
    return $output;
  }

  public static function mapData($n)
  {
      $n = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($n)), null, 'UTF-8');

        return "'".$n."'";
  }

  public function insert($table, $data)
  {

    $sql = 'INSERT INTO '.$table.' (';

    $values = array_values($data);
    $values = array_map(function ($val) {
      return $this->clearString($val);
    },$values);
    $keys = array_keys($data);

    $values = array_map('self::mapData', $values);

    $format = [];
    $types = "";
    for($i = 0; $i < count($values); $i++) {
      $format[]= "?";
      $types .= "s";

    }
    $sql .= implode(",", $keys).") VALUES (";
    $sql .= implode(",", $format).");";

    $req =  mysqli_prepare($this->conn, $sql);
    mysqli_stmt_bind_param($req, $types, implode(array_map(function($val) {
      return $this->clearString($val);
    }, $values), ","));
    $result = mysqli_stmt_execute($req);

    if ($result === true) {
      return true;
    } else {
      dd($this->conn->error);
    }

  }

  public function boot()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `articles` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(235) NOT NULL,
      `content` varchar(235) NOT NULL,
      `author` varchar(235) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";

    $result = mysqli_multi_query($this->conn, $sql);
  }

  public function __destruct()
  {
     mysqli_close($this->conn);
  }
}
