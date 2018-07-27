<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Repositories\EnderecoRepository;
use Illuminate\Http\UploadedFile;

class ServiceCsv
{
    private $clienteRepository;
    private $enderecoRepository;
    private $serviceGeolocation;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
        $this->enderecoRepository = new EnderecoRepository();
        $this->serviceGeolocation = new ServiceGeolocation();
    }

    public function import(UploadedFile $file)
    {
        $csv = \Excel::load($file->getRealPath())->toArray();

        foreach ($csv as $row) {
            $data = $this->serviceGeolocation->getCoordinates($row['endereco']);

            $this->storeCliente($row);
        }
    }

    public function storeCliente(array $row)
    {
        $clienteData = [
            'nome' => $row['nome'],
            'email' => $row['email'],
            'data_nascimento' => \DateHelper::parseDateTime($row['datanasc']),
            'cpf' => \StringHelper::removeSpecialChars($row['cpf']),
        ];

        $this->clienteRepository->create($clienteData);
    }
}
