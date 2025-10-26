<?php 
require_once("connection.php");
$sql="SELECT * FROM paises";
$res = $conn->query($sql);
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if (isset($_POST['pais_selecionado'])) {
         $_SESSION['pais_selecionado'] = $_POST["pais_selecionado"];
         $_SESSION['cidade_selecionada']="";
         if (isset($_POST['acao_selecionada'])) {
             echo($_POST['pais_selecionado']);

             if ($_POST['acao_selecionada']=="R"){
                header("Location: update.php");
                exit;
             }
            
            }
        }  
     if (isset($_POST['cidade_selecionada'])) {
         $_SESSION['cidade_selecionada']=$_POST["cidade_selecionada"];
         $_SESSION['pais_selecionado'] ="";
         if (isset($_POST['acao_selecionada'])) {
             echo($_POST['cidade_selecionada']);
              if ($_POST['acao_selecionada']=="R"){
                header("Location: update.php");
                exit;
             }
}            
     }
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
<?php

   # $sql="SELECT * FROM paises" where id_pai='';
   # $sql_cidade="SELECT C.nome, C.populacao, P.nome as pais from cidades C inner join paises P on(C.id_pais=P.id_pais)=''";

   # $sql=

?>
</body>
</html>