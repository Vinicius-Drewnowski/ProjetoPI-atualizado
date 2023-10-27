<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro no ReciclAPP</title>
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

        input[type="text"],
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
        <h2>Cadastrar no ReciclAPP</h2>
        <form action="cadastro.php" method="post">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="user" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="pw1" required>
            </div>
            <div class="form-group">
                <label for="password">Confirme sua senha:</label>
                <input type="password" name="pw2" required>
            </div>

            <button type="submit" name="register">Registrar-se</button>
            <p class="text-center">Já tem uma conta?<a href="index.php">Entre!</a>
                </p>
        </form>
    </div>
</body>
</html>

<?php
include "config.php";
$err = " ";
 
if (isset($_POST['register'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pw1 = $_POST['pw1'];
    $pw2 = $_POST['pw2'];

    if ($pw1 !== $pw2) {
        $err = "As senhas devem ser iguais";
    } else {
        $pw = md5($_POST['pw1']);
        $login = $conn->prepare('INSERT INTO `login` (`id_log`, `user_log`, `email_log`, `pass_log`) VALUES (NULL, :user, :email, :pw)');
        $login->bindValue(":user", $user);
        $login->bindValue(":email", $email);
        $login->bindValue(":pw", $pw);

        if ($login->execute()) {
            echo "Registrado com sucesso";
            header("location: login.php");
        } else {
            $err = "Erro ao inserir os dados";
        }
    }
}

if (!empty($err)) {
    echo $err;
}
?>