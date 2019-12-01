<?php 
require 'appConfig.php';

$dbTable = 'usuarios';
$Read = new Read;

/** Recebe a requisição da pesquisa */
$requestData = $_REQUEST;

/** Indices da coluna */
$columns = array(
    array('0' => 'nome'),
    array('1' => 'salario'),
    array('2' => 'idade')
);

/** Obtendo a quantidade de registro para fazer a paginação */
$Read->FullRead("SELECT nome, salario, idade FROM {$dbTable}");
$count = $Read->getRowCount();
$totalFiltered = $Read->getRowCount();

$nameOrder = implode("", $columns[$requestData['order'][0]['column']]);
$dir = $requestData['order'][0]['dir'];
$start = $requestData['start'];
$length = $requestData['length'];
$selecao = $Read->FullRead("SELECT nome, salario, idade FROM {$dbTable} ORDER BY {$nameOrder} {$dir} LIMIT $start , $length");

// var_dump($Read->getResult());
// die;

/** Ler e criar Array de dados */
$dados = array();
foreach ($Read->getResult() as $rowData) {
    $dado = array();
    $dado[] = $rowData["nome"];
    $dado[] = $rowData["salario"];
    $dado[] = $rowData["idade"];
    $dados[] = $dado;
    
}
/** Cria o array de informações a serem retornados para o Javascript */
$json_data = array(
    "draw" => intval($requestData['draw']), //para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($count), //Quantidade de registro que há no banco de dados
    "recordsFiltered" => intval($totalFiltered), //Total de registro quando houver pesquisa
    "data" => $dados //Array de dados completo dos dados retornados da tabela
);
echo json_encode($json_data); //envia dados como formato json
