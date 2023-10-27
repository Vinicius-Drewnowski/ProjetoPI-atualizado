<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bem vindo ao ReciclAPP!</title>
    <style>
        body {
            background-color: #4CAF50;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }

        .container {
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin-top: 0;
        }

        a {
            text-decoration: none;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location: index.php");
}
include "config.php";
$consulta=$conn->prepare('SELECT * FROM login WHERE id_log = :id');
$consulta->bindValue(":id", $_SESSION['login']);
$consulta->execute();
$row=$consulta->fetch();
?>
<h1>Olá, <?php echo $row['user_log']; ?></h1>
<a href="logout.php">Logout</a>
</div>
</body>
</html>