<?php

   $servername = "localhost";
   $db_username = "webservice_login";
   $db_password = "YhKDIMlx3zpQftJt";
   $db_name = "aukcjoner";

   error_reporting(0);

   // $_REQUEST is containter for both $_GET and $_POST 

      $price = $_REQUEST['price'];
      $buyer = $_REQUEST['buyer'];
      $seller = $_REQUEST['seller'];
   ////////////////////////////////////////////////////

   header('Content-Type: application/json');

   class QueryContainer{

      public $status;
      public $info;
      public $price;
      public $buyerSaldo;
      public $sellerSaldo;
      public $buyer;
      public $seller;

   }

   $conn = new mysqli($servername, $db_username, $db_password, $db_name);

   if ($conn->connect_error) {
      $queryContainer->status = 'failure';
      $queryContainer->info = "database connection failed";
      die();
   }

   if($buyer !== $seller){

      $countBuyerMoney = "SELECT saldo FROM userdata WHERE login='". $buyer ."'";
      $countBuyerMoney_result = $conn->query($countBuyerMoney);
      $buyerMoney = $countBuyerMoney_result->fetch_assoc();
      $bMoney = $buyerMoney["saldo"] - $price;
      $takeMoneyFromBuyer = "UPDATE userdata SET saldo='". $bMoney ."' WHERE login='". $buyer ."'";
      $conn->query($takeMoneyFromBuyer);

      $countSellerMoney = "SELECT saldo FROM userdata WHERE login='". $seller ."'";
      $countSellerMoney_result = $conn->query($countSellerMoney);
      $sellerMoney = $countSellerMoney_result->fetch_assoc();
      $sMoney = $sellerMoney["saldo"] + $price;
      $giveMoneyToSeller = "UPDATE userdata SET saldo='". $sMoney ."' WHERE login='". $seller ."'";
      $conn->query($giveMoneyToSeller);

      $queryContainer->status = "buyed";
      $queryContainer->buyerSaldo = $bMoney;
      $queryContainer->sellerSaldo = $sMoney;
      $queryContainer->price = $price;
      $queryContainer->seller = $seller;
      $queryContainer->buyer = $buyer;

   } else {

      $queryContainer->status = 'sellerIsBuyer';
      $queryContainer->info = "seller can't be his buyer himselft";

   }

   echo json_encode($queryContainer);

   $conn->close();

?>