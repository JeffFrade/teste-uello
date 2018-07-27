<?php

namespace App\Http;

use App\Services\ServiceCsv;
use App\Support\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $serviceCsv;

    /**
     * Create a new controller instance.
     *
     * @param ServiceCsv $serviceCsv
     *
     * @return void
     */
    public function __construct(ServiceCsv $serviceCsv)
    {
        $this->serviceCsv = $serviceCsv;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function import(Request $request)
    {
        $this->serviceCsv->import($request->file('csv'));
    }
}
