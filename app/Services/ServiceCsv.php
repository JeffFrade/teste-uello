<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Repositories\EnderecoRepository;
use Illuminate\Http\UploadedFile;

class ServiceCsv
{
    private $clienteRepository;
    private $enderecoRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
        $this->enderecoRepository = new EnderecoRepository();
    }

    public function import(UploadedFile $file)
    {
        $csv = \Excel::load($file->getRealPath())->toArray();

        dd($csv);
    }
}
