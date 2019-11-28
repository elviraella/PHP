<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "header.php";
require "config.php";

if(isset($_POST['submit'])){
   $user = new User;
   $user->firstname = $_POST['firstname'];
   $user->lastname  = $_POST['lastname'];
   $user->email     = $_POST['email'];
   $user->username  = $_POST['username'];
   $user->password  = $_POST['password'];

   $firstname = trim($_POST['firstname']);
   $lastname  = trim($_POST['lastname']);
   $email     = trim($_POST['email']);
   $username  = trim($_POST['username']);
   $password  = trim($_POST['password']);
   
   $firstname = str_replace("'", "", $_POST['firstname']);
   $firstname = str_replace("<", "", $firstname);
   $firstname = str_replace(">", "", $firstname);

   $lastname  = str_replace("'", "", $_POST['lastname']);
   $lastname  = str_replace("<", "", $lastname);
   $lastname  = str_replace(">", "", $lastname);

   $username = str_replace("'", "", $_POST['username']);
   $username = str_replace("<", "", $username);
   $username = str_replace(">", "", $username);

   $password = str_replace("'", "", $_POST['password']);
   $password = str_replace("<", "", $password);
   $password = str_replace(">", "", $password);

   if(!preg_match("/^[a-zA-Z]{1,30}$/", $firstname)){
    echo "<p>Name only has to contain letters!</p>";

   }elseif(!preg_match("/^[a-zA-Z]{1,30}$/", $lastname)){
       echo "<p>Surname only has to contain letters!</p>";

   }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       echo "<p>Email is not a valid email address.</p>";

   }elseif(strlen($password) <= 5){
       echo "<p>Password must be higher than 5 characters!</p>";

   }elseif(empty($firstname) && empty($lastname) && empty($email) && empty($username) && empty($password)){
       echo "<p>All fields are required.</p>";

   }else{
       try
       {
           $database = new Conn();
           $db = $database->openConnection();

           $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
           $sql="INSERT INTO users VALUES (null, '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['email']."', '".$_POST['username']."', '".$hashedPwd."')";
           $db->exec($sql);
           echo "<p>Account created successfully>/p>";
           header("refresh:5; url=login.php");
           $database->closeConnection();
       }
       catch (PDOException $e)
       {
           echo "Connection failed: ".$e->getMessage();
       }
   }
}

$form = new Form("post", "");
$form->open_tag();

echo "<div class='form'>";
echo "<h2>Register</h2>";

$form->label("firstname", "Name");
$form->input("text", "firstname");

$form->label("lastname", "Surname");
$form->input("text", "lastname");

$form->label("email", "Email");
$form->input("text", "email");

$form->label("username", "Username");
$form->input("text", "username");

$form->label("password", "Password");
$form->input("password", "password");

$form->label("register", "Register");
$form->input("submit", "submit", "Register", "Register");

$form->close_tag();
echo '<p>Already have an account? <a href="login.php"> Login here</a></p>';
echo "</div>";
?>