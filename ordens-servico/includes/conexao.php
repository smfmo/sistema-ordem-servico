<?php
    $host = "localhost";
    $port = "5433";
    $dbname = "ordens_servico";
    $username = "postgres";
    $password = "123456";

    try{
        $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die("Erro de conexão com o banco de dados: " . $e->getMessage());
    }
?>

