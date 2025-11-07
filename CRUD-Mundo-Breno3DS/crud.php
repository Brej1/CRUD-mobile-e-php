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
             elseif($_POST['acao_selecionada']=="D"){
                header("Location: delete.php");
                exit;
             }
            elseif($_POST['acao_selecionada']=="C"){
                header("Location: create.php");
                exit;
             }
            
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
              elseif($_POST['acao_selecionada']=="D"){
                 header("Location: delete.php");
                exit;
             }        
            elseif($_POST['acao_selecionada']=="C"){
                header("Location: create.php");
                exit;
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

</body>
</html>