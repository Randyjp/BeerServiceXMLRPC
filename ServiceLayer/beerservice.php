<?php
/**
 * Created by PhpStorm.
 * User: randyjp
 * Date: 4/8/15
 * Time: 10:42 PM
 * This is the PHP file which the user can access, it calls the service layer class with the proper params.
 * Also strips the XML tags from the parameters in order to process the request.
 * Declaration of server and signature it's also done here.
 *
 */
include "SLBeerService.class.php";

    function getMethods($params){
        $sl = new SLBeerService();
        return $sl->getMethods();
    }

    function getPrice($params){
        $sl = new SLBeerService();
        $name = $params->getParam(0)->scalarval();
        return $sl->getPrice($name);
    }

    function setPrice($params){
        $sl = new SLBeerService();
        $name = $params->getParam(0)->scalarval();
        $price = $params->getParam(1)->scalarval();
        return $sl->setPrice($name,$price);
    }

    function getBeers($params){
        $sl = new SLBeerService();
        return $sl->getBeers();
    }

    function getCheapest($params){
        $sl = new SLBeerService();
        return $sl->getCheapest();
    }

    function getCostliest($params){
        $sl = new SLBeerService();
        return $sl->getCostliest();
    }

    //method signatures
    $getMethods_sig = array(array($xmlrpcArray));
    $getPrice_sig = array(array($xmlrpcString,$xmlrpcString));
    $setPrice_sig = array(array($xmlrpcString,$xmlrpcString,$xmlrpcDouble));
    $getBeers_sig = array(array($xmlrpcArray));
    $getCheapest_sig = array(array($xmlrpcString));
    $getCostliest_sig = array(array($xmlrpcString));

    //methods documentation
    $getMethods_doc = "Returns all the methods available in the service";
    $getPrice_doc = "Returns the price of a given beer";
    $setPrice_doc = "Sets the price of a given beer";
    $getBeers_doc = "Returns a list with all the beers";
    $getCheapest_doc = "Returns the cheapest beer";
    $getCostliest_doc = "Returns the costliest beer";

    //server declaration with methods names and signature.
    new xmlrpc_server(array(
        "beer.getMethods" =>
        array("function" => "getMethods",
        "signature" => $getMethods_sig,
        "docstring" => $getMethods_doc),
        "beer.getPrice" =>
        array("function" => "getPrice",
            "signature" => $getPrice_sig,
            "docstring" =>$getPrice_doc),
        "beer.setPrice" =>
        array("function" => "setPrice",
            "signature" => $setPrice_sig,
            "docstring" => $setPrice_doc),
        "beer.getBeers" =>
        array("function" => "getBeers",
            "signature" => $getBeers_sig,
            "docstring" => $getBeers_doc),
        "beer.getCheapest" =>
        array("function" => "getCheapest",
            "signature" => $getCheapest_sig,
            "docstring" =>$getBeers_doc),
        "beer.getCostliest" =>
            array("function" => "getCostliest",
                "signature" => $getCostliest_sig,
                "docstring" =>$getCostliest_doc)
    ));