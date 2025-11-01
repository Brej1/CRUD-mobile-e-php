
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel='stylesheet' href='css/style.css'>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link rel="stylesheet" type="text/css" href="css/fonts-icones.css">
    <title>Document</title>
</head>
<body>
    <?php
        session_start(); 
        require_once("connection.php");

        $nome=$populacao=$continente=$idioma=$nome_c=$populacao_c=$id_pais_c=''; 



        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_pais']) && isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){
            
        
            $nome = $_POST['Nome'];
            $populacao = $_POST['Populacao'];
            $continente = $_POST['Continente'];
            $idioma = $_POST['Idioma'];
            $id_pais=$_SESSION['pais_selecionado'];

            $sql_update = "UPDATE paises  SET nome = '$nome', populacao = '$populacao', continente = '$continente', idioma = '$idioma' WHERE id_pais = '$id_pais'";
            
            if ($conn->query($sql_update) === TRUE) {
                echo '<p>País atualizado com sucesso</p>';
            } else {
                echo ' Falha ao atualizar o País: ' . $conn->error;
            }
        }




        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_cidade']) && isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
            

            $nome_c = $_POST['Nome'];
            $populacao_c = $_POST['Populacao'];
            $id_pais_c = $_POST['Pais']; 
            $id_cidade=$_SESSION['cidade_selecionada'];
            $sql_update = "UPDATE cidades SET nome = '$nome_c', populacao = '$populacao_c', id_pais = '$id_pais_c' WHERE id_cidade = '$id_cidade'";
            
            if ($conn->query($sql_update) === TRUE) {
                echo ' Cidade atualizada com sucesso!';
            } else {
                echo ' Falha ao atualizar a Cidade: ';
            }
        }



        if(isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){
            $sql = "SELECT * FROM paises WHERE id_pais={$_SESSION['pais_selecionado']}";
            $res = $conn->query($sql);
            
            if ($res && $campo = $res->fetch_assoc()) {
                echo('<form method="post">');
                
                echo("<table>");
                echo("<tr><th>nome</th><th>continente</th><th>população</th><th>idioma</th><th>Atualizar</th></tr>");
                echo("<tr>");
              
                echo('<td>Nome:<input type="text" name="Nome" value="'.htmlspecialchars($campo["nome"]).'" placeholder="nome"></td>');
                echo('<td>População:<input type="text" name="Populacao" value="'.htmlspecialchars($campo["populacao"]).'" placeholder="populacao"></td>');
                echo('<td>Continente:<input type="text" name="Continente" value="'.htmlspecialchars($campo["continente"]).'" placeholder="continente"></td>');
                echo('<td>Idioma:<input type="text" name="Idioma" value="'.htmlspecialchars($campo["idioma"]).'" placeholder="idioma"></td>');
                echo '<td><button type="submit" name="atualizar_pais" value="R"><i class="icon-pencil"></i></button></td>';
                echo("</tr>");
                echo("</table");
   
                echo('</form>');
            
            }
        }


        if(isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
            $id_cidade=$_SESSION['cidade_selecionada'];
            $sql = "SELECT C.id_cidade, C.nome, C.populacao, P.nome as pais from cidades C inner join paises P on(C.id_pais=P.id_pais)where id_cidade=$id_cidade";
            $res = $conn->query($sql);
             if ($res && $campo = $res->fetch_assoc()) {
                echo('<form method="post">');
                
                echo("<table>");
                echo("<tr><th>nome</th><th>população</th><th>País</th><th>Deletar</th></tr>");
                echo("<tr>");
              
                echo('<td>'.htmlspecialchars($campo["nome"]).'</td>');
                echo('<td>'.htmlspecialchars($campo["populacao"]).'</td>');
                echo('<td>'.htmlspecialchars($campo["pais"]).'</td>');
                echo '<td><button type="submit" name="atualizar_pais" value="R"><i class="icon-pencil"></i></button></td>';
                echo("</tr>");
                echo("</table");
   
                echo('</form>');
            
            }
        }


?>


</body>
</html>