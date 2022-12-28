<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">

    <title>log in</title>
    <style>
        .container{
            width: 30%;
            height: 40vh;
            margin:  auto ;
            transform: translateY(200px);

            
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    require('./connection.php');

    if(isset($_POST['submit'])){
        
        $_SESSION['validate']=false;
        $email=$_POST['Email'];
        $password=$_POST['Password'];

        $error="";

        $db = crud::connect()->prepare("SELECT * FROM users WHERE Email=:email and Password = :password ");
        $db->bindValue(':email' , $email);
        $db->bindValue(':password' , $password);
        $db->execute();
        $d= $db->fetch(PDO::FETCH_ASSOC);
        if(!empty($_POST['Email'])&&!empty($_POST['Password'])){

            if($d){
                $_SESSION['name']=$d["full_name"];
                $_SESSION['email']=$d["email"];
                $_SESSION['pass']=$d["password"];
                $_SESSION['role']=$d["role"];
                $_SESSION['id']=$d["id"];
                $_SESSION['validate']=true;
                header("location:./users.php");

            }
         
            else{
                $error= "not match";
                
            }  
           
        } else{
            $error= "error";  
        }   
          
    }
    

    ?>

<div class="container">

<form action="" method="POST" enctype="multipart/form-data" id="form">
    <input type="email" name="Email" placeholder="Email">
    <input type="password" name="Password" placeholder="Password">
    <?php 
    if( !empty ($error) ){
        echo "<p>$error</p>";
    }
    ?>
        <input type="submit" name="submit" value="login">
    <p id="para">Don't have an account?<a href="./register.php" >Sign up</a></p>

    

</form>
    </div>
</body>
</html>