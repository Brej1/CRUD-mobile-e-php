<?php
session_start(); 
require_once("connection.php");
if(isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){
    $sql = "SELECT * FROM paises WHERE id_pais={$_SESSION['pais_selecionado']}";
    $res = $conn->query($sql);
    $campo = $res->fetch_assoc();
    echo($campo["nome"]);
    echo('<form method="post">');
    echo('<input type="text" name="Nome" value="'.$campo["nome"].'" placeholder="nome">');
    echo('<input type="text" name="Populacao" value="'.$campo["populacao"].'" placeholder="populacao">');
    echo('<input type="text" name="Continente" value="'.$campo["continente"].'" placeholder="continente">');
    echo('<input type="text" name="Idioma" value="'.$campo["idioma"].'" placeholder="idioma">');

}
if(isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
    $sql = "SELECT * FROM cidades WHERE id_cidade={$_SESSION['cidade_selecionada']}";
    $res = $conn->query($sql);
    $campo = $res->fetch_assoc();
    echo($campo["nome"]);
    echo('<form method="post">');
    echo('<input type="text" name="Nome" value="'.$campo["nome"].'" placeholder="nome">');
    echo('<input type="text" name="Populacao" value="'.$campo["populacao"].'" placeholder="populacao">');
    echo('<input type="text" name="Pais" value="'.$campo["id_pais"].'" placeholder="pais">');

}
?>