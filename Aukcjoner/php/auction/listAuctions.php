<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST

      $keywords = $_REQUEST['keywords'];
      $category = $_REQUEST['category'];
      $login = $_REQUEST['login'];
   ////////////////////////////////////////////////////

   $sql = "SELECT * FROM auctiondata WHERE (NOT auctionState='closed') AND title LIKE ";

   $token = strtok($keywords, " ");
   
   while ($token !== false){

      $sql = $sql . "'%" . $token . "%' OR title LIKE ";
      $token = strtok(" ");
   }

   $sql = $sql . "'#'";

   if($keywords == ':all') $sql = "SELECT * FROM auctiondata WHERE (NOT auctionState='closed')";
   if($keywords == ':buyed') $sql = "SELECT * FROM auctiondata WHERE buyer='". $login ."' AND auctionState='closed'";
   if($keywords == ':set') $sql = "SELECT * FROM auctiondata WHERE seller='". $login ."' AND (NOT auctionState='closed')";
   if($keywords == ':sold') $sql = "SELECT * FROM auctiondata WHERE auctionState='closed' AND seller='". $login ."'";
   if($category != NULL) $sql = "SELECT * FROM auctiondata WHERE (NOT auctionState='closed') AND category='". $category ."'";
   
   // TO DO: Create a sql query which finds products with specified title

   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;

      public $id = array();
      public $title = array();
      public $description = array();
      public $price = array();
      public $category = array();
      public $auctionState = array();
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
      
      $rowNumber = 0;

      while($row = $result->fetch_assoc()) {

         $queryContainer->id[$rowNumber] = $row["Identyfikator"];
         $queryContainer->title[$rowNumber] = $row["title"];
         $queryContainer->description[$rowNumber] = $row["description"];
         $queryContainer->price[$rowNumber] = $row["price"];
         $queryContainer->category[$rowNumber] = $row["category"];
         $queryContainer->auctionState[$rowNumber] = $row["auctionstate"];
         $queryContainer->status = "success";

         if($keywords == ":buyed") $queryContainer->status = "buyed";
         if($keywords == ":set") $queryContainer->status = "set";
         if($keywords == ":sold") $queryContainer->status = "sold";

         $rowNumber++;
      }

   } else {
   
      $queryContainer->status = 'failure';
      $queryContainer->info = "there's no product if you ask like " . $sql;
   }

   echo json_encode($queryContainer);

   $conn->close();

?>