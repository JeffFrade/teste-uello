<?php

namespace App\Repositories;

use App\Repositories\Models\Endereco;

class EnderecoRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Endereco();
    }
}
