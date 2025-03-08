<?php

namespace App\Http\Controllers\Pages\Report;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Report\ReportRepo;

class ReportController extends Controller
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
        $this->repo->checkUserPermissionByReport($reportType);
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

            case 'product-by-order':
                $items = $this->repo->getProductByOrder($request);
                break;

            default:
                break;
        }

        $reportTypeName = $this->repo->getReportTitle($reportType);

        logActivity($reportTypeName . ' Report', "Generate " . $reportTypeName . ' Report', 'Create');

        $finalItems = $this->repo->getItems($items);
        $isLarageData = count($finalItems) > 20000;

        if ($isLarageData) {
            abort(430, 'Report type not supported.');
        }

        // return $this->generateReportDateRange($request);

        return view('pages.report.report.main-report', [
            'title' =>   $reportTypeName,
            'cols' =>   $items['selectedCols'],
            'orderBy' =>   $items['orderBy'] ?? [],
            'items' => $finalItems,
            'dateRange' => $this->generateReportDateRange($request),
        ]);
    }

    public function generateReportDateRange($request)
    {
        $from = new DateTime($request->start_date);
        $to = new DateTime($request->end_date);

        $days = $from->diff($to)->days + 1; // Calculate the difference in days

        return $from->format('d M Y') . ' - ' . $to->format('d M Y') . ' ( ' . $days . ' days )';
    }
}
