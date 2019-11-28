<?php
    
require "header.php";
require "config.php";

$_SESSION['username']= "admin";
$_SESSION['user_id']= 1;

	
	if(isset($_POST['submit']))
	{
            
            $login = new User;
            $login->username=$_POST['username'];
            $login->password=$_POST['password'];

            $username = str_replace("'","",$_POST['username']);
            $username = str_replace("<","",$username);
            $username = str_replace(">","",$username);

            $password = str_replace("'","",$_POST['password']);
            $password = str_replace("<","",$password);
            $password = str_replace(">","",$password);

            if(!empty($username) && !empty($password)){
                
                $database = new Conn();
                $db = $database->openConnection();
                $query = $db->query("SELECT * FROM users WHERE username='$username'");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $hashedPwdCheck = password_verify($password, $row[0]['password']);
			
			        if($hashedPwdCheck){
                        $_SESSION['username'] = $row[0]['username'];
                        $_SESSION['user_id'] = $row[0]['user_id'];
                        if($username == "admin" && $password == $password){
                            $_SESSION['admin'] = 1;
                            header("Location: admin_panel.php");
                            
                            }else{
                                $_SESSION['admin'] = 0;
                                header("Location: index.php");
                            }

                            }else{
                                echo "Username or password incorrect!";                
                            }

                }else{

                    echo "Username or password can't be empty";
                }
    }     

    $form = new Form("post", "");
    $form->open_tag();

    echo "<div class='login'>";
    echo "<h2>Login</h2>";
    echo "<br>";

    $form->input("text", "username", "username");
    echo "<br><br>";
    $form->input("password", "password", "password");

    echo "<br><br>";
    $form->input("submit", "submit", "Login", "Login");
    echo "<br>";

    $form->close_tag();
    echo "<p style='text-align:center'>Don't have an account? <a href='register.php'>Register now</a></p>";
    echo "</div>";
?>