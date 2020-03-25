<?php

//@TODO insert your code here

require_once('includes/classes/Database.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'web_ue06');
define('DB_USER', 'sophia');
define('DB_PASS', 'bPN5tM3mPM7ffACm');

$db = new Database();
$cryptedPassword = password_hash('testpass', PASSWORD_BCRYPT);
$username = "testuser";

$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

//$sql = "INSERT INTO user(name,`password`) VALUES('" . $username . "','" . $cryptedPassword . "')";
//$db->query($sql);


$sql = "SELECT * FROM user WHERE name='" . $username . "'";
$result = $db->query($sql);

//schaut ob es results gibt
if ($db->numRows($result) > 0) { //anzahl zeilen mehr als 0
    //kein while nötig – wir wissen es gibt nur einen Wert. Mehrere Zeilen könnte man
    //mit while($row = $db->fetchAssoc($result)) //herausholen
    $row = $db->fetchAssoc($result);
    //fetch Assoc heißt man greift auf die Spalten wie folgt zu:
    //$row['spaltenname'];
    //fetchObject würde heißen man greift auf die Spalten so zu:
    //$row->spaltenname;
    //In Java und JavaScript greifen Sie Objektorientiert mittels . zu
    //z.B. row.spaltenname. Das ist in PHP anders.y

    //passwort wird gecheckt, ob es mit dem user übereinstimmt
    if (password_verify("testpass", $row['password'])) {
        echo "Der Nutzer " . $username . " mit der ID " . $row['id'] . " hat";
        echo " das Passwort testpass";
    } else {
        echo "Nutzer gefunden aber falsches Passwort!";
    }
} else {
    echo "Keinen Nutzer gefunden";
}

