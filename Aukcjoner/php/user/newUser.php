<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);
   
   // $_REQUEST is containter for both $_GET and $_POST 

      $newLogin = $_REQUEST['newLogin'];
      $newPassword = $_REQUEST['newPassword'];
      $newEmail = $_REQUEST['newEmail'];
      $name = $_REQUEST['name'];
      $newSaldo = 0;
      $auctionsCount = 0;
   ////////////////////////////////////////////////////

   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $newLogin;
      public $newPassword;

   }

   $conn = new mysqli($servername, $db_username, $db_password, $db_name);

   if ($conn->connect_error) {
      $queryContainer->status = 'failure';
      $queryContainer->info = "database connection failed";
      die();
   }

   $findUser = "SELECT * FROM logindata WHERE login=" . "'". $newLogin ."'";

   $result = $conn->query($findUser);
   $queryContainer = new QueryContainer;

   if ($result->num_rows > 0){
      
      while($row = $result->fetch_assoc()) {

         $queryContainer->newLogin = $row["login"];
      }

      if($queryContainer->newLogin == $newLogin){
   
         $userExistedBefore = true;
         $queryContainer->status = "failure";
         $queryContainer->info = $queryContainer->newLogin . ' exists in the database';
      }

   }else{
      
      $userExistedBefore = false;
      $addUser = "INSERT INTO logindata (login, password) VALUES ('" . $newLogin . "','". $newPassword ."')";
      $describeUser = "INSERT INTO userdata (login, saldo, email, name, auctionsCount) VALUES ('" . $newLogin . "','" . $newSaldo . "','". $newEmail ."','" . $name . "','". $auctionsCount ."')";
      $conn->query($addUser);
      $conn->query($describeUser);

   }

   if($userExistedBefore == false){

      $findUser_withPassword = "SELECT * FROM logindata WHERE login='". $newLogin ."' AND password='". $newPassword ."'";
      $result = $conn->query($findUser_withPassword);

      if($result->num_rows > 0){

         while($row = $result->fetch_assoc()) {

            $queryContainer->newLogin = $row["login"];
            $queryContainer->newPassword = $row["password"];

         }

         if(($queryContainer->newLogin == $newLogin) && ($queryContainer->newPassword == $newPassword)){ 
         
            $queryContainer->status = "success";
         
         }else{
            
            $queryContainer->status = "failure";
            $queryContainer->info = "After adding a new username, it didn't appear in the database";
         }

      }else{

         $queryContainer->status = "failure";
         $queryContainer->info = "No result of verification request";

      }
   }

   class ReturnContainer{

      public $status;
      public $info;
   }

   $return = new ReturnContainer();

   $return->status = $queryContainer->status;
   $return->info = $queryContainer->info;

   echo json_encode($return);

   $conn->close();

?>