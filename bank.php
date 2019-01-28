<?php
 session_start();
 
 echo "<h1 style='color:#0075b4' class='text-center'>".$_SESSION["type"]."-".$_SESSION["user"]."-".$_SESSION["name"]."</h1>";

require 'mySQLConnection.php';
$bankCode =$_SESSION["user"];

 if(isset($_SESSION["type"])=="bank")
        {
           
            $selectBankData= $data ->prepare ("SELECT * FROM `BANKS` WHERE BCODE=:bc");
            $selectBankData->execute(array(":bc" => $bankCode));        

        }



 if(isset($_GET["action"])== "erase" && isset($_GET["Bcode"]))
        {
             $delete = $data->prepare("DELETE FROM `BANKS` WHERE BCODE=:bcode");
                
                if ($delete->execute(array(":bcode" => $_GET['Bcode']))) 
                {
                    echo "<h2>"."The data of BCODE " . $_GET['Bcode'] . " has been removed </h2>";
                }
                else 
                {
                    echo "<h2>"."Deletion  error </h2>";
                }
        }     

?>
<!DOCTYPE html>
<html>
<head>
  <title> Blood Bank </title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <style>
    h1{background-color: rgba(255,255,255,0.7); border-radius:1%;; margin: 3% 7%; padding: 3% 3%; width: 86%; }
        body{ background-image: url(22.jpg);  font-family: 'Open Sans', sans-serif; background-size: cover; color: #2275b0; text-align: center;}
        .beebz{background-color: rgba(255,255,255,0.7); border-radius: 1%;; margin: 2% 3%; padding: 3% 3%; width: 94%; }
        .DPN{margin: 0% 1%;  width: 28%; display: inline-block; }
        table,.table-bordered{ border:2px solid #2275b0;}
    
       
    </style>
</head>
<body>

   	   <div class="beebz">
   	   <h2 > Bank Information </h2>
       <table class="table table-bordered table-hover" >
         
                   <?php 


                        foreach ($selectBankData as $qurry) 
                        {
                          echo "<tr><th scope='col'>Name: </th><td>".$qurry['NAME']."</td></tr>";
                          echo "<tr><th scope='col'>Location: </th><td>".$qurry['LOCATION']."</td></tr>";
                          echo "<tr><th scope='col'>Supplier: </th><td>".$qurry['Supplier']."</td></tr>";

                          echo "<tr><th scope='col'>Number of A+</th><th scope='col'>Number of A-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(A)']."</td><td> ".$qurry['NO_OF(-A)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of B+</th><th scope='col'>Number of B-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(B)']."</td><td> ".$qurry['NO_OF(-B)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of AB+</th><th scope='col'>Number of AB-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(AB)']."</td><td> ".$qurry['NO_OF(-AB)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Number of O+</th><th scope='col'>Number of O-</th></tr>";
                          echo " <tr><td> ".$qurry['NO_OF(O)']."</td><td> ".$qurry['NO_OF(-O)']."</td></tr>";
                          
                          echo "<tr><th scope='col'>Edit</th><th scope='col'>Delete</th></tr>";
		     			            echo "<tr><td> <a href='edit.php?action=edit&Bcode=".$qurry['BCODE']."'><i class='far fa-edit'></i></a></td>";
    		                  echo "<td> <a href='bank.php?action=erase&Bcode=".$qurry['BCODE']."'><i class='fas fa-trash'></i></a></td></tr>";
                          
                          
                        }

                    ?>
          
       </table>
        </div>



     

    <a href='logout.php'> <button class='btn btn-primary btn-lg'style='float: right;margin: 0% 5% 5% 5%'> LOG OUT </button></a>
    </body>
</html>
