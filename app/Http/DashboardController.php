<?php

namespace App\Http;

use App\Repositories\ClienteRepository;
use App\Services\ServiceCsv;
use App\Support\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $serviceCsv;
    private $clienteRepository;

    public function __construct(ServiceCsv $serviceCsv, ClienteRepository $clienteRepository)
    {
        $this->serviceCsv = $serviceCsv;
        $this->clienteRepository = $clienteRepository;
    }

    public function index()
    {
        $clientes = $this->clienteRepository->paginate();

        return view('dashboard', compact('clientes'));
    }

    public function import(Request $request)
    {
        $this->serviceCsv->import($request->file('csv'));

        return redirect(route('dashboard'));
    }
}
