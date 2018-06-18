<?php
//Lees de config file voor de database-verbinding
require "../../config.php";

//Stel de root-map en directory separator vast
define("ROOT", dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);

//Stel de autoloader in
spl_autoload_register(function ($class){
   //Check of de class bestaat in de controllers map
    if (file_exists(ROOT . DS . 'controllers' . DS . $class . '.php')){
        include ROOT. DS .'controllers' . DS . $class . '.php';
    }
    //Check of de class bestaat in de models map
    if (file_exists(ROOT . DS . 'models' . DS . $class . '.php')){
        include ROOT. DS .'models' . DS . $class . '.php';
    }
});

//Lees de URL-variant in arrays in
$request_uri = explode("/", $_SERVER["REQUEST_URI"]);
$script_name = explode("/", $_SERVER["SCRIPT_NAME"]);

//Verwijder de gelijke delen
for ($i=0; $i < count($script_name); $i++){
    if ($request_uri[$i] == $script_name[$i]){
        unset($request_uri[$i]);
    }
}

//Maak een array van de overgebleven URL-delen
$command = array_values($request_uri);

if ($command[0] == ""){
    //Instantieer de AutoController
    $ctr = new AutoController();

    //Toon de autolijst
    $ctr->index();
}else if($command[0] == "auto" && is_numeric($command[1])){
    //Instantieer de BookController
    $ctr = new AutoController();

    //Toon de boekenlijst
    $ctr->showAuto($command[1]);
}else if($command[0] == "auto" && $command[1] == "save" && is_numeric($command[2])){
    $ctr = new AutoController();
    //Sla de auto op
    $ctr->saveAuto($_POST["id"], $_POST["kenteken"], $_POST["merk"], $_POST["type"], $_POST["kleur"], $_POST["bouwjaar"]);

    //Ga terug naar de index
    header("Location:../../");
}else if($command[0] == "auto" && $command[1] == "save"){
    $ctr = new AutoController();
    //Sla de auto op
    $ctr->saveAuto($_POST["id"], $_POST["kenteken"], $_POST["merk"], $_POST["type"], $_POST["kleur"], $_POST["bouwjaar"]);

    //Ga terug naar de index
    header("Location:../");
}
else if($command[0] == "auto" && $command[1] == "new"){
    $ctr = new AutoController();

    $ctr->newAuto();
}
else{
    echo "Onbekende opdracht";
    var_dump($command);
}