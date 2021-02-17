<?php

    spl_autoload_register(fn (string $nomeClasse) => require_once "$nomeClasse.php");
    $clientes = [];
    $cliente1 = new Cliente("Filipa", "967139568");
    $cliente1->inserirNovoEnderecoCliente("Rua das Flores Nº1 3ºEsquerdo", "2310-222", "Porto");
    $cliente1->inserirNovoEnderecoCliente("Rua da Republica", "2860-922", "Lisboa");
    $cliente1->inserirNovoEnderecoCliente("Praça do José", "9111-232", "Barreiro");
    $cliente2 = new Cliente("André", "9230239");
    $cliente2->inserirNovoEnderecoCliente("Rotunda dos Bonés", "1231-123", "Porto");
    $cliente2->inserirNovoEnderecoCliente("Rua das Margaridas", "5432-111", "Quarteira");
    $cliente3 = new Cliente("Inês", "198519");
    $cliente3->inserirNovoEnderecoCliente("Avenida dos Manueis", "1233-133", "Quarteira");
    array_push($clientes, $cliente1, $cliente2, $cliente3);
    foreach ($clientes as $cliente) {
        echo "<h1>Cliente: {$cliente->getNomeCliente()}</h1>";
        foreach ($cliente->getEnderecosCliente() as $endereco) {
            echo "<p>{$endereco->getMorada()}/{$endereco->getLocalidade()} - ({$endereco->getCodigoPostal()})</p>";
        }
        echo "<hr/>";
    }
    echo "Clientes de Porto:<br/><br/>";
    foreach (Cliente::getClientesPorLocalidade($clientes, "Porto") as $clientePorLocalidade) {
        echo "{$clientePorLocalidade->getNomeCliente()}<br/>";
    }