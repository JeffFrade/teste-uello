<?php

namespace App\Services;

use App\Repositories\EnderecoRepository;

class ServiceEndereco
{
    public $enderecoRepository;

    public function __construct()
    {
        $this->enderecoRepository = new EnderecoRepository();
    }
}
