<?php
 session_start();
 require 'mySQLConnection.php';

 echo "<h1 style='color:#0075b4' class='text-center'>".$_SESSION["type"]."-".$_SESSION["user"]."-".$_SESSION["name"]."</h1>";
$code = $_SESSION['user'];

 /*if(!isset($_SESSION["type"]))
  	{
  		header("Location:LogPage.php");
  	}*/
    //make some mangement and session check


 if($_SERVER['REQUEST_METHOD']=="POST" )      
    { 				
        
             $bloodType = $_POST['abo'].$_POST['RH'];
             // my insert to donor table
                   $inDonor= $data->prepare("INSERT INTO `Donors`(`SSN`, `FNAME`, `FATHERNAME`, `LNAME`, `BLOOD_TYPE`, `ADDRESS`, `PHONE`)VALUES(:ssn, :fn, :fathername, :ln, :bt, :add, :mob)");
                  
                   $insertDonation= $data->prepare("INSERT INTO `Donation`(`DSSN`, `Bankcode`, `Blood_Type`, `HIV`, `C`, `Accepted_or_not`) VALUES (:dssn, :bankcode, :bt, :hiv, :c , :AorN )");

                    if($inDonor->execute(array(':ssn'=> $_POST['ssn'],
                     ':fn'=> $_POST['fn'], 
                     ':fathername'=> $_POST['fathername'], 
                     ':ln'=> $_POST['ln'], 
                     ':bt'=> $bloodType,
                     ':add'=> $_POST['add'],
                     ':mob'=> $_POST['mob'], )) && 

                      $insertDonation->execute(array(
                        ':dssn'=> $_POST['ssn'],
                        ':bankcode' => $_SESSION["user"],
                        ':bt'=> $bloodType,
                        ':hiv' => $_POST['hiv_status'], 
                        ':c' => $_POST['C_status'],
                        ':AorN' => $_POST['status']))
                    )
                    {
                    	 echo "<h6 style='color:#0075b4' class='text-center'>"."Inserted Successfully"."</h6>";

                    }
                    else
                    {
                      echo "<h6 style='color:#0075b4' class='text-center'>"."Not Inserted Successfully"."</h6>";

                   }
$checkbloodbagaddition=0;
                   

                   if ($_POST['status'] == 'Accepted')
                   {
$selectBank=$data->prepare("SELECT * FROM `BANKS` WHERE BCODE = $code");
$selectBank->execute();
                         

                         //remove for each ??
                        if($bloodType=="A+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(A)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(A)`=:Apositive WHERE  BCODE=:bc");
if($edit->execute(array(":Apositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="A-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(-A)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-A)`=:Anegative WHERE  BCODE=:bc");
if($edit->execute(array(":Anegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        else if($bloodType=="B+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(B)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(B)`=:Bpositive WHERE  BCODE=:bc");
if($edit->execute(array(":Bpositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="B-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(-B)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-B)`=:Bnegative WHERE  BCODE=:bc");
if($edit->execute(array(":Bnegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        if($bloodType=="AB+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(AB)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(AB)`=:ABpositive WHERE  BCODE=:bc");
if($edit->execute(array(":ABpositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="AB-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(-AB)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-AB)`=:ABnegative WHERE  BCODE=:bc");
if($edit->execute(array(":ABnegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        if($bloodType=="O+")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(O)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(O)`=:Opositive WHERE  BCODE=:bc");
if($edit->execute(array(":Opositive"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }
                        else if($bloodType=="O-")
                        {
                          foreach ($selectBank as $val) 
                          {
                            $new = ++$val['NO_OF(-O)'];
$edit = $data->prepare("UPDATE `BANKS` SET `NO_OF(-O)`=:Onegative WHERE  BCODE=:bc");
if($edit->execute(array(":Onegative"=>$new, ":bc"=>$code))) {$checkbloodbagaddition=1;}
                          } 
                        }

                        
                   }
        
if($checkbloodbagaddition==1)
{
  echo "<h6 style='color:#0075b4' class='text-center'>"."Blood Bag had been added Successfully"."</h6>";

}
else
{
  echo "<h6 style='color:#0075b4' class='text-center'>"."Blood Bag had NOT been added"."</h6>";

}
                        

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Analysis Lab</title>
	<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<style>
		body{ background-image: url(22.jpg);  font-family: 'Open Sans', sans-serif; background-size: cover; color: #0075b4}
        h1{background-color: rgba(255,255,255,0.7); border-radius:1%;; margin: 3% 7%; padding: 3% 3%; width: 86%; }
        .beebz{width: 96%;background-color: rgba(255,255,255,0.7); border-radius: 1%; margin: 2%; padding: 3%; display: block; }
        button{float: right; margin: 2% 5% 5% 5%; display: block;}
        h4{display: inline-block;}
        .data h4{text-align: center }

	</style>
</head>
<body>
	
	
  <div class="beebz row">
		<form action="" method="POST" style="padding-bottom: 5%">
 
  <h2>Patient Information</h2> <br>

<div class="row"> <!--container fluid-->
               <div class="form-group col-sm-12 container-fluid">
                <h4 for="ssn"> Social Security Number</h4> <br> 
                <input id="ssn" size="500" type=text class="form-control" name="ssn">   
               </div>
               
</div>
<div class="row">
               <div class="form-group col-sm-4">
                <h4 for="hr">First Name</h4> 
                <input id="hr" type=text class="form-control" name="fn"> 
               </div>

              <div class="form-group col-sm-4">
                <h4 for="bs">Father Name</h4> 
                <input id="bs" type=text class="form-control" name="fathername">
               </div>

               <div class="form-group col-sm-4">
                <h4 for="dw">Family Name</h4> 
                <input id="dw" type=text class="form-control" name="ln">
               </div>
</div>
<div class="row">
               <div class="form-group col-sm-6 container-fluid">
                <h4 for="ne">Mobile Number</h4> <br> 
                <input id="ne" type=text class="form-control" name="mob">   
               </div>
               <div class="form-group col-sm-6 container-fluid">
                <h4 for="nn">Address</h4> <br> 
                <input id="nn" type=text class="form-control" name="add">   
               </div>

</div>
 <br> 			
  <h2>Blood Bag Information</h2> <br>

    <div class="data row">
      			  <div class="col-sm-3">
                  	<h4 for="ms">ABO Group</h4> <br>
                    <input type="radio" id="ms" name="abo" value="A">A<br>
                    <input type="radio" id="ms" name="abo" value="B" >B<br>
                    <input type="radio" id="ms" name="abo" value="AB">AB<br>
                    <input type="radio" id="ms" name="abo" value="O" >O<br>

                  </div>

                  <div class="col-sm-3">
                  	<h4 for="ms">RH Group</h4> <br>
                    <input type="radio" id="ms" name="RH" value="+" >positive <br>
                    <input type="radio" id="ms" name="RH" value="-"  >negative <br>
                  </div>


              <div class="col-sm-3">
                    <h4 for="ms" >HIV</h4> <br>
                    <input type="radio" id="ms" name="hiv_status" value="true"  >Exist<br>
                    <input type="radio" id="ms" name="hiv_status" value="false" >Doesn't Exist<br>
                   

                  </div>

                  <div class="col-sm-3">
                    <h4 for="ms">Virus C</h4> <br>
                    <input type="radio" id="ms" name="C_status" value="true"  >Exist<br>
                    <input type="radio" id="ms" name="C_status" value="false" >Doesn't Exist<br>
                  </div>

    </div>
<br>  
<div style="text-align: center">   
      <div class="data row">
                     <div class="col-sm-12">
                      <input type="radio"  name="status" value="Accepted"><h3 style="display: inline;">  Accepted</h3> <br>
                      <input type="radio" name="status" value="NotAccepted" ><h3 style="display: inline;">  Not Accepted</h3> <br>
                      
                    </div>
      </div>
</div>        
            
            
            <button type="submit" class="btn btn-primary btn-lg">ADD</button> 




		</form>
</div>
<a href='logout.php'> <button class='btn btn-primary btn-lg '> LOG OUT </button></a>
<a href='analysis.php'> <button class='btn btn-primary btn-lg'>New Blood Bag</button></a> <br><br>

</body>
</html>