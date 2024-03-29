<?php
// Configurações e conexão com o banco de dados
$servidor = "localhost"; 
$username = "seu_usuario"; 
$usersenha = "sua_senha"; 
$database = "injector"; 

try {
    $pdo = new PDO("pgsql:host=$servidor;dbname=$database", $username, $usersenha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Inicializa a variável $resultado
$resultado = "";

// Verifica se a injeção está ativada
$injecao_ativada = isset($_POST["injection_toggle"]) && $_POST["injection_toggle"] == "on";

// Verifica se há comando SQL enviado via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comandos"])) {
    if ($injecao_ativada) {
    $comandos = $_POST["comandos"];
    try {
        // Prepara a consulta
        $statement = $pdo->prepare($comandos);

        // Executa a consulta
        $statement->execute();

        // Obtém os resultados
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $resultado .= implode(', ', $row) . "\n";
        }
    } catch (PDOException $e) {
        $resultado = "Erro ao executar o comando SQL: " . $e->getMessage();
    }
}
    else {
        // Quando a injeção está desativada, exibe uma mensagem de erro
        $resultado = "Erro: Injeção desativada. Por favor, ative para executar os comandos SQL.";
    }
}

// Retorna o resultado para exibição no textarea
echo $resultado;
?>
