<?php 
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "db_datatable";

$conn = mysqli_connect($servername, $username, $pass, $dbname);

//Recebe a requisião da pesquisa
$requestData = $_REQUEST;

// Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
    array('0' => 'nome'),
    array('1' => 'salario'),
    array('2' => 'idade')       
);

//Obtendo quantidade de registro para fazer a paginação
$result_user = "SELECT nome, salario, idade FROM usuarios";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

// Obter os dados a serem apresentados
$result_usuarios = "SELECT nome, salario, idade FROM usuarios WHERE 1=1";
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//Ordenando resultado

$nameOrder = implode("", $columns[$requestData['order'][0]['column']]);
$result_usuarios.=" ORDER BY ". $nameOrder . " ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']."  ,".$requestData['length']."  ";
$resultado_usuarios = mysqli_query($conn, $result_usuarios);

// Ler e criar array de dados
$dados = array();
while($row_usuarios = mysqli_fetch_array($resultado_usuarios)){
    $dado = array();
    $dado[] = $row_usuarios["nome"];
    $dado[] = $row_usuarios["salario"];
    $dado[] = $row_usuarios["idade"];

    $dados[] = $dado;
}

// Cria o array de informações a serem retornadas para o Javascript

$json_data = array(
    "draw" => intval($requestData['draw']), //para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($qnt_linhas), //Quantidade de registro que há no banco de dados
    "recordsFiltered" => intval($totalFiltered), //Total de registro quando houver pesquisa
    "data" => $dados //Array de dados completo dos dados retornados da tabela
);


echo json_encode($json_data); //envia dados como formato json