<?php
   $db = mysqli_connect("localhost", "root", "", "dnevnik");

   // ellenőrizzük hogy sikerült-e a kapcsolatfelvétel az adatbázissal
   if (mysqli_connect_errno()) {
      die("HIBA az adatbázishoz való kapcsolódás során: " . mysqli_connect_error());
   }

   $name = isset($_GET["name"]) ? $_GET["name"] : "";
   $sql = "SELECT kereszt, vezetek FROM ucenik " .
            "WHERE (vezetek LIKE CONCAT(?, '%') OR kereszt LIKE CONCAT(?, '%')) LIMIT 10"; 
   $stmt = mysqli_prepare($db, $sql);

   if (!$stmt)
      die(mysqli_error($db));

   $stmt->bind_param("ss", $name,$name);

   mysqli_stmt_execute($stmt);
   if (mysqli_stmt_error($stmt))
      die(mysqli_stmt_error($stmt));

   $result = mysqli_stmt_get_result($stmt);
   $ucenici = array();
   // kiolvassuk a találatokat sorról-sorra
   while ($row = mysqli_fetch_assoc($result))
      array_push($ucenici, $row);
      // visszaadjuk a kereses alapjan megtalalt diakokat JSON formatumban
      echo json_encode($ucenici);
?>