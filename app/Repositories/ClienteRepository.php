<?php

namespace App\Repositories;

use App\Repositories\Models\Cliente;

class ClienteRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Cliente();
    }
}
