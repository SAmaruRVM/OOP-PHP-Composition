<?php

    final class Cliente
    {
        private string $_nomeCliente;
        private string $_contactoTelefonicoCliente;
        private array $_enderecosCliente;
        public function __construct(string $nomeCliente, string $contactoTelefonicoCliente)
        {
            $this->_nomeCliente = $nomeCliente;
            $this->_contactoTelefonicoCliente = $contactoTelefonicoCliente;
        }
        private function _novoEnderecoCliente(string $moradaCliente, string $codigoPostalCliente, string $localidadeCliente) : object
        {
            return new class($moradaCliente, $codigoPostalCliente, $localidadeCliente) {
                private string $_morada;
                private string $_codigoPostal;
                private string $_localidade;
                public function __construct(string $morada, string $codigoPostal, string $localidade)
                {
                    $this->_morada = $morada;
                    $this->_codigoPostal = $codigoPostal;
                    $this->_localidade = $localidade;
                }
                public function getMorada() : string
                {
                    return $this->_morada;
                }
                public function getCodigoPostal() : string
                {
                    return $this->_codigoPostal;
                }
                public function getLocalidade() : string
                {
                    return $this->_localidade;
                }
            };
        }
        public function getNomeCliente() : string
        {
            return $this->_nomeCliente;
        }
        public function getContactoTelefonicoCliente() : string
        {
            return $this->_contactoTelefonicoCliente;
        }
        public function getEnderecosCliente() : array
        {
            return $this->_enderecosCliente;
        }
        public function inserirNovoEnderecoCliente(string $moradaCliente, string $codigoPostalCliente, string $localidadeCliente) : object
        {
            $enderecoAInserir = $this->_novoEnderecoCliente($moradaCliente, $codigoPostalCliente, $localidadeCliente);
            $this->_enderecosCliente[] = $enderecoAInserir;
            return $enderecoAInserir;
        }
        public function eliminarEnderecoCliente(string $moradaCliente, string $codigoPostalCliente) : bool
        {
            foreach ($this->_enderecosCliente as $index => $endereco) {
                if (strcasecmp(trim($moradaCliente), $endereco->getMorada()) === 0 && $codigoPostalCliente === $endereco->getCodigoPostal()) {
                    unset($this->_enderecosCliente[$index]);
                    return true;
                }
            }
            return false;
        }
        public function setNomeCliente(string $nomeCliente)
        {
            $this->_nomeCliente = (ctype_alpha($nomeCliente)) ? $nomeCliente : $this->_nomeCliente;
        }
        public function setContactoTelefonicoCliente(string $contactoTelefonicoCliente)
        {
            $this->_contactoTelefonicoCliente = (is_numeric($contactoTelefonicoCliente)) ? $contactoTelefonicoCliente : $this->_contactoTelefonicoCliente;
        }
        public static function getClientesPorLocalidade(array $clientes, string $localidade) : array
        {
            $clientesPorLocalidade = [];
            foreach ($clientes as $cliente) {
                if ($cliente instanceof Cliente) {
                    foreach ($cliente->getEnderecosCliente() as $endereco) {
                        if (strcasecmp($endereco->getLocalidade(), $localidade) === 0) {
                            $clientesPorLocalidade[] = $cliente;
                        }
                    }
                }
            }
            return $clientesPorLocalidade;
        }
    }