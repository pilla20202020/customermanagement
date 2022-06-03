<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Modules\Service\Customer\CustomerService;
use App\Modules\Service\Report\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $customer,$reportservice;

    function __construct(CustomerService $customer, ReportService $reportservice)
    {
        $this->customer = $customer;
        $this->reportservice = $reportservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reportservice = $this->reportservice->paginate();
        return view('report.index', compact('reportservice'));
    }

    public function getAllData()
    {
        return $this->reportservice->getAllData();
    }

    public function getReportsByParameter(Request $request) {
        $validatedata = $request->validate([
            'from_date'=> 'required|date',
            'to_date'=> 'required|date|after_or_equal:from_date',
        ]);
        $filters = [
            'from_date'    => $request->from_date,
            'to_date'    => $request->to_date,
        ];

        $reportservice = $this->reportservice->getReportsByParameter($request);

        $totalprice = [];
        $price = null;
        if(isset($reportservice)) {
            foreach($reportservice as $report) {
                $price = $price + $report->bills->sum('total') - $report->initial_payment;
                $totalprice = $price;
            }
        }
        return view('report.getReportByParameter', compact('reportservice','filters','totalprice'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
