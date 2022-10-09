<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST

      $login = $_REQUEST['login'];
   ////////////////////////////////////////////////////
   
   $sql = 'SELECT * FROM userdata where login="' . $login . '"';
    
   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $login;
      public $name;
      public $saldo;
      public $email;
      public $auctionsCount;

   }

   $conn = new mysqli($servername, $db_username, $db_password, $db_name);

   if ($conn->connect_error) {
      $queryContainer->status = 'failure';
      $queryContainer->info = "database connection failed";
      die();
   }

   $result = $conn->query($sql);
   $queryContainer = new QueryContainer;

   if ($result->num_rows > 0) {

      $queryContainer->status = 'success';
      
      while($row = $result->fetch_assoc()) {

         $queryContainer->login = $row["login"];
         $queryContainer->name = $row["name"];
         $queryContainer->saldo = $row["saldo"];
         $queryContainer->email = $row["email"];
         $queryContainer->auctionsCount = $row["auctionsCount"];

      }
   } else {
      
      $queryContainer->status = 'failure';
      $queryContainer->info = "unknown user";

   }

   echo json_encode($queryContainer);

   $conn->close();

?>