<html lang="hu">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <?php
    session_start();
    if(isset($_POST['login'])){
        $_SESSION['username'] = $_POST['userName'];
    }elseif (isset($_POST['logout'])){
        unset($_SESSION['username']);
        session_destroy();
    }

    if(!isset($_SESSION["username"])) {
       echo "<form method='post'>
            <input type='hidden' name='login' value='true'>
            <input type = 'text' id = 'userName' name = 'userName'  required>
            <input type = 'email' id = 'loginEmail' name = 'loginEmail'  required>
            <input type='submit' value='Bejelentkezes'>
       </form>";
    } else {
        echo '<form method="post">
            <input type="hidden" name="logout">
            <p>Szia '.$_SESSION['username'].'</p>
            <button> Kijelentkezes</button >
        </form>';
    }
    ?>

<?php


$file = "users.csv";
if(file_exists($file)){
    $handle = fopen($file, 'r') or die("Nem sikerult megnyitni a fajlt!");

    echo "<table>";
    while (!feof($handle)){
        $line = fgetcsv($handle);
        echo "<tr>";
        foreach ($line as $item)
            echo "<td>".$item."</td>";
        echo "</tr>";
    }
    echo "</table>";
    fclose($handle);
}

//logging

$handle;

$counter=1;
if(file_exists("visit.log")) {
    $handle = fopen("visit.log","r");
    $line = fgetcsv($handle);
    $counter = (int)$line[0];
    $counter=$counter+1;
    fclose($handle);
}
$handle = fopen("visit.log","w");
fwrite($handle, $counter.", ".date("Y.M.D.h.m.s").", ".$_SERVER['REMOTE_ADDR']);
fclose($handle);

?>
</body>
</html>
