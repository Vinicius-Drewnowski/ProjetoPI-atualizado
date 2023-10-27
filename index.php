<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ReciclAPP</title>
    <style>
        body {
            background-color: #4CAF50;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ffffff;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        button {
            width: 95%;
            padding: 10px;
            background-color: #ffffff;
            color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3E8E41;
        }

        .text-center {
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>ReciclAPP - Login</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="email">email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="pw" required>
            </div>
            <button type="submit" name="logar">Entrar</button>
            <p class="text-center">Ainda não tem uma conta? | <a href="cadastro.php">Cadastre-se!</a>
                </p>
        </form>
    </div>
</body>
</html>

<?php
include "config.php";

if(isset($_POST['logar'])){
    $email=$_POST['email'];
    $pw=MD5($_POST['pw']);
    
    $login = $conn->prepare('SELECT * FROM login WHERE email_log = :email AND pass_log=:pw');
        $login->bindValue(":email", $email);
        $login->bindValue(":pw", $pw);
        $login->execute();
        if($login->rowCount()==0){
            echo "Login ou senha invalida!";
        }
        else{
            $cons=$login->fetch();
            $id=$cons['id_log'];
            session_start();
            $_SESSION['login']=$id;
            header("location: login.php");
}
}
?>