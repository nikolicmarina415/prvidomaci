<?php
include './controller/Controller.php';
include './servis/PreduzeceServis.php';
include 'broker.php';
$controller =new Controller();
$controller->dodajDep('preduzeceServis',new PreduzeceServis(Broker::getInstance()));

$controller->dodajPutanju('GET','vratiSve',function($deps){
     $preduzeceServis=$deps['preduzeceServis'];
     return $preduzeceServis->vratiSve();
});

$controller->dodajPutanju('POST','kreiraj',function($deps){
    $preduzeceServis=$deps['preduzeceServis'];
    return $preduzeceServis->kreiraj($_POST);
});

$controller->dodajPutanju('POST','izmeni',function($deps){
    $preduzeceServis=$deps['preduzeceServis'];
    return $preduzeceServis->izmeni($_GET['id'],$_POST);
});

$controller->dodajPutanju('POST','obrisi',function($deps){
    $preduzeceServis=$deps['preduzeceServis'];
    return $preduzeceServis->obrisi($_GET['id']);
});

echo json_encode($controller->izvrsi());


?>