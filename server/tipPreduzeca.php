<?php
include './controller/Controller.php';
include './servis/TipPreduzecaServis.php';
include 'broker.php';
$controller =new Controller();
$controller->dodajDep('tipServis',new TipPreduzecaServis(Broker::getInstance()));
$controller->dodajPutanju('GET','vratiSve',function($deps){
     $tipServis=$deps['tipServis'];
     return $tipServis->vratiSve();
});

echo json_encode($controller->izvrsi());


?>