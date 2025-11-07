
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


<a href="index.php"><i class="icon-arrow-left"></i></a>
    <?php
        session_start(); 
        require_once("connection.php");

        $nome=$populacao=$continente=$idioma=$nome_c=$populacao_c=$id_pais_c=''; 




        if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){
            
            $nome = $_POST['Nome'];
            $populacao = $_POST['Populacao'];
            $continente = $_POST['Continente']; 
            $idioma=$_POST['Idioma'];

           $sql="INSERT INTO paises(nome, populacao, continente, idioma) VALUES('$nome', '$populacao', '$continente', '$idioma')";    
            if(!empty($nome) && !empty($populacao) && !empty($continente) && !empty($idioma)){
                if ($conn->query($sql) === TRUE) {
                    echo ' País atualizado';
                } else {
                    echo ' Falha ao atualizar País ';
                }
        }


    }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
            

            $nome_c = $_POST['Nome'];
            $populacao_c = $_POST['Populacao'];
            $id_pais_c = $_POST['Pais']; 
            $id_cidade=$_SESSION['cidade_selecionada'];
            $sql_update = "INSERT INTO cidades(nome,populacao,id_pais) VALUES ('$nome_c', '$populacao_c', '$id_pais_c')";
             if(!empty($nome_c) && !empty($populacao_c)){ 
                if ($conn->query($sql_update) === TRUE) {
                    echo ' Cidade atualizada com sucesso!';
                } else {
                    echo ' Falha ao atualizar a Cidade: ';
                }
        }
    }



    if(isset($_SESSION['pais_selecionado']) && !empty($_SESSION['pais_selecionado'])){
      
     
        $sql = "SELECT * FROM paises";
        $res = $conn->query($sql);
        

        
        if ($res && $campo = $res->fetch_assoc()) {
            
            $continentes_disponiveis = ["África", "América", "Ásia", "Europa", "Oceania"];
            $continente_salvo = $campo["continente"]; 
            
            echo('<form method="post">');
            
            echo("<table>");
            echo("<tr><th>nome</th><th>continente</th><th>população</th><th>idioma</th><th>Inserir</th></tr>");
            echo("<tr>");
            

            echo('<td>Nome:<input type="text" name="Nome" value="" placeholder="nome"></td>');
            
      
            echo('<td>Continente:'); 
      
            echo('<select name="Continente">'); 
            
            echo('<option value="">-- Selecione o Continente --</option>');
            
            foreach ($continentes_disponiveis as $nome_continente) {
               
                $selecionado = ($continente_salvo === $nome_continente) ? 'selected' : '';
                
             
                echo '<option value="' . htmlspecialchars($nome_continente) . '" ' . $selecionado . '>' . htmlspecialchars($nome_continente) . '</option>';
            }
            
            echo('</select>');
            echo('</td>');
       
            echo('<td>População:<input type="text" name="Populacao" value="" placeholder="populacao"></td>');
            

            echo('<td>Idioma:<input type="text" name="Idioma" value="" placeholder="idioma"></td>');
            
 
            echo '<td><button type="submit" name="atualizar_pais" value="R"><i class="icon-plus"></i></button></td>';
            
            echo("</tr>");
            echo("</table>");
            
            echo('</form>');
        }
    }

      if(isset($_SESSION['cidade_selecionada']) && !empty($_SESSION['cidade_selecionada'])){
            $id_cidade=$_SESSION['cidade_selecionada'];
            $sql = "SELECT  C.id_pais as id_pais_salvo from cidades C inner join paises P on(C.id_pais=P.id_pais)";
            $res = $conn->query($sql);
            $sql_paises = "SELECT id_pais, nome FROM paises ORDER BY nome";
            $res_paises = $conn->query($sql_paises);

            if ($res && $campo = $res->fetch_assoc()) {
                $id_pais_salvo = $campo["id_pais_salvo"];
                
                echo('<form method="post">');
                
                echo("<table>");
                echo("<tr><th>nome</th><th>população</th><th>País</th><th>Inserir</th></tr>");
                echo("<tr>");
                
                echo('<td><input type="text" name="Nome" value="'.htmlspecialchars($campo["nome"]).'" placeholder="nome"></td>');
                echo('<td><input type="text" name="Populacao" value="'.htmlspecialchars($campo["populacao"]).'" placeholder="populacao"></td>');
                echo('<td>');
                echo('<select name="Pais">'); 
                
                if ($res_paises) {
                    while ($pais = $res_paises->fetch_assoc()) {
                        $valor = $pais["id_pais"]; 
                        $nome_exibido = $pais["nome"];
                        $selecionado = ($id_pais_salvo == $valor) ? 'selected' : '';
                        
                        echo ('<option value="' . htmlspecialchars($valor) . '" ' . $selecionado . '>' . htmlspecialchars($nome_exibido) . '</option>');
                    }
                }

                echo('</select>');
                echo('</td>');
                echo('<td><button type="submit" name="atualizar_cidade" value="R"><i class="icon-plus"></i></button></td>');
                echo("</tr>");
                echo("</table>");
                echo('</form>');
            }
         

        }
    ?>
</body>
</html>



</html>