<!DOCTYPE html>
<html>
<head>
  <title>LISTA</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
include "cabeca.php";
?>

    <section class="maior">
        <div class="table-responsive">

            <h3 align="center">Lista de CHAVES RETIRADAS</h3>

            <?php

            date_default_timezone_set('America/Recife');
            $day = date('y.m.d');
            $time = date('H:i:s');

            //$senha = "123456ABFDSiuyp";
            //$senhaCript = base64_encode($senha);
            //$recuperada = base64_decode($senhaCript);
            //echo "$senhaCript - aqui ";
            //echo "$recuperada - aqui";
                
            include "connection.php";

            $sql = mysqli_query($conn,"SELECT u.nomef as usuarionome, u.empresa, IF(r.data_r = '$day','hoje', r.data_r) as data0, r.data_d as data1, r.hora_r as hora0, r.hora_d as hora1, p.nomef, r.prev_d, r.user_d, c.nome FROM usuario u INNER JOIN registros r on u.id_user = r.id_user_r INNER JOIN chave c on r.id_key = c.id_key 
                               INNER JOIN prevencao p on r.id_prev_r = p.id_prev
                               WHERE c.situacao = 1 and r.info = 'retirada' ; ") or die(' Erro na query:' . $sql . ' ' . mysqli_error() );

            echo "<table class='table table-hover'><tr>";
            echo "<th>Colaborador</th>";
            echo "<th>Empresa</th>";
            echo "<th>Dia Ret.</th>";
            echo "<th>Dia Dev.</th>";
            echo "<th>Hora Ret.</th>";
            echo "<th>Hora Dev.</th>";
            echo "<th>Prevenção Ret.</th>";
            echo "<th>Prevenção Dev.</th>";
            echo "<th>C. Dev.</th>";
            echo "<th>Chave Fornecida</th>";
            //echo "<th>Informação</th>";
            //echo "<th>Quantidade</th>";
            echo "</tr><tr>";

            while ($row = mysqli_fetch_array( $sql )) 
            { 
                //echo "<td>{$row['nome']}</td>"; echo utf8_encode("Bem vindo(a) $nome");
                echo utf8_encode("<td>{$row['usuarionome']}</td>");
                echo utf8_encode("<td>{$row['empresa']}</td>");
                echo utf8_encode("<td>{$row['data0']}</td>");
                echo utf8_encode("<td>{$row['data1']}</td>");
                echo utf8_encode("<td>{$row['hora0']}</td>");
                echo utf8_encode("<td>{$row['hora1']}</td>");
                echo utf8_encode("<td>{$row['nomef']}</td>");
                echo utf8_encode("<td>{$row['prev_d']}</td>");
                echo utf8_encode("<td>{$row['user_d']}</td>");
                echo utf8_encode("<td>{$row['nome']}</td></tr>");
            }
            // align='center'
            ?>

        </div>
    </section><br><br>

<script src="script1.js"></script>

</body>
</html>