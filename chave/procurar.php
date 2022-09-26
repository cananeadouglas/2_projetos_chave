<!DOCTYPE html>
<html>
<head>
  <title>PROCURAR CHAVE</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body onload="teste()">
 
<?php
include "cabeca.php";
?>


     <form action="" method="POST" name="diaex">
    <section class="euaqui">
        <div class="table-responsive">

        <h3 align="center">Consultar</h3>

        <label>Consulte por qr-code</label>
        <input class="form-control" id="valordigitado" name="valor" type="password" autofocus="true" placeholder="Registro QR-Code - CHAVE" required="required"><br><br>
        
        <input class="form-control" type="submit" value="Pesquisar" >
        </div>
    </section>
    </form>



<script src="script1.js"></script>

</body>
</html>

<section class="euaqui">
  
  <?php
// carregando na mesma página dados da data escolhida.
if (!isset($_POST['valor']))
{
  echo " ";
}
else
{
  $sele = $_POST['valor'];
  include "connection.php";

    $sql2 = mysqli_query($conn, "SELECT nome, IF(situacao = 0,'Disponível','Retirada') as situacao FROM chave WHERE codigo = '$sele'; ") or die(mysqli_error());
    $row = mysqli_num_rows($sql2);
    //$sql2 = mysqli_query($conn, "SELECT u.login, p.descricao, p.local_setor, p.valor, p.quantidade  FROM produto p, usuario u WHERE p.descricao like '%$sele%' or p.valor like '%$sele%' or p.local_setor like '%$sele%' or u.login like '%$sele%' or p.quantidade like '%$sele%'") or die(mysqli_error());
    //$row = mysqli_num_rows($sql2);

if($row > 0){

  echo "<table class='table table-hover'><tr>";
  echo "<th>Nome da Chave</th>";
  echo "<th>Situação</th>";
  echo "</tr><tr><br/>";

  while($linha = mysqli_fetch_array($sql2)){

  //echo "<td align='center'>{$linha['nome']}</td>";
  echo("<td>{$linha['nome']}</td>");
  echo("<td>{$linha['situacao']}</td>");
  echo("</tr>");
}
  echo "</table><br/>";

}else{
  echo "<h4><center>nenhum encontrado, digite novamente</center></h4>";
}
}

?>
</section>


