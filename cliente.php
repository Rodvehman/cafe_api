<?php
    // Capturando o endereço URL
    $url = "http://localhost/cafe_api/api.php";

    // Armazenando o conteúdo da URL
    $resultado = file_get_contents($url);

    // Decodificando e convertendo o conteúdo em Array Associativo
    $dados = json_decode($resultado, true);

    // Construíndo a estrutura do método REST
    $estrutura = [
        'http' => [
            'method' => 'GET',
            'header' => 'Content-Type: application/json\r\n',
            'content' => json_encode($dados)
        ]
    ];

    // Armazenando os dados
    $resposta = $dados['clientes'];
?>