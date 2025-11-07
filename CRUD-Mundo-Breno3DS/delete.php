
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='css/style.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="css/fonts-icones.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php"><i class="icon-arrow-left"></i></a>


    <?php
session_start(); 
require_once("connection.php");


$mensagem_feedback = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar_pais']) && isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])) {
    
    $id_selecionado = $_SESSION['pais_selecionado'];
    

    $sql_delete = "DELETE FROM paises WHERE id_pais = {$id_selecionado}";
    
    if ($conn->query($sql_delete) === TRUE) {
        $mensagem_feedback = ' País DELETADO';
  
        unset($_SESSION['pais_selecionado']); 
    } else {
        $mensagem_feedback = 'Falha ao deletar o País: ' . $conn->error . '';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar_cidade']) && isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])) {
    
    $id_selecionado = $_SESSION['cidade_selecionada'];

    $sql_delete = "DELETE FROM cidades WHERE id_cidade = {$id_selecionado}";
    
    if ($conn->query($sql_delete) === TRUE) {
        $mensagem_feedback = 'Cidade DELETADA com sucesso!';
       
        unset($_SESSION['cidade_selecionada']); 
    } else {
        $mensagem_feedback = '<Falha ao deletar a Cidade: ' . $conn->error . '';
    }
}


if (!empty($mensagem_feedback)) {
    echo $mensagem_feedback;
}



if(isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){

    $sql = "SELECT * FROM paises WHERE id_pais={$_SESSION['pais_selecionado']}";
    $res = $conn->query($sql);
    
    if ($res && $campo = $res->fetch_assoc()) {
      
        echo '<p>Você realmente deseja DELETAR o país:</p>';
        
        
        echo '<table>';
        echo'<tr>';
        echo'<th>Nome</th><th>População</th><th>Continente</th><th>Idioma</th><th>Deletar</th>';
        echo'</tr>';
        echo'<tr>';
        echo '<td>' . htmlspecialchars($campo["nome"]) . '</td>';
        echo '<td>' . htmlspecialchars($campo["populacao"]) . '</td>';
        echo '<td>' . htmlspecialchars($campo["continente"]) . '</td>';
        echo '<td>' . htmlspecialchars($campo["idioma"]) . '</td>';
        echo('<form method="post">');
        echo '<td><button type="submit" name="deletar_pais" value="D"><i class="icon-delete-garbage-streamline"></i></button></td>';
        echo('</form>');
        echo'</tr>';
        echo '</table>';
        
    
    } else {
        echo 'País selecionado não encontrado.';
    }
}




if(isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
    
    $sql = "SELECT C.id_cidade, C.nome, C.populacao, P.nome as pais from cidades C inner join paises P on(C.id_pais=P.id_pais)";
    $res = $conn->query($sql);
    
    if ($res && $campo = $res->fetch_assoc()) {
        echo '<p>Você realmente deseja DELETAR a cidade:</p>';
        
          echo '<table>';
        echo'<tr>';
        echo'<th>Nome</th><th>População</th><th>País</th><th>Deletar</th>';
        echo'</tr>';
        echo'<tr>';
        echo '<td>' . htmlspecialchars($campo["nome"]) . '</td>';
        echo '<td>' . htmlspecialchars($campo["populacao"]) . '</td>';
        echo '<td>' . htmlspecialchars($campo["pais"]) . '</td>';
        echo('<form method="post">');
        echo '<td><button type="submit" name="deletar_cidade" value="D"><i class="icon-delete-garbage-streamline"></i></button></td>';
        echo('</form>');
        echo'</tr>';
        echo '</table>';
        
        

    } else {
        echo '<Cidade selecionada não encontrada.';
    }
}


?>
</body>
</html>