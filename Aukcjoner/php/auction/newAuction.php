<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST 

      $title = $_REQUEST['title'];
      $description = $_REQUEST['description'];
      $price = $_REQUEST['price'];
      $seller = $_REQUEST['seller'];
      $category = $_REQUEST['category'];
   ////////////////////////////////////////////////////

   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $id;
      public $title;
      public $description;
      public $price;
      public $seller;

   }

   $conn = new mysqli($servername, $db_username, $db_password, $db_name);

   if ($conn->connect_error) {
      $queryContainer->status = 'failure';
      $queryContainer->info = "database connection failed";
      die();
   }

   $addAuction = "INSERT INTO auctiondata (title, description, price, seller, category) VALUES ('" . $title . "','". $description . "','". $price . "','". $seller ."','" . $category . "')";
   
   $conn->query($addAuction);

   $checkAuctionExistence = "SELECT * FROM auctiondata WHERE title='". $title ."' AND description='". $description ."'";
   $result = $conn->query($checkAuctionExistence);

   $queryContainer = new QueryContainer;

   if ($result->num_rows > 0) {
      
      while($row = $result->fetch_assoc()) {

            $queryContainer->id = $row["Identyfikator"];
            $queryContainer->title = $row["title"];
            $queryContainer->description = $row["description"];
            $queryContainer->price = $row["price"];
            $queryContainer->seller = $row['seller'];
      }

   } else {
   
      $queryContainer->status = 'failure';
      $queryContainer->info = "script hasn't add a new auction";   
   }

   $error = true;

   if ($queryContainer->title !== $title) $errorMessage = "verification of title has failed";
   else if($queryContainer->description !== $description) $errorMessage = "verification of description has failed";
   // else if ($queryContainer->price !== $price) $errorMessage = "verification of price has failed";
   else if($queryContainer->seller !== $seller) $errorMessage = "verification of seller has failed";
   else {

      $queryContainer->status = "success";
      $error = false;

      $getAuctionsCount = "SELECT auctionsCount FROM userdata WHERE login='". $seller ."'";
      $getAC_result = $conn->query($getAuctionsCount);
      $count = $getAC_result->fetch_assoc();
      $count["auctionsCount"] = $count["auctionsCount"] + 1;

      $setAuctionsCount = "UPDATE userdata SET auctionsCount='". $count["auctionsCount"] ."' WHERE login='". $seller ."'";
      $conn->query($setAuctionsCount);

   }
   
   if($error){

      $memory_dump = $queryContainer->title . " | " .  $queryContainer->description . " | " .  $queryContainer->price . " | " . $queryContainer->seller;

      $queryContainer->status = "failure";
      $queryContainer->info = $errorMessage . $memory_dump;
   }

   class ReturnContainer{

      public $id;
      public $status;
      public $info;
   }

   $return = new ReturnContainer();

   $return->id = $queryContainer->id;
   $return->status = $queryContainer->status;
   $return->info = $queryContainer->info;

   echo json_encode($return);

   $conn->close();

?>