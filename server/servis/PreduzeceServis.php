<?php

class PreduzeceServis{

    private $broker;

    public function __construct($b){
        $this->broker=$b;
    }
    public function vratiSve(){
        $data= $this->broker->izvrsiCitanje("select p.*, t.naziv as 'tipNaziv', g.naziv as 'gradNaziv' from preduzece p inner join tip_preduzeca t on (p.tip=t.id) inner join grad g on (p.grad=g.id)");
        $res=[];
        foreach($data as $element){
            $res[]=[
                "id"=>$data->id,
                "sifraDelatnosti"=>$data->sifra_delatnosti,
                "maticniBroj"=>$data->maticni_broj,
                "naziv"=>$data->naziv,
                "brojTelefona"=>$data->broj_telefona,
                "adresa"=>$data->adresa,
                "odgovornoLice"=>$data->odgovorno_lice,
                "grad"=>[
                    "id"=>$data->grad,
                    "naziv"=>$data->gradNaziv
                ],
                "tip"=>[
                    "id"=>$data->tip,
                    "naziv"=>$data->tipNaziv
                ]

            ];
        }
        return $res;
    }
    public function kreiraj($preduzeceDto){
        $this->broker->izvrsiIzmenu("insert into preduzece(sifra_delatnosti,maticni_broj,tip,naziv,broj_telefona,adresa,odgovorno_lice,grad)".
                                                    " values('".$preduzeceDto['sifraDelatnosti']."','".$preduzeceDto['maticniBroj']."',".$preduzeceDto['tip'].
                                                                ",'".$preduzeceDto['naziv']."','".$preduzeceDto['brojTelefona']."','".$preduzeceDto['adresa']."','".$preduzeceDto['odgovornoLice']."',".$preduzeceDto['grad'].")");
    }
    public function izmeni($id,$preduzeceDto){
        $this->broker->izvrsiIzmenu("update preduzece set naziv='".$preduzeceDto['naziv']."', sifra_delatnosti='".$preduzeceDto['sifraDelatnosti'].
                                        "', maticni_broj='".$preduzeceDto['maticniBroj']."', tip=".$preduzeceDto['tip'].
                                        ", broj_telefona='".$preduzeceDto['brojTelefona']."', adresa='".$preduzeceDto['adresa']."', odgovorno_lice='".$preduzeceDto['odgovornoLice'].
                                        "', grad=".$preduzeceDto['grad']." where id=".$id);
    }
    public function obrisi($id){
        $this->broker->izvrsiIzmenu("delete from preduzece where id=".$id);
    }
}


?>