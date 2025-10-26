<?php
require_once("connection.php");
$sql="SELECT * FROM paises";
$res = $conn->query($sql);
$sql_cidade="SELECT C.id_cidade, C.nome, C.populacao, P.nome as pais from cidades C inner join paises P on(C.id_pais=P.id_pais)";
$res_cidade= $conn->query($sql_cidade);
// Defina aqui a sua chave de API do Google Maps
$google_maps_api_key = "AIzaSyD1ymgJSOFD9yCS4hoC7hNeU8Km40bbQi0";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mapa com Google Maps API e PHP</title>
    <style>
        /* Estilização básica do mapa */
        #map {
            height: 500px;
            width: 100%;
            border: 2px solid #333;
            border-radius: 10px;
        }
    </style>
</head>
<body>
   
        
        <?php
           //tabela de paises        
            echo("<table>"); 
			echo("<tr><th>nome</th><th>continente</th><th>população</th><th>idioma</th></tr>");
            while($campo = $res->fetch_assoc()){ 
                    echo("<tr>");
                    echo("<td>".$campo["nome"]."</td>"); 
                    echo("<td>".$campo["continente"]."</td>"); 
                    echo("<td>".$campo["populacao"]."</td>");
                    echo("<td>".$campo["idioma"]."</td>");
                    echo("<td>"); 
                    echo('<form method="post" action="crud.php">'); 
                        echo '<input type="hidden" name="pais_selecionado" value="' . htmlspecialchars($campo['id_pais']) . '">';
                        echo '<input type="submit" name="acao_selecionada" value="R">';
                    echo('</form>');
                    echo("</td>");
                    echo("<td>"); 
                    echo('<form method="post" action="crud.php">'); 
                        echo '<input type="hidden" name="pais_selecionado" value="' . htmlspecialchars($campo['id_pais']) . '">';
                        echo '<input type="submit" name="acao_selecionada" value="D">';
                    echo('</form>');
                    echo("</td>");
              	    echo("</tr>");
                 
                
               
         
			}
			echo("</table>"); 


            //tabela de cidades              
            echo("<table>");
			echo("<tr><th>nome</th><th>população</th><th>pais</th></tr>");
            while($campo_cidade = $res_cidade->fetch_assoc()){ 
                    echo("<tr>");
                    echo("<td>".$campo_cidade["nome"]."</td>");
                    echo("<td>".$campo_cidade["populacao"]."</td>"); 
                    echo("<td>".$campo_cidade["pais"]."</td>"); 
                    echo("<td>"); 
                    echo('<form method="post" action="crud.php">'); 
                        echo '<input type="hidden" name="cidade_selecionada" value="' . htmlspecialchars($campo_cidade['id_cidade']) . '">';
                        echo '<input type="submit" name="acao_selecionada" value="R">';
                    echo('</form>');
                    echo("</td>");
                    echo("<td>"); 
                    echo('<form method="post" action="crud.php">'); 
                        echo '<input type="hidden" name="cidade_selecionada" value="' . htmlspecialchars($campo_cidade['id_cidade']) . '">';
                        echo '<input type="submit" name="acao_selecionada" value="D">';
                    echo('</form>');
                    echo("</td>");
              	    echo("</tr>");
			}
          
			echo("</table>"); 
		  
        ?>

    <div id="map"></div>
    <script>
        // Função que inicializa o mapa
        function initMap() {
            // Define as coordenadas (latitude e longitude) do local desejado
            const localizacao = { lat: -23.21968520383101, lng: -45.90665248787622 }; // São Paulo, SP , 

            // Cria o mapa centralizado no local
            const mapa = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: localizacao,
            });

            // Adiciona um marcador no mapa
            const marcador = new google.maps.Marker({
                position: localizacao,
                map: mapa,
                title: "São Paulo - SP",
            });
        }
    </script>

    <!-- Script da API do Google Maps (com a chave PHP inserida dinamicamente) -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api_key; ?>&callback=initMap">
    </script>
</body>
</html>