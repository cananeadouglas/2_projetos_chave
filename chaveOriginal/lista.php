<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>
    <script src="css/jquery.min.js"></script>
    <link rel="stylesheet" href="css/pucha_php.css">
    <title>Lista de Pendências</title>
        <style type="text/css">
      
      section {
    background: #cce6ff;/*cor de fundo */
    border-radius: 15px;/*bordas arredondadas*/
    padding: 15px;/*espaço entre o texto e a borda*/
    margin: 0 auto;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.501);/* sobreamento e cor*/
    
}
    </style>
</head>
<body onload="teste()">

<?php
include "cabeca.php";
?>

    <section>
        <div class="table-responsive">

            <h3 align="center">Lista de Pendências - ( CHAVES RETIRADAS )</h3>

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

            $sql = mysqli_query($conn,"SELECT u.nomef as usuarionome, u.empresa, IF(r.data = '$day','hoje', r.data) as data, r.hora, p.nomef as prevencao, c.nome FROM usuario u INNER JOIN registro r on u.id_user = r.id_user INNER JOIN chave c on r.id_key = c.id_key INNER JOIN prevencao p on r.id_prev = p.id_prev WHERE c.situacao = 1") or die(' Erro na query:' . $sql . ' ' . mysqli_error() );

            echo "<table class='table table-hover'><tr>";
            echo "<th>Colaborador</th>";
            echo "<th>Empresa</th>";
            echo "<th>Dia</th>";
            echo "<th>Hora</th>";
            echo "<th>Prevenção</th>";
            echo "<th>Chave Fornecida</th>";
            //echo "<th>Informação</th>";
            //echo "<th>Quantidade</th>";
            echo "</tr><tr>";

            while ($row = mysqli_fetch_array( $sql )) 
            { 
                //echo "<td>{$row['nome']}</td>"; echo utf8_encode("Bem vindo(a) $nome");
                echo utf8_encode("<td>{$row['usuarionome']}</td>");
                echo utf8_encode("<td>{$row['empresa']}</td>");
                echo utf8_encode("<td>{$row['data']}</td>");
                echo utf8_encode("<td>{$row['hora']}</td>");
                echo utf8_encode("<td>{$row['prevencao']}</td>");
                echo utf8_encode("<td>{$row['nome']}</td></tr>");
            }
            // align='center'
            ?>

        </div>
    </section><br><br>

<script src="script1.js"></script>

</body>
</html>