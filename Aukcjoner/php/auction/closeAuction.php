<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST

      $id = $_REQUEST['id']; // auction's id
      $buyer = $_REQUEST['buyer'];
   ////////////////////////////////////////////////////

   $closeAuction = "UPDATE auctiondata SET buyer='". $buyer ."', auctionState = 'closed' WHERE Identyfikator='". $id ."'";
   
   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

   }

   $conn = new mysqli($servername, $db_username, $db_password, $db_name);

   if ($conn->connect_error) {
      $queryContainer->status = 'failure';
      $queryContainer->info = "database connection failed";
      die();
   }

   $conn->query($closeAuction);

   $checkExistence = "SELECT * FROM auctiondata WHERE Identyfikator='". $id ."' AND auctionState='closed'";

   $result = $conn->query($checkExistence);
   $queryContainer = new QueryContainer;

   if ($result->num_rows > 0) {
      
      $rowNumber = 0;

      while($row = $result->fetch_assoc()) {

         $queryContainer->status = "closed";

      }

   } else {
   
      $queryContainer->status = 'failure';
      $queryContainer->info = "sql query: " . $checkExistence;
   }

   echo json_encode($queryContainer);

   $conn->close();

?>