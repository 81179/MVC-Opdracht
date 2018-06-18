<?php

/**
 * Created by PhpStorm.
 * User: 81179
 * Date: 20/02/2018
 * Time: 10:08
 */
class Auto
{
    public $id = null;
    public $kenteken;
    public $merk;
    public $type;
    public $kleur = "";
    public $bouwjaar = 0;


    public function __construct($id = null, $kenteken = "", $merk = "", $type = "", $kleur = "", $bouwjaar = 0)
    {
        //is er een ID mee gegeven
        if(!is_null($id)){
            //zijn er andere data mee gegeven
            if (strlen($kenteken) > 0 && strlen($merk) > 0 && strlen($type) > 0){
                $this->id = $id;
                $this->kenteken = $kenteken;
                $this->merk = $merk;
                $this->type = $type;
                $this->kleur = $kleur;
                $this->bouwjaar = $bouwjaar;
                //Sla de auto op
                $this->save();
            }else {
                //Laad de info over de auto uit de database
                $this->load($id);
            }
        }else{
            $this->id = null;
            $this->kenteken = $kenteken;
            $this->merk = $merk;
            $this->type = $type;
            $this->kleur = $kleur;
            $this->bouwjaar = $bouwjaar;
            //Sla de auto op
            $this->save();
        }
    }

    private function load($id){
        global $mysqli;

        //Zoek het juiste boek in de database
        $result = mysqli_query($mysqli, "SELECT * FROM mphp6_autos WHERE id = {$id}");

        //Hoeveel boeken zijn er gevonden met dit id
        if (mysqli_num_rows($result) ==1){
            //Lees de data van het boek uit
            $row = mysqli_fetch_array($result);

            //Vul de properties van dit boek in
            $this->id = $row["id"];
            $this->kenteken = $row["kenteken"];
            $this->merk = $row["merk"];
            $this->type = $row["type"];
            $this->kleur = $row["kleur"];
            $this->bouwjaar = $row["bouwjaar"];
        }
        else{
            //Er ging wat mis
            throw new Exception("Kan de auto met Id ". $id ." niet vinden.");
        }
    }

    public function save(){
        global $mysqli;

        //Schoon de tekst op
        $this->kenteken = htmlentities(html_entity_decode($this->kenteken, ENT_QUOTES), ENT_QUOTES);
        $this->merk = htmlentities(html_entity_decode($this->merk, ENT_QUOTES), ENT_QUOTES);
        $this->type = htmlentities(html_entity_decode($this->type, ENT_QUOTES), ENT_QUOTES);
        $this->kleur = htmlentities(html_entity_decode($this->kleur, ENT_QUOTES), ENT_QUOTES);
        $this->bouwjaar = htmlentities(html_entity_decode($this->bouwjaar, ENT_QUOTES), ENT_QUOTES);

        //Controleer of alle gegevens aanwezig zijn
        if (strlen($this->kenteken) > 0 && strlen($this->merk) > 0 && strlen($this->type) > 0 && strlen($this->kleur) > 0 && strlen($this->bouwjaar) > 0){
            //Controleer of dit een nieuw of bestaand boek is
            if (is_null($this->id)) {
                $result = mysqli_query($mysqli, "INSERT INTO mphp6_autos VALUES 
                (NULL,'$this->kenteken', '$this->merk','$this->type','$this->kleur','$this->bouwjaar')");
                //Controleer of alles goed is gegaan
                if ($result){
                    $opgeslagen = "auto opgeslagen";
                }
                else{
                    throw new Exception("Er is iets fout gegaan bij het invoegen");
                    $opgeslagen = "Fout bij invoegen";
                }
            }
            else{
                $result = mysqli_query($mysqli, "UPDATE mphp6_autos SET 
                kenteken = '$this->kenteken', merk = '$this->merk', type = '$this->type', kleur = '$this->kleur', bouwjaar = '$this->bouwjaar' WHERE id = '$this->id'");
                if ($result){
                    $opgeslagen = "Auto opgeslagen";
                }
                else{
                    throw new Exception("Er is iets fout gegaan bij het invoegen");
                }
            }
        }else{
            $opgeslagen = "Fout bij invoer";
        }
        return $opgeslagen;
    }
}