<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/8/15
 * Time: 9:32 PM
 * Has all the logic defined by the business, for example the price can't be less than 0. Also access the data layer.
 */
include "../DataLayer/DLBeerService.class.php";

class BLBeerService {

    private $data;

    function __construct(){
        $this->data = new DLBeerService();
    }

    public function getMethods(){
        return $this->data->getMethods();
    }

    public function getPrice($beer_name){
        return $this->data->getPrice($beer_name);
    }

    public function  setPrice($beer_name,$price){
        if(!$this->data->getBeerExists($beer_name)) return false;
        else if(!is_numeric($price) || $price<=0) return false;
        $this->data->setPrice($beer_name,$price);
        return true;
    }

    public function getBeers(){
        return $this->data->getBeers();
    }

    public function getCheapest(){
        return $this->data->getCheapestOrCostliest(true);
    }

    public function getCostliest(){
        return $this->data->getCheapestOrCostliest(false);
    }
}