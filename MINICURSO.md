# MINICURSO
Um SQL Injector é uma ferramenta ou técnica usada para explorar vulnerabilidades de segurança em aplicativos da web que interagem com bancos de dados por meio de consultas SQL. O objetivo principal de um SQL Injector é injetar comandos SQL maliciosos em uma aplicação da web para obter acesso não autorizado ao banco de dados subjacente.

## TEORIA:
### Funcionamento do SQL Injector:
1. **Identificação de Vulnerabilidades:**
   - Um SQL Injector procura por vulnerabilidades em aplicativos da web que aceitam entrada do usuário e constroem consultas SQL dinamicamente sem sanitização adequada.

2. **Injeção de Comandos SQL:**
   - Quando uma vulnerabilidade é encontrada, o SQL Injector pode injetar comandos SQL maliciosos nos campos de entrada do aplicativo, como campos de formulário, parâmetros de URL ou cookies.

3. **Execução de Comandos SQL:**
   - Os comandos SQL injetados são então executados pelo sistema de gerenciamento de banco de dados (SGBD) sem validação ou filtragem adequada. Isso pode levar a uma variedade de ações maliciosas, como acesso não autorizado a dados confidenciais, manipulação ou exclusão de dados, e até mesmo comprometimento do sistema.

4. **Exploração de Dados Sensíveis:**
   - Uma vez que os comandos SQL maliciosos são executados com sucesso, um invasor pode explorar a infraestrutura do banco de dados em busca de dados sensíveis, como informações de login, dados pessoais dos usuários ou informações financeiras.

### Métodos de Prevenção:
- **Sanitização de Entrada:**
  - É fundamental validar e sanitizar todos os dados de entrada do usuário antes de construir consultas SQL. Isso ajuda a prevenir a injeção de comandos SQL maliciosos.

- **Uso de Parâmetros Preparados:**
  - O uso de parâmetros preparados ou consultas parametrizadas ajuda a separar os dados do comando SQL, evitando assim a injeção de código malicioso.

- **Princípio do Menor Privilégio:**
  - Limitar as permissões de acesso ao banco de dados para usuários e aplicativos apenas ao necessário. Isso reduz o impacto potencial de uma injeção SQL bem-sucedida.

- **Auditoria e Monitoramento:**
  - Implementar logs de auditoria e monitoramento para detectar e responder rapidamente a tentativas de injeção SQL e outras atividades maliciosas.

## PRATICA:
Vou mostrar dois exemplos: um utilizando consultas SQL preparadas (preparadas para prevenir injeção SQL) e outro sem consultas SQL preparadas (vulnerável à injeção SQL).

### Exemplo com Consultas SQL Preparadas (Seguro):
```php
<?php
// Conexão com o banco de dados (usando PDO)
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=injector", "postgres", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Consulta SQL preparada
$sql = "SELECT * FROM public.vitimas WHERE id = :id";
$statement = $pdo->prepare($sql);

// Parâmetros da consulta
$id = $_POST['id']; // Suponha que este valor seja fornecido pelo usuário

// Vincula os parâmetros
$statement->bindParam(':id', $id, PDO::PARAM_INT);

// Executa a consulta preparada
$statement->execute();

// Obtém os resultados
$resultados = $statement->fetchAll(PDO::FETCH_ASSOC);

// Exibe os resultados
foreach ($resultados as $resultado) {
    echo "ID: " . $resultado['id'] . ", Nome: " . $resultado['nome'] . "<br>";
}
?>
```
- Usa consultas preparadas com parâmetros vinculados, impedindo a injeção SQL.
- Os valores fornecidos pelo usuário são tratados como dados, não como parte da consulta SQL.
- Mais seguro e recomendado em ambientes de produção.

### Exemplo sem Consultas SQL Preparadas (Vulnerável):
```php
<?php
// Conexão com o banco de dados (usando PDO)
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=injector", "postgres", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Consulta SQL não preparada (vulnerável à injeção SQL)
$id = $_POST['id']; // Suponha que este valor seja fornecido pelo usuário
$sql = "SELECT * FROM public.vitimas WHERE id = " . $id;

// Executa a consulta
$resultados = $pdo->query($sql);

// Exibe os resultados
foreach ($resultados as $resultado) {
    echo "ID: " . $resultado['id'] . ", Nome: " . $resultado['nome'] . "<br>";
}
?>
```
- Concatena diretamente os valores fornecidos pelo usuário na consulta SQL.
- Vulnerável a ataques de injeção SQL, onde um usuário mal-intencionado pode manipular os valores para executar comandos indesejados no banco de dados.
- Não recomendado e deve ser evitado sempre que possível.

## CONCLUSÃO:
É importante sempre adotar práticas seguras de codificação, como o uso de consultas preparadas, para mitigar os riscos de injeção SQL e garantir a segurança dos aplicativos da web. Tratar os dados fornecidos pelo usuário como dados ou strings, não como parte da consulta (Comandos) SQL, é a melhor prática para prevenir vulnerabilidades de injeção SQL.
