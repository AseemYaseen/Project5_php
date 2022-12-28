<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>register</title>
</head>
<body>

<?php require('./connection.php');?>
<?php

if(isset($_POST['submit'])){
    $name=$_POST['FirstName'];
    $lname=$_POST['LastName'];
    $email=$_POST['Email'];
    $number=$_POST['PhoneNumber'];
    $password=$_POST['Password'];
    $repassword=$_POST['Re-Password'];
   

    $one=0;
    $two=0;
    $three=0;
    $four=0;
    $five=0;
    $six=0;
    $siven=0;
    $error_name="";
    $error_lname="";
    $error_email="";
    $error_number="";
    $error_password="";
    $error_repassword="";
    $email_exist="";



    /////////////////////////////////////////////////////
    
$email_check=array();

$dd=crud::selectData();
foreach($dd as $value){
    array_push( $email_check , $value['Email']);

}   
if(in_array(  $email , $email_check)){
     $email_exist = "this email is exist";
}
else{
    $siven=1;

}



if(preg_match("/^[A-Z a-z]+$/",$_POST['FirstName'])&&!empty($_POST['FirstName'])){
    $name = $_POST['FirstName'];
    $one=1;

} else {
    $error_name= 'Your first name should contain just alphabets'."<br>";
}

if(preg_match("/^[A-Z a-z]+$/",$_POST['LastName'])&&!empty($_POST['LastName'])){
    $lname = $_POST['LastName'];
    $error_lname="";
    $two=1;

} else {
    $error_name= 'Your LastName name should contain just alphabets'."<br>";
}


if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)&&!empty($_POST['Email'])){
$email = $_POST['Email'];
$error_email="";
$three=1;
} else {
    $error_email= 'Your email is invalid'."<br>";
}
if(preg_match("/^[0-9\-\+]{14}$/",$_POST['PhoneNumber'])&&!empty($_POST['PhoneNumber'])){
    $number = $_POST['PhoneNumber'];
    $error_number="";
    $four=1;

} else {
    $error_number= 'phone number Should be 14 digits'."<br>";
}
if(preg_match(("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/"), $_POST['Password'])&&!empty($_POST['Password'])){
$password = $_POST['Password']; 
$error_password ="";
$five=1;
} else {

$error_password ='Your password is week'."<br>";
}
if(  $password ==  $repassword ){
    $error_repassword="";
    $six=1;

}else{
    $error_repassword= 'Your password is not match'."<br>";

}

if( $one==1 && $two==1 && $three==1 &&  $four==1 &&  $five==1 &&  $six==1 &&  $siven==1){
    $db = crud::connect()->prepare("INSERT INTO users (FirstName,LastName,Email,PhoneNumber,Password) VALUES (:fname,:lname,:email,:phone,:pass)");
    $db->bindValue(':fname' , $name);
    $db->bindValue(':lname' , $lname);
    $db->bindValue(':email' , $email);
    $db->bindValue(':phone' , $number);
    $db->bindValue(':pass' , $password);
    $db -> execute();
    // header("location:./login.php");
    exit;
    // echo 'Successfully'."<br>";

}else{
    echo 'not Successfully'."<br>";

}};
?>

<div class="container">

<h3>CREATE ACCOUNT</h3>
<form action="" method="POST" enctype="multipart/form-data" id="form">
    <input type="text" name="FirstName" placeholder="first name">
    <?php 
    if( !empty ($error_name) ){
        echo "<p>$error_name</p>";
    }
    ?>
     <input type="text" name="LastName" placeholder="Last name">
    <?php 
    if( !empty ($error_name) ){
        echo "<p>$error_name</p>";
    }
    ?>
    <input type="email" name="Email" placeholder="Email">
    <?php 
    if( !empty($error_email) ){
        echo "<p>$error_email</p>";
    }
    if( !empty($email_exist) ){
        echo "<p>$email_exist</p>";
    }
    ?>
    <input type="number" name="PhoneNumber" placeholder="Phone number">
    <?php 
    if(  !empty($error_number)){
        echo "<p>$error_number</p>";
    }
    ?>
    <input type="password" name="Password" placeholder="password">
    <?php 
    if(  !empty($error_password)){
        echo "<p>$error_password</p>";
    }
    ?>
    <input type="password" name="Re-Password" placeholder="confirm password">
    <?php 
    if(  !empty($error_repassword)){
        echo "<p>$error_repassword</p>";
    }
    ?>
    <input type="submit" name="submit" value="register">
    <p id="para">Do you have an account?<a href="./login.php" >Login</a></p>

</form>
    </div>
</body>
</html>