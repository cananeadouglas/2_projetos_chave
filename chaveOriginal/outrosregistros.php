<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>
    <script src="css/jquery.min.js"></script>
    <link rel="stylesheet" href="css/pucha_php.css">
    <title>Registros dias anteriores</title>
</head>
<body onload="teste()">

<?php
include "cabeca.php";
?>

  <form action="" method="POST" name="diaex">
    <section>
        <div class="table-responsive">

        <h3 align="center">Lista de Registros</h3>

        <?php

        include "connection.php";
        $sql = mysqli_query($conn,"select data from registro group by 1 desc;") or die(' Erro na query:' . $sql . ' ' . mysqli_error());

        echo "<label>Selecione o dia</label>
        <select class='form-control' autofocus='true' name='sel1' id='sel1'>";

        while ($row = mysqli_fetch_array($sql)) 
        { 
        echo "<option>{$row['data']}</option>";
        }
        echo "</select></p>";

        ?>

        <input class="form-control" type="submit" name="diaex" value="VER DETALHES DO DIA" >
        </div>
    </section>
    </form><br>


    <div class="table-responsive">

            <h3 align="center">Registrados</h3>
<section>
            <?php

            date_default_timezone_set('America/Recife');
            $day = date('y.m.d');
            $time = date('H:i:s');
            //$day30 = date('y.m.d H:i', strtotime('-10 days'));

            if (!isset($_POST['sel1']))
            {
              echo " ";
            }
            else
            {
              $selectdata = $_POST['sel1'];

              include "connection.php";
              $sql = mysqli_query($conn, "SELECT p.nomef as name, IF(r.data = '$day','hoje', r.data) as data, r.hora, u.nomef, u.empresa, c.nome, r.info FROM usuario u inner JOIN registro r on u.id_user = r.id_user inner JOIN chave c on r.id_key = c.id_key inner join prevencao p on p.id_prev = r.id_prev WHERE r.data = '$selectdata' order by r.hora asc, r.info desc;") or die(' Erro na query:' . $sql . ' ' . mysqli_error() );



                echo "<table class='table table-hover'>";
                echo "<tr>";
                echo "<th>Prevenção</th>";
                echo "<th>Data</th>";
                echo "<th>Hora Retirada</th>";
                echo "<th>Nome</th>";
                echo "<th>Empresa</th>";
                echo "<th>Descrição Chave</th>";
                echo "<th>Informação</th>";
                //echo "<th>Quantidade</th>";
                echo "</tr><tr>";

                while ($row = mysqli_fetch_array( $sql )) 
                { 
                    //echo "<td>{$row['nome']}</td>"; echo utf8_encode("Bem vindo(a) $nome");
                    echo utf8_encode("<td>{$row['name']}</td>");
                    echo utf8_encode("<td>{$row['data']}</td>");
                    echo utf8_encode("<td>{$row['hora']}</td>");
                    echo utf8_encode("<td>{$row['nomef']}</td>");
                    echo utf8_encode("<td>{$row['empresa']}</td>");
                    echo utf8_encode("<td>{$row['nome']}</td>");
                    echo utf8_encode("<td>{$row['info']}</td></tr>");
                }
            }            

            ?>
</section>
        </div>
    <br><br>


<script src="script1.js"></script>

</body>
</html>




