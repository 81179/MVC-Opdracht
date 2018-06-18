<!doctype html>
<html>
<head>
    <title>Auto lijst</title>
</head>
<body>
<h1>Auto lijst</h1>

<?php
//Zijn er boeken om weer te geven
if (count($autos) > 0){
    echo "<table>";
    echo "<tr>";
    echo"<th>Kenteken</th>";
    echo"<th>Merk</th>";
    echo"<th>Type</th>";
    echo"<th>Kleur</th>";
    echo"<th>Bouwjaar</th>";
    echo"<th>Link</th>";
    echo"</tr>";

    //Lees alle boeken
    foreach ($autos as $auto){
        echo "<tr>";
        echo "<td>".$auto->kenteken."</td>";
        echo "<td>".$auto->merk."</td>";
        echo "<td>".$auto->type."</td>";
        echo "<td>".$auto->kleur."</td>";
        echo "<td>".$auto->bouwjaar."</td>";
        echo "<td><a href='auto/".$auto->id."'>Auto</a></td>";
    }

    //Sluit de tabel af
    echo "</table>";

    echo "<br/> <a href='auto/new'>Auto toevoegen</a>";
}

?>
</body>
</html>