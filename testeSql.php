<?php

function paginacaoSql($pagina, $qtd = 10) {
    $sql = "SELECT * FROM cartas LIMIT " . ($pagina - 1) * $qtd . ", $qtd";

    echo $sql;
}

paginacaoSql($_GET['pagina'] ?? 1);

?>
<p>
<?php
for ($n = 1 ; $n < 10 ; $n++) {
    ?>
<a href="testeSql.php?pagina=<?php echo $n ?>"><?php echo $n ?></a> - 
    <?php
}
?>
</p>