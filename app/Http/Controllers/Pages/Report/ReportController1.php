<?php

namespace App\Http\Controllers\Pages\Report;

use App\Gridphp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImportOrder\ImportOrder;
use App\Repositories\Report\ReportRepo;

class ReportController1 extends Controller
{
    protected $modelName = 'Report';
    protected $routeName = 'report.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(ReportRepo $repo)
    {
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function viewReportIntial(Request $request, $reportType = "")
    {
        return view('pages.report.report.report-index', [
            'title' =>   $this->repo->getReportTitle($reportType),
            'reportType' =>   $reportType,
        ]);
    }

    public function getReport(Request $request, $reportType = "")
    {
        $items = [];

        switch ($reportType) {
            case 'warehouse-stock':
                $items = $this->repo->getAllWarehouseStocks($request);
                break;

            case 'received-order':
                $items = $this->repo->getAllOrdes($request);
                break;

            default:
                # code...
                break;
        }

        $reportTypeName = $this->repo->getReportTitle($reportType);

        logActivity($reportTypeName, $reportTypeName, 'View');

        return view('pages.report.report.main-report', [
            'title' =>   $reportTypeName,
            'cols' =>   $items['selectedCols'],
            'items' =>   $items['model']->get(),
        ]);
    }

    // public function warehouseStock(Request $request)
    // {
    //     $stocks = $this->repo->getAllWarehouseStocks($request);
    //     // return  $stocks->get();
    //     $permissions = $this->repo->getAccessPermission();

    //     if ($request->ajax()) {
    //         return datatables()->of($stocks)->addIndexColumn()
    //             ->addColumn('action', function ($stocks) use ($permissions) {
    //                 return actionBtns(
    //                     $stocks->id,
    //                     'report.edit',
    //                     'order/report',
    //                     '',
    //                     $permissions
    //                 );
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('pages.report.report.warehouse-stock', [
    //         'title' =>   $this->modelName,
    //         'stocks' =>   $stocks->get(),
    //     ]);
    // }

    public function phpGrid()
    {
        $g = Gridphp::get();

        $opt = array();
        $opt["caption"] = "Customers";
        $opt["height"] = "400";
        $opt["hidefirst"] = true;
        $opt["hidesecond"] = true;
        $g->set_options($opt);

        $g->table = "users";

        $out = $g->render("list");

        return view('php-grid', [
            'grid' => $out
        ]);
    }

    // public function ReceivedOrder(Request $request)
    // {
    //     $orders = $this->repo->getAllOrdes($request);
    //     // $orders->get();
    //     $permissions = $this->repo->getAccessPermission();

    //     if ($request->ajax()) {
    //         return datatables()->of($orders)->addIndexColumn()
    //             ->addColumn('action', function ($orders) use ($permissions) {
    //                 return actionBtns(
    //                     $orders->id,
    //                     'report.edit',
    //                     'order/report',
    //                     '',
    //                     $permissions
    //                 );
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('pages.report.report.received-order', [
    //         'title' =>   'Received Order',
    //         'orders' =>   $orders->get(),
    //     ]);
    // }

}
