<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST

      $userLogin = $_REQUEST['login'];
      $userPassword = $_REQUEST['password'];
   ////////////////////////////////////////////////////
   
   $sql = 'SELECT * FROM logindata where login = "' . $userLogin . '" AND password = "' . $userPassword . '"';
    
   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $login;
      public $password;

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
         $queryContainer->password = $row["password"];

      }
   } else {
      
      $queryContainer->status = 'failure';
      $queryContainer->info = "unknown user";

   }

   class ReturnContainer{

      public $login;
      public $status;
      public $info;
   }

   $return = new ReturnContainer();

   $return->login = $queryContainer->login;
   $return->status = $queryContainer->status;
   $return->info = $queryContainer->info;

   echo json_encode($return);

   $conn->close();

?>