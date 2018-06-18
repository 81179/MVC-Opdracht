<?php

class AutoController
{
    public function index(){
        global $mysqli;

        //Lees de id's van alle boeken
        $result = mysqli_query($mysqli, "SELECT id FROM mphp6_autos ORDER BY id ASC ");
        //Zijn er boeken gevonden
        if(mysqli_num_rows($result)>0) {
            //maak een Array van alle boeken
            $autos = array();
            //Voeg alle boeken toe aan de array
            while($row = mysqli_fetch_array($result)){
                $autos[] = new Auto($row["id"]);
            }
            //Toon de lijst
            include ("views/autoOverzicht.php");
        }else{
            return false;
        }

    }

    public function showAuto($id){
        global $mysqli;

        //Zoek het boek met het juiste id
        $result = mysqli_query($mysqli, "SELECT id FROM mphp6_autos WHERE id = {$id}");

        if($result){
            //maak een Array van alle boeken
            $autos = array();
            //Voeg alle boeken toe aan de array
            while($row = mysqli_fetch_array($result)){
                $autos[] = new Auto($row["id"]);
            }
            //Toon de lijst
            include ("views/showAuto.php");
        }
        else{
            return false;
        }
    }

    public function saveAuto($id = null, $kenteken, $merk, $type, $kleur = "", $bouwjaar = ""){
        $auto = new Auto($id, $kenteken, $merk, $type, $kleur, $bouwjaar);
    }

    public function newAuto(){
        include ("views/newAuto.php");
    }

}