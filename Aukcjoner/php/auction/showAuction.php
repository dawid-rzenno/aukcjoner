<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST

      $id = $_REQUEST['id']; // auction's id
   ////////////////////////////////////////////////////

   $sql = "SELECT * FROM auctiondata WHERE Identyfikator='". $id ."'";
   
   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $id = array();
      public $title = array();
      public $description = array();
      public $price = array();
      public $seller = array();
      public $category = array();
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

      while($row = $result->fetch_assoc()) {

         $queryContainer->id = $id;
         $queryContainer->title = $row["title"];
         $queryContainer->description = $row["description"];
         $queryContainer->price = $row["price"];
         $queryContainer->status = "success";
         $queryContainer->seller = $row["seller"];
         $queryContainer->category = $row["category"];

      }

   } else {
   
      $queryContainer->status = 'failure';
      $queryContainer->info = "there's no product if you ask like " . $sql;
   }

   echo json_encode($queryContainer);

   $conn->close();

?>