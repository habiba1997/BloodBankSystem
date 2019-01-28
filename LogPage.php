<?php
//Analysis => analysis 

 session_start();
 if($_SERVER['REQUEST_METHOD']=="POST")
{
             require 'mySQLConnection.php';
             $pass=$_POST['pass']; //for password post from form
             $check="0"; // if no input have been written 
             $selectBank=$data->prepare("SELECT * FROM `BANKS`");
             $selectBank->execute();
             $selectHospital=$data->prepare("SELECT * FROM `Hospital`");
             $selectHospital->execute();

                            
            if(isset($_POST['system']))
            {
                if($_POST['system'] == 'analysisButton')
                { 

                    foreach ($selectBank as $val) 
                    {
                        if( $val["BCODE"]== $pass)
                        {
                            $_SESSION["user"]=$val['BCODE'];
                            $_SESSION['type']= "Analysis";
                            $_SESSION["name"]=$val['NAME'];
                            $check ="1";
                            header("Location:analysis.php");
                        }
                    } 

                }

                
                else if($_POST['system'] == 'bankButton')
                {

                    foreach ($selectBank as $val) 
                    {
                        if( $val["BCODE"]== $pass)
                        {
                            $_SESSION["user"]=$val['BCODE'];
                            $_SESSION["name"]=$val['NAME'];
                            $_SESSION['type']= "bank";
                            $check ="1";
                            header("Location:bank.php");
                        }
                    } 
                }
                else if ($_POST['system'] == 'hospitalButton')
                {
                    foreach ($selectHospital as $val) 
                {
                        if($val["Hcode"]== $pass)
                        {
                            $_SESSION["user"]=$val["Hcode"];
                            $_SESSION["name"]=$val['Name'];
                            $_SESSION['type']= "hospital";
                            $check ="1";
                            header("Location:hospital.php");
                        }
                } 

                }
                else
                {
                    header("Location:LogPage.php");

                }
               
            }
                        
            


            if ($check=="0")
            {
            echo "<h1 class='primary'>"."Error in System Information"."Re-Enter Correct Password "."</h1>";
            }

}
?>
<!DOCTYPE html>
<html>
<head>
        <script>
            
            function Analysisclick()
            {
                
                document.getElementById("label").innerHTML = "Analysis Lab System";
                document.getElementById("analysis").style.backgroundColor = "#62b4d9";
                document.getElementById("hospital").style.backgroundColor = "#f5f5f5";
                document.getElementById("bank").style.backgroundColor = "#f5f5f5";               
            }
            function bankclick()
            {
                
                document.getElementById("label").innerHTML = "Blood Bank System";
                document.getElementById("bank").style.backgroundColor = "#62b4d9";
                document.getElementById("hospital").style.backgroundColor = "#f5f5f5";
                document.getElementById("analysis").style.backgroundColor = "#f5f5f5";
            }
            function hospitalclick()
            {
                
                document.getElementById("label").innerHTML = "Hospital Issuing System";
                document.getElementById("hospital").style.backgroundColor = "#62b4d9";
                document.getElementById("analysis").style.backgroundColor = "#f5f5f5";
                document.getElementById("bank").style.backgroundColor = "#f5f5f5";
            }
        
          
    </script> 
    
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        
    
        body{ background-image: url(7.jpg); background-size: cover ; font-family: 'Open Sans', sans-serif;}
        h1 {margin: 2% 2% ; color: #145b6c  } 
        button {opacity: 0.7; display: inline-block; margin-left: 1% ; margin-right: 1%}
        button img { height: 70px}
        form{ position: absolute; left: 25%; top: 20%; width: 50%;  padding: 2% 3%; background-color: rgba(255,255,255, 0.5); border-radius:5%;color: #145b6c;}
        form input{ height: 40px}
    
        
        
    </style>

   
</head>
    <body>


        
        <form action="" method="POST" class="signIn">
           
           <h1 class="text-center" > Blood Bank System </h1><br>

           <div class="text-center">

            <div style="margin: 2%; display: inline;">
            <input type="radio" name="system" value="analysisButton"><button type="button"class="btn btn-light" id="analysis" 
            onclick="Analysisclick()"><img src="analysis.png"></button> 
            </div>

            <div style="margin: 2%; display: inline;">
            <input type="radio" name="system" value="bankButton"><button type="button"class="btn btn-light" id="bank" 
            onclick="bankclick()"><img src="bloodbag.png"></button>
            </div>

            <div style="margin: 2%; display: inline;">
            <input type="radio" name="system" value="hospitalButton"><button type="button"class="btn btn-light" id="hospital" 
            onclick="hospitalclick()"><img src="hospital.png"></button>
            </div>
        

            </div> 
  
            <div class="form-group">
                <br>
                <h3 for="passwordd" id="label">System</h3>
                <input type="password" class="form-control" id="passwordd" placeholder="Enter Password" name="pass">
            </div>
            
              
            
            <button type="submit" class="btn btn-primary btn-lg" >Sign In</button> <br>
        </form>


        
       
        
        
        
    </body>
</html>