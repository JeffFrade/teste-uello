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

            $cpf = \StringHelper::removeSpecialChars($row['cpf']);
            $this->storeEndereco($data, $cpf);
        }
    }

    public function export()
    {
        $clientes = $this->clienteRepository->all();

        \Excel::create('export', function($excel) use ($clientes) {
            $excel->sheet('Clientes', function($sheet) use ($clientes) {
                $sheet->appendRow(array(
                    'nome',
                    'email',
                    'datanasc',
                    'cpf',
                    'endereco',
                    'cep'
                ));

                foreach ($clientes as $cliente) {
                    $sheet->appendRow(array(
                        'nome' => $cliente->nome,
                        'email' => $cliente->email,
                        'datanasc' => \DateHelper::formatDate($cliente->data_nascimento),
                        'cpf' => \StringHelper::mask($cliente->cpf, '###.###.###-##'),
                        'endereco' => $cliente->endereco->logradouro . ", " . $cliente->endereco->numero . " " . $cliente->endereco->complemento . " - " . $cliente->endereco->bairro . " - " . $cliente->endereco->cidade,
                        'cep' => \StringHelper::mask($cliente->endereco->cep, '#####-###')
                    ));
                }
            });
        })->download('csv');
    }

    private function storeCliente(array $row)
    {
        $clienteData = [
            'nome' => $row['nome'],
            'email' => $row['email'],
            'data_nascimento' => \DateHelper::parseDateTime($row['datanasc']),
            'cpf' => \StringHelper::removeSpecialChars($row['cpf']),
        ];

        $this->clienteRepository->create($clienteData);
    }

    private function storeEndereco($data, $cpf)
    {
        $enderecoTypes = [
            'subpremise' => 'complemento',
            'street_number' => 'numero',
            'route' => 'logradouro',
            'political' => 'bairro',
            'administrative_area_level_2' => 'cidade',
            'postal_code' => 'cep',
        ];

        $row = json_decode($data, true);
        $row = $row['results'][0];

        $enderecoData = [
            'latitude' => $row['geometry']['location']['lat'],
            'longitude' => $row['geometry']['location']['lng'],
            'cpf' => $cpf,
        ];

        $endereco = $row['address_components'];

        foreach ($endereco as $item => $value) {
            if (in_array($value['types'][0], array_flip($enderecoTypes))) {
                $enderecoData[$enderecoTypes[$value['types'][0]]] = \StringHelper::removeCep($value['long_name']);
            }
        }

        $this->enderecoRepository->create($enderecoData);
    }
}
