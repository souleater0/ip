<?php
    function loginProcess($pdo){
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username= ?");
            $stmt ->execute([$username]);
            $user = $stmt ->fetch();
    
            if($user && password_verify($password, $user["password"])){
                //login success
                // session_start();
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                return true;
            }else{
                return false;
            }
    }
?>
