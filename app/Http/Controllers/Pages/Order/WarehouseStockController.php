<?php

namespace App\Http\Controllers\Pages\Order;

use Illuminate\Http\Request;
use App\Providers\JTIService;
use App\Mail\LowStockNotifyMail;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Warehouse\StockSyncHistory;
use App\Repositories\Orders\WarehouseStockRepo;
use App\Http\Controllers\Pages\Application\MailController;
use App\Http\Controllers\Pages\Administration\SettingController;

class WarehouseStockController extends Controller
{
    protected $modelName = 'Warehouse Stock';
    protected $routeName = 'order.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(WarehouseStock $model, WarehouseStockRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
        $this->middleware('userpermission:orders-stock-status-view')->only('index');
    }

    public function index(Request $request)
    {
        $stocks = $this->repo->getAllStocks($request);
        $permissions = $this->repo->getAccessPermission();


        if ($request->ajax()) {

            logActivity('Warehouse Master', 'Warehouse Master', 'View');

            // $this->uploadWarehouseStockData();
            return Datatables::of($stocks)->addIndexColumn()
                ->addColumn('action', function ($stocks) use ($permissions) {
                    return actionBtns(
                        $stocks->id,
                        'warehouse.edit',
                        'order/warehouse',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.orders.warehouse.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function history(Request $request)
    {
        $records = StockSyncHistory::filter($request)->orderBy('sync_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        logActivity('Warehouse Sync History', 'Warehouse Sync History', 'View');

        return view('pages.orders.warehouse.history', [
            'title' =>   'Warehouse Stock Sync History',
            'records' =>   $records ?? [],
        ]);
    }

    public function uploadWarehouseStockData()
    {
        $stkArr = [];

        $stocks = $this->repo->getAllStocksForUploadToJTI()->get();

        foreach ($stocks as $key => $item) {
            $stkArr[] = [
                'item_name' => $item->item,
                'sku' => $item->item_code,
                'qty' => $item->qty,
                'unit' => $item->unit,
                'product_type' => 'regular',
            ];
        }

        return (new JTIService)->uploadWarehouseStock($stkArr);
    }

    public function show($id)
    {
        return 'show';
    }

    public function sendLowStockMail()
    {
        $lowStockData = (new SettingController)->LowQtyNotify() ?? [];

        $this->generateLowStockNotifyPDF($lowStockData);

        MailController::toSendMail('m.fahath@mirnah.com', new LowStockNotifyMail(), $lowStockData);
    }
}
