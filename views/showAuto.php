<!doctype html>
<html>
<head>
    <title>Auto info</title>
</head>
<body>
<h1>Auto info</h1>

<?php
//Zijn er boeken om weer te geven
if (count($autos) > 0) {
    foreach ($autos as $auto) {
        echo "<form method='post' action='save/".$auto->id."'>";
        echo "Kenteken: <br/>";
        echo "<input type='text' name='kenteken' value='".$auto->kenteken."'> <br/>";
        echo "Merk: <br/>";
        echo "<input type='text' name='merk' value='".$auto->merk."'> <br/>";
        echo "Type: <br/>";
        echo "<input type='text' name='type' value='".$auto->type."'> <br/>";
        echo "Kleur: <br/>";
        echo "<input type='text' name='kleur' value='".$auto->kleur."'> <br/>";
        echo "Bouwjaar: <br/>";
        echo "<input type='text' name='bouwjaar' value='".$auto->bouwjaar."'> <br/>";
        echo "<input type='hidden' name='id' value='".$auto->id."'>";
        echo "<input type='submit' value='Opslaan' name='submit'>";
        echo "</form>";
    }
}
?>
</body>
</html>