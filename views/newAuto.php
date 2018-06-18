<!doctype html>
<html>
<head>
    <title>Auto info</title>
</head>
<body>
<h1>Auto info</h1>

<?php
//Zijn er boeken om weer te geven
    echo "<form method='post' action='save'>";
    echo "Kenteken: <br/>";
    echo "<input type='text' name='kenteken' required='required'> <br/>";
    echo "Merk: <br/>";
    echo "<input type='text' name='merk' required='required'> <br/>";
    echo "Type: <br/>";
    echo "<input type='text' name='type' required='required'> <br/>";
    echo "Kleur: <br/>";
    echo "<input type='text' name='kleur'> <br/>";
    echo "Bouwjaar: <br/>";
    echo "<input type='text' name='bouwjaar'> <br/>";
    echo "<input type='submit' value='Opslaan' name='submit'>";
    echo "</form>";

?>
</body>
</html>