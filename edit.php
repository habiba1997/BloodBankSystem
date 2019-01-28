<?php

session_start();
require 'mySQLConnection.php';


 echo "<h1 style='color:#0075b4' class='text-center'>".$_SESSION["type"]."-".$_SESSION["user"]."-".$_SESSION["name"]."</h1>";
 $bankCode =$_GET["Bcode"];
$selectBankData = $data ->prepare ("SELECT `NAME`, `LOCATION`, `NO_OF(A)`, `NO_OF(B)`, `NO_OF(AB)`, `NO_OF(O)`, `NO_OF(-O)`, `NO_OF(-A)`, `NO_OF(-B)`, `NO_OF(-AB)` FROM `BANKS` WHERE BCODE=:bc");
            

 if(isset($_GET["action"])== "edit" && isset($_GET["Bcode"]))
 {
			            
         
              if ($selectBankData->execute(array(":bc" => $bankCode)))
                {
                   echo "<h6 style='color:#2275b0'>"."The data of BCODE " . $_GET['Bcode'] . " has been selected for editing </h6>";
                  
                  foreach($selectBankData as $sel)
                  {
                    $Name=$sel['NAME'];
                    $Location=$sel['LOCATION'];
                    
                    $Apositive=$sel['NO_OF(A)'];
                    $Anegative=$sel['NO_OF(-A)'];
                    
                    $Bpositive=$sel['NO_OF(B)'];
                    $Bnegative=$sel['NO_OF(-B)'];
                    
                    $ABpositive=$sel['NO_OF(AB)'];
                    $ABnegative=$sel['NO_OF(-AB)'];
                    
                    $Opositive=$sel['NO_OF(O)'];
                    $Onegative=$sel['NO_OF(-O)'];
                  }

                }
                else 
                {
                   echo "<h6 style='color:#2275b0'>"."Error in Edit Selection!"."</h6>";
                }
 }


 if($_SERVER['REQUEST_METHOD']=="POST" )      
 {

                  
		$edit = $data->prepare("UPDATE `BANKS` SET `NAME`=:name, `LOCATION`=:loc,`NO_OF(A)`=:Apositive,`NO_OF(-A)`=:Anegative, `NO_OF(-B)`=:Bnegative,`NO_OF(B)`=:Bpositive,`NO_OF(-AB)`=:ABnegative, `NO_OF(AB)`=:ABpositive,`NO_OF(O)`=:Opositive,`NO_OF(-O)`=:Onegative WHERE  BCODE=:bc");

		if($edit->execute(array(":name" =>$_POST['Name_val'],":loc"=>$_POST['Location_val'],
      ":Apositive"=>$_POST['A+_val'],":Anegative"=>$_POST['A-_val'],
      ":Bpositive"=>$_POST['B+_val'],":Bnegative"=>$_POST['B-_val'],
      ":ABpositive"=>$_POST['AB+_val'],":ABnegative"=>$_POST['AB-_val'],
      ":Opositive"=>$_POST['O+_val'],":Onegative"=>$_POST['O-_val'], ":bc"=>$_GET['Bcode'])))
		{
			echo "<h6 style='color:#2275b0'>"."The data of BCODE" . $_GET['Bcode'] . " has been selected for updating </h6>";
		}
		else 
		{
			echo "<h6 style='color:#2275b0'>"."Error in updating "."</h6>";

		}
                  
 }  


$selectBankData->execute(array(":bc" => $bankCode));


?>

<!DOCTYPE html>
<html>
<head>
	<title>Editing Bank Data </title>
	<link rel="stylesheet" href="bootstrap.min.css">

	<style>
        body{ background-image: url(22.jpg);  font-family: 'Open Sans', sans-serif; background-size: cover; color: #2275b0}
        .beebz{width: 40%;background-color: rgba(255,255,255,0.7); border-radius: 1%; margin: 4%; padding: 3%; display: inline-block; }
        h1,h6{background-color: rgba(255,255,255,0.7); border-radius: 1%; width: 50%; margin: 1% 25%; padding: 1%  ;text-align: center;}
        button{float: right;margin: 0% 5% 5% 5%; display: block;}

    
       
    </style>
</head>
<body>
	

	<div class="beebz"  >
   	   <h2> Blood Bank Information </h2>
       <table class="table table-bordered table-condensed table-hover" style="display: inline-block;" >
         
                    <?php 

                        foreach ($selectBankData as $qurry) 
                        {
                          echo "<tr><th scope='col'>Name: </th><td>".$qurry['NAME']."</td></tr>";
                          echo "<tr><th scope='col'>Location: </th><td>".$qurry['LOCATION']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of A+</th><th scope='col'>Number of A-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(A)']."</td><td> ".$qurry['NO_OF(-A)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of B+</th><th scope='col'>Number of B-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(B)']."</td><td> ".$qurry['NO_OF(-B)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of AB+</th><th scope='col'>Number of AB-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(AB)']."</td><td> ".$qurry['NO_OF(-AB)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of O+</th><th scope='col'>Number of O-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(O)']."</td><td> ".$qurry['NO_OF(-O)']."</td></tr>";
                        }

                    ?>
          
       </table>
        </div>
        <div class="beebz">
    <form action="" method="POST">
      <div class="form-group">
                <label for="Name">Name</label> 
                <input id="Name" type=text class="form-control" name="Name_val" value= "<?php if(isset($Name)){echo $Name;}?>">
              </div>

              <div class="form-group">
                <label for="back">Location</label> 
                <input id="back" type=text class="form-control" name="Location_val" value= "<?php if(isset($Location)){echo $Location;}?>">
              </div>

              <div class="form-group">
                <label for="A+">A+ Blood Bag Number</label> 
                <input id="A+"" type=text class="form-control" name="A+_val" value= "<?php if(isset($Apositive)){echo $Apositive;}?>">
              </div>

              <div class="form-group">
                <label for="A-">A- Blood Bag Number</label> 
                <input id="A-" type=number class="form-control" name="A-_val" value= "<?php if(isset($Anegative)){echo $Anegative;}?>">
              </div>

              <div class="form-group">
                <label for="B+">B+ Blood Bag Number</label> 
                <input id="B+"" type=text class="form-control" name="B+_val" value= "<?php if(isset($Bpositive)){echo $Bpositive;}?>">
              </div>

              <div class="form-group">
                <label for="B-">B- Blood Bag Number</label> 
                <input id="B-" type=number class="form-control" name="B-_val" value= "<?php if(isset($Bnegative)){echo $Bnegative;}?>">
              </div>

              <div class="form-group">
                <label for="AB+">AB+ Blood Bag Number</label> 
                <input id="AB+"" type=text class="form-control" name="AB+_val" value= "<?php if(isset($ABpositive)){echo $ABpositive;}?>">
              </div>

              <div class="form-group">
                <label for="AB-">AB- Blood Bag Number</label> 
                <input id="AB-" type=number class="form-control" name="AB-_val" value= "<?php if(isset($ABnegative)){echo $ABnegative;}?>">
              </div>

              <div class="form-group">
                <label for="O+">O+ Blood Bag Number</label> 
                <input id="O+"" type=text class="form-control" name="O+_val" value= "<?php if(isset($Opositive)){echo $Opositive;}?>">
              </div>

              <div class="form-group">
                <label for="O-">O- Blood Bag Number</label> 
                <input id="O-" type=number class="form-control" name="O-_val" value= "<?php if(isset($Onegative)){echo $Onegative;}?>">
              </div>

             
                <button class="btn btn-primary btn-lg" type="submit" style="margin-top: 3%"> Edit </button> 
      
    </form>
  </div>
<a href='bank.php'> <button class='btn btn-primary btn-lg'>Return to Main Bank Data</button></a>
<a href='logout.php'> <button class='btn btn-primary btn-lg'> LOG OUT </button></a>

</body>
</html>