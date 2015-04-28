<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/7/15
 * Time: 10:42 PM
 * Only layer capable of accessing the database, runs queries and sends them to the business layer.
 */

class DLBeerService {

    private $mysqli;

     function __construct(){
         require "/home/rjp7034/db_conn.php";
         $this->mysqli = new mysqli($host,$user,$pass,$database);

         if($this->mysqli->connect_error){
             echo "Connection Failed" . $this->mysqli->connect_error;
             exit();
         }
     }

    public function getMethods(){
        $methods = array("getMethods()","getPrice(String beer)","setPrice(String beer, Double price)","getBeers()",
                        "getCheapest()","getCostliest()");
        //$methods = get_class_methods("DLBeerService");
        return $methods;
    }

    public function getPrice($beer_name){
        $query = "SELECT Price FROM beer WHERE BeerName = ?";

        if($stmt = $this->mysqli->prepare($query)){
            $stmt->bind_param("s",$beer_name);
            $stmt->execute();
            $stmt->store_result();
        }
        if($stmt->num_rows==0) return 0.0;
        $stmt->bind_result($price);
        $stmt->fetch();
        return $price;
    }

    public function getBeerExists($beer_name){
        $query = "SELECT * FROM beer WHERE BeerName = ?";

        if($stmt = $this->mysqli->prepare($query)){
            $stmt->bind_param("s",$beer_name);
            $stmt->execute();
            $stmt->store_result();
        }
        if($stmt->num_rows==0) return false;
        return true;
    }

    public function setPrice($beer_name,$price){
        $query = "  UPDATE beer
                    SET price=?
                    WHERE  BeerName=?";

        if($stmt = $this->mysqli->prepare($query)){
            $stmt->bind_param("ds",$price,$beer_name);
            $stmt->execute();
        }
    }

    public function getBeers(){
        $query = "SELECT BeerName FROM beer";

        if($stmt = $this->mysqli->prepare($query)){
            $stmt->execute();
            $stmt->store_result();
        }
        $beers =array();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($beer_name);

        if($num_rows>0){
            while($stmt->fetch()){
                //echo "<option value='$id'>$name - $des</option>";
                array_push($beers,$beer_name);
            }
        }
        return $beers;
    }

    public function getCheapestOrCostliest($cheapest){
        if($cheapest)
            $query = "SELECT BeerName FROM beer WHERE PRICE = (SELECT MIN(price) FROM beer)";
        else{
            $query = "SELECT BeerName FROM beer WHERE PRICE = (SELECT MAX(price) FROM beer)";
        }

        if($stmt = $this->mysqli->prepare($query)){
            $stmt->execute();
            $stmt->store_result();
        }
        $stmt->bind_result($beer_name);
        $stmt->fetch();
        return $beer_name;
    }


}