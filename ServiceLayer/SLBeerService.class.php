<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/8/15
 * Time: 10:16 PM
 * This layer is in charge of calling the Business layer and also adding the XML tags to the respond.
 */
include "../lib/xmlrpc.inc.php";
include "../lib/xmlrpcs.inc.php";
include "../lib/xmlrpc_wrappers.inc.php";
include "../BusinessLayer/BLBeerService.class.php";


class SLBeerService {

    private $bl;

    function __construct(){
        $this->bl = new BLBeerService();
    }

    public function getMethods(){
        $methods = array();
        foreach($this->bl->getMethods() as $method){
            array_push($methods,new xmlrpcval($method,"string"));
        }
        return new xmlrpcresp(new xmlrpcval($methods,"array"));
    }

    public function getPrice($name){
        return new xmlrpcresp(new xmlrpcval($this->bl->getPrice($name),"double"));
    }

    function setPrice($name,$price){
        return new xmlrpcresp(new xmlrpcval($this->bl->setPrice($name,$price),"boolean"));
    }

    function getBeers(){
        $beers = array();
        foreach($this->bl->getBeers() as $beer){
            array_push($beers,new xmlrpcval($beer,"string"));
        }
        return new xmlrpcresp(new xmlrpcval($beers,"array"));
    }

    function getCheapest(){
        return new xmlrpcresp(new xmlrpcval($this->bl->getCheapest(),"string"));
    }

    function getCostliest(){
        return new xmlrpcresp(new xmlrpcval($this->bl->getCostliest(),"string"));
    }
}