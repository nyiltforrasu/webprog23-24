<?php

$userName="";
$age=0;
$email="";
$job="";

if(isset($_POST['displayName'])){
    $userName = filter_var(trim($_POST['displayName']), FILTER_SANITIZE_STRING);
    setcookie('displayName', $userName, 0,"/","localhost",false,false);
}
if(isset($_POST['age'])){
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);

}
if(isset($_POST['email'])){
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    setcookie('email', $email, 0,"/","localhost",false,false);
}
if(isset($_POST['title'])){
    $job = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
}


$file = "users.csv";
if(file_exists($file)){
    $handle = fopen($file, 'a') or die("Nem sikerult megnyitni a fajlt!");
    fwrite($handle, "\n".$userName.", ".$age.", ".$email.", ".$job);
    fclose($handle);
}
header('Location: index.php?success=true');