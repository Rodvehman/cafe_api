<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    $arquivo = 'dados_cliente.json';
    $conteudo = file_get_contents($arquivo);

    if ($conteudo === false){
        http_response_code(500);
        echo json_encode(["erro => Arquivo 'dados_cliente.json' não localizado."]);
        exit;
    }

    $dados = json_decode($conteudo, true);

    if (json_last_error() !== JSON_ERROR_NONE){
        http_response_code(500);
        echo json_encode(['Erro => formato JSON inválido']);
        exit;
    }

    $clientes = $dados['clientes'] ?? [];

    $nome = $_GET['nome'] ?? null;
    $idade = $_GET['idade'] ?? null;
    $profissao = $_GET['profissao'] ?? null;
    $cidade = $_GET['cidade'] ?? null;

    $resultado = [];

    if ($nome !== null){
        $nome = trim($nome);
        foreach ($clientes as $cliente){
            if (strcasecmp($cliente['nome'], $nome) === 0){
                $resultado[] = $cliente;
            }
        }
    } else if ($idade !== null){
        $idade = (int)$idade;
        foreach ($clientes as $cliente){
            if ($cliente['idade'] == $idade){
                $resultado[] = $cliente;
            }
        }
    } else if ($profissao !== null){
        $profissao = trim($profissao);
        foreach ($clientes as $cliente){
            if (strcasecmp($cliente['profissao'], $profissao) !== false){
                $resultado[] = $cliente;
            }
        }
    } else if ($cidade !== null){
        $cidade = trim($cidade);
        foreach ($clientes as $cliente){
            if (strcasecmp($cliente['cidade'], $cidade) !== false){
                $resultado[] = $cliente;
            }
        }
    } else {
        echo "Parâmetro de Informação não localizada. Segue a lista completa...\n\n";
        foreach ($clientes as $cliente){
            echo "Nome:".$cliente['nome']."\n";
            echo "Idade: ".$cliente['idade']."\n";
            echo "Profissão:".$cliente['profissao']."\n";
            echo "Cidade: ".$cliente['cidade']."\n";
            echo "\n";
        }
    }
    echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>