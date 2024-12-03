<?php


?>



<form action="a.php" method="get">
    <label for="nome">Nome:</label>
    <input type="text" id="operacao" name="operacao"><br><br>
    <label for="data_inicial">Data Inicial (dd/mm/aaaa):</label>
    <input type="text" id="data_inicial" name="inicioOp"><br><br>
    <label for="data_final">Data Final (dd/mm/aaaa):</label>
    <input type="text" id="data_final" name="fimOp"><br><br>
    <button type="submit">Pesquisar</button>
</form>


<?php

// Conecta ao banco de dados
require '../../acoes/bd.php';

// Define os campos de pesquisa
$campos = array('operacao');

// Define a consulta SQL
$query = "SELECT * FROM operacao WHERE ";

// Verifica se as datas estão preenchidas
if (!empty($_GET['inicioOp']) && !empty($_GET['fimOp'])) {
    $data_inicial = date_create_from_format('d/m/Y', $_GET['inicioOp']);
    $data_final = date_create_from_format('d/m/Y', $_GET['fimOp']);
    
    $query .= "inicioOp >= '".date_format($data_inicial, 'Y-m-d')."' AND fimOp <= '".date_format($data_final, 'Y-m-d')."'";
    
    if (!empty($_GET['operacao'])) {
        $query .= " AND operacao LIKE '%".$_GET['operacao']."%'";
    }
} else {
    // Busca sem datas
    if (!empty($_GET['operacao'])) {
        $query .= "operacao LIKE '%".$_GET['operacao']."%'";
    }
}

// Executa a consulta
$result = $conn->query($query);

// Exibe os resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["opid"] . "<br>";
        echo "Nome: " . $row["operacao"] . "<br>";
        echo "Data: " . date_format(date_create_from_format('Y-m-d', $row["inicioOp"]), 'd/m/Y') . "<br><br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão
$conn->close();

?>