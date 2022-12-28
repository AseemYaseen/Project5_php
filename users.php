<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
</head>
<style>
        table{
            width: 90%;
            display: block;
            margin: auto;
            text-align:center;
            font-weight:bold;
        }
        table,tr,td,th{
            border:1px solid gray;
            border-collapse:collapse;
        }
        th{
            width: 500px;
            background: red;
            color:white;
            height:30px;
        }
        img {
            width: 30px;
            display: block;
            margin: auto;

        }
    </style>
<body>
    <?php session_start(); ?> 
    <?php require('./connection.php'); ?>

<?php
// ------------------- delet user 
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $db = crud::delete();
    if($db->execute([':id' => $id])){
       
    }

}
?>
    <?php echo "<h1>"."welcome " . $_SESSION['name'] ."</h1>" . "<br>" ,
    "<h3>"."your email is ".$_SESSION['email']."</h3>";?>

    <?php $db = crud::selectData(); ?>

    <?php if( $_SESSION['role']== 1) :?>
    <table >
    <th>#</th>
    <th> First Name</th>
    <th> Last Name</th>
    <th> Email</th>
    <th>Password</th>
    <th>Phone Number</th>
    <th>edit</th>
    <th>delete</th>
</tr>
 <?php $i=1 ?>
<?php foreach($db as $value):?> 
<?php if($value['is_Deleted']==1){continue;};?> 
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $value['FullName']?></td>
        <td><?php echo $value['LastName']?></td>
        <td><?php echo $value['Email']?></td>
        <td><?php echo $value['Password']?></td>
        <td><?php echo $value['PhoneNumber']?></td>
        <td><a href="./edit.php?id=<?php echo $value['id']; ?>"><img src="./edit.png"></a></td>
        <td><a href="./users.php?id=<?php echo $value['id']; ?>" onclick="return confirm ('are you shure')" ><img src="./delete.jpg"></a></td>

    </tr>

<?php  endforeach;?>
<?php  endif;?>

</body>
</html>