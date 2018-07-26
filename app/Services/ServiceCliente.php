<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ServiceCliente
{
    private $clienteRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
    }
}
