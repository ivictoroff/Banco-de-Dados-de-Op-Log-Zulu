<?php
// Conecta ao banco de dados

$servername = "localhost";
$username = "root";
$password = "@160l0nc3t";
$dbname = "dbmat";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (!isset($_POST['pg'])) {

// Define os campos de pesquisa
$campos = array('pg', 'usuario', 'adm', 'senha');

// Define a consulta SQL
$query = "SELECT * FROM usuario WHERE ";

// Adiciona os campos de pesquisa à consulta
foreach ($campos as $campo) {
    if (isset($campo)){
        $query .= "$campo LIKE '%".$_GET[$campo]."%' AND ";
    }
}

// Remove o último "OR"
$query = substr($query, 0, -4);

// Executa a consulta
$result = $conn->query($query);

// Exibe os resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["uid"] . "<br>";
        echo "Nome: " . $row["pg"] . "<br>";
        echo "E-mail: " . $row["usuario"] . "<br>";
        echo "Telefone: " . $row["adm"] . "<br>";
        echo "Endereço: " . $row["senha"] . "<br><br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão
$conn->close();

}



?>


