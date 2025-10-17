<?php
require_once("connection.php");
$sql="SELECT * FROM paises";
$res = $conn->query($sql);
$sql_cidade="SELECT C.nome, C.populacao, P.nome as pais from cidades C inner join paises P on(C.id_pais=P.id_pais)";
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
    <form method="post">
        
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
              	echo("</tr>");
			}
			echo("</table>"); 


            //tabela de cidades              
            echo("<table>");
			echo("<tr><th>nome</th><th>população</th><th>pais</th></tr>");
            while($campo = $res_cidade->fetch_assoc()){ 
                    echo("<tr>");
                    echo("<td>".$campo["nome"]."</td>");
                    echo("<td>".$campo["populacao"]."</td>"); 
                    echo("<td>".$campo["pais"]."</td>"); 
              	echo("</tr>");
			}
			echo("</table>"); 
		  
        ?>
    </form>
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