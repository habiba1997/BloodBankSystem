<?php
 session_start();
 require 'mySQLConnection.php';

 echo "<h1 style='color:#0075b4' class='text-center'>".$_SESSION["type"]."-".$_SESSION["user"]."-".$_SESSION["name"]."</h1>";

$hospitalCode = $_SESSION['user'];

/*1) select hospital bank and check if blood exist with quantity needed 
2) if not check main bank 
3) if not check any bank

write which bank you will be working with 
and echange occurs
SELECT `Exchange_Code`, `BankCode`, `HospitalCode`, `Exchange_Date`, `No_of_Bags`, `Blood_Type` FROM `Issuning` WHERE 1*/
    
 if($_SERVER['REQUEST_METHOD']=="POST" )      
    {         
        $bloodType = $_POST['abo'].$_POST['RH'];
        $numberOfBags = $_POST['numberOfBags'];

        // get bank code $hospitalBank from hospital using hospital code
        $selectBank = $data->prepare("SELECT * FROM `Hospital` JOIN `BANKS` WHERE Hcode = $hospitalCode AND Bankcode = BCODE");
        $selectBank->execute();


foreach ($selectBank as $key) 
{

          $hospitalBank = $key['Bankcode'];
          $supplierBankHospital = $key['Supplier'];
          $selectBankpositiveA = $key['NO_OF(A)'];
          $selectBanknegativeA = $key['NO_OF(-A)'];
          
          $selectBankpositiveB = $key['NO_OF(B)'];
          $selectBanknegativeB = $key['NO_OF(-B)'];
          
          $selectBankpositiveAB = $key['NO_OF(AB)'];
          $selectBanknegativeAB = $key['NO_OF(-AB)'];
          
          $selectBankpositiveO  = $key['NO_OF(O)'];
          $selectBanknegativeO  = $key['NO_OF(-O)'];

}




$selectSupplierBank=$data->prepare("SELECT * FROM `BANKS` WHERE BCODE = :sbh");
$selectSupplierBank->execute(array(":sbh" => $supplierBankHospital));



foreach ($selectSupplierBank as $key) 
{
          $selectSupplierBankpositiveA = $key['NO_OF(A)'];
          $selectSupplierBanknegativeA = $key['NO_OF(-A)'];
          
          $selectSupplierBankpositiveB = $key['NO_OF(B)'];
          $selectSupplierBanknegativeB = $key['NO_OF(-B)'];
          
          $selectSupplierBankpositiveAB = $key['NO_OF(AB)'];
          $selectSupplierBanknegativeAB = $key['NO_OF(-AB)'];
          
          $selectSupplierBankpositiveO  = $key['NO_OF(O)'];
          $selectSupplierBanknegativeO  = $key['NO_OF(-O)'];

}

$selectAllBanks = $data->prepare("SELECT * FROM `BANKS`");
$selectAllBanks->execute();



if($bloodType == "A+")
{
  if($selectBankpositiveA > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBankpositiveA > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(A)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}

if($bloodType == "A-")
{
  if($selectBanknegativeA > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBanknegativeA > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(-A)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}

if($bloodType == "B+")
{
  if($selectBankpositiveB > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBankpositiveB > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(B)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}
if($bloodType == "B-")
{
  if($selectBanknegativeB > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBanknegativeB > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(-B)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}

if($bloodType == "AB+")
{
  if($selectBankpositiveAB > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBankpositiveAB > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(AB)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}
if($bloodType == "AB-")
{
  if($selectBanknegativeAB > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBanknegativeAB > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(-AB)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}
if($bloodType == "O+")
{
  if($selectBankpositiveO > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBankpositiveO > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(O)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}
if($bloodType == "O-")
{
  if($selectBanknegativeO > $numberOfBags)
  {
    $BankCode = $hospitalBank;
  }
  else if($selectSupplierBanknegativeO > $numberOfBags)
  {
    $BankCode =$supplierBankHospital;
  }
  else
  {
    foreach ($selectAllBanks as $value)
    {
      if ($value['NO_OF(-O)'] > $numberOfBags)
      {
        $BankCode = $value['BCODE'];
      }
    } 

  }
}



$selectBank=$data->prepare("SELECT * FROM `BANKS` WHERE BCODE = $BankCode");
$selectBank->execute();
foreach ($selectBank as $key) {
$BankName = $key['NAME'];
}

 echo "<h3 style='color:#0075b4' class='text-center'>"."The Transaction Occured Successfully and <b>".$numberOfBags."</b> bags of type <b>".$bloodType."</b> will be delivered by <b>".$BankName."</b> BANK"."</h3>";


             // my insert to donor table
                
                   $inertExchange= $data->prepare("INSERT INTO `Issuning`(`BankCode`, `HospitalCode`, `No_of_Bags`, `Blood_Type`) VALUES (:bankcode, :hospitalcode, :NOBags, :bt)");

                    if($inertExchange->execute(array(
                        ':bankcode'=> $BankCode,
                        ':hospitalcode' => $hospitalCode,
                        ':NOBags'=> $numberOfBags,
                        ':bt' => $bloodType))
                    )
                    { $checkbloodbagaddition =0;
                      $code = $BankCode;
                       echo "<h6 style='color:#0075b4' class='text-center'>"."Inserted Successfully"."</h6>";

                         //remove for each ??
                        if($bloodType=="A+")
                        {
                          foreach ($selectBank as $val) 
                          {
$new = $val['NO_OF(A)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(A)`=:Apositive WHERE  BCODE=:bc");
if($edit->execute(array(":Apositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="A-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(-A)']- $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-A)`=:Anegative WHERE  BCODE=:bc");
if($edit->execute(array(":Anegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        else if($bloodType=="B+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(B)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(B)`=:Bpositive WHERE  BCODE=:bc");
if($edit->execute(array(":Bpositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="B-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(-B)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-B)`=:Bnegative WHERE  BCODE=:bc");
if($edit->execute(array(":Bnegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        if($bloodType=="AB+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(AB)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(AB)`=:ABpositive WHERE  BCODE=:bc");
if($edit->execute(array(":ABpositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="AB-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(-AB)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-AB)`=:ABnegative WHERE  BCODE=:bc");
if($edit->execute(array(":ABnegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        if($bloodType=="O+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(O)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(O)`=:Opositive WHERE  BCODE=:bc");
if($edit->execute(array(":Opositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="O-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = $val['NO_OF(-O)'] - $numberOfBags;
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-O)`=:Onegative WHERE  BCODE=:bc");
if($edit->execute(array(":Onegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }     
                  
//check if bags i
if($checkbloodbagaddition==1)
{
  echo "<h6 style='color:#0075b4' class='text-center'>"."Blood Bag had been updated Successfully"."</h6>";

}
else
{
  echo "<h6 style='color:#0075b4' class='text-center'>"."Blood Bag had NOT been updated"."</h6>";

}
 





                    }
                    else
                    {
                      echo "<h6 style='color:#0075b4' class='text-center'>"."Not Inserted Successfully"."</h6>";

                   }




}

?>
<!DOCTYPE html>
<html>
<head>
  <title>New Exchange Process </title>
  <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <style>
    body{ background-image: url(22.jpg);  font-family: 'Open Sans', sans-serif; background-size: cover; color: #0075b4}
        h1,h3{background-color: rgba(255,255,255,0.7); border-radius:1%;; margin: 3% 7%; padding: 3% 3%; width: 86%; }
        .beebz{width: 96%;background-color: rgba(255,255,255,0.7); border-radius: 1%; margin: 2%; padding: 3%; display: block; }
        button{float: right; margin: 2% 5% 5% 5%; display: block;}
        h4{display: inline-block;}

  </style>
</head>
<body>
  

  <div class="beebz row">
    <form action="" method="POST" style="padding-bottom: 5%">
 
<h2>Patient Information</h2> <br>


    <div class="row">
               
               <div class="form-group col-sm-3 container-fluid">
                <h4 for="ne">Number Of Blood Bags</h4> <br> 
                <input id="ne" type=number class="form-control" name="numberOfBags">   
               </div>
               <div class="form-group col-sm-3 container-fluid"></div>
               <div class="form-group col-sm-3 container-fluid">
                <h4 for="ms" style="text-align: center;">Type</h4> <br> 
                <input type="radio" id="ms" name="abo" value="A">A<br>
                <input type="radio" id="ms" name="abo" value="B" >B<br>
                <input type="radio" id="ms" name="abo" value="AB">AB<br>
                <input type="radio" id="ms" name="abo" value="O" >O<br>

              </div>
              <div class="form-group col-sm-3 container-fluid">
                <h4 for="mn" style="text-align: center;">RH Group</h4> <br>
                <input type="radio" id="mn" name="RH" value="+" >positive <br>
                <input type="radio" id="mn" name="RH" value="-" >negative <br>
              </div>               
    </div>
            <button type="submit" class="btn btn-primary btn-lg">ISSUE </button> 
    </form>
</div>
<a href='logout.php'> <button class='btn btn-primary btn-lg '> LOG OUT </button></a>
<a href='hospital.php'> <button class='btn btn-primary btn-lg'>New Issue</button></a> <br><br>

</body>
</html>