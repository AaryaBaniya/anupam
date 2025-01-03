<?php 

include 'connect.php';
// if(isset($_POST['fullname'])){
// echo "<p>hi</p>";
// }
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// echo($_SERVER['HTTP_REFERER']);
if($_SERVER['HTTP_REFERER']=='http://localhost/anupam/signup.php'){

    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
    
 
     $checkEmail="SELECT * From customer where email='$email'";
    $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO customer(fullname,email,password)
                       VALUES ('$fullname','$email','$password')";
            if($conn->query($insertQuery)==TRUE)
            {
                header("location: sign.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signin'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM customer WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: homepage.php");
    exit();
}
else{
 echo "Not Found, Incorrect Email or Password";
}

}
?>