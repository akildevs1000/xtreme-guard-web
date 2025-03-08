<?php

namespace App\Http\Controllers\Pages\Administration;

use Exception;
use App\Models\Mail\MailLog;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Administration\MailTrackingRepo;

class MailTrackingController extends Controller
{
    protected $modelName = 'Mail Tracking';
    protected $routeName = 'permission.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(MailLog $model, MailTrackingRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
        $this->middleware('userpermission:administration-permission-view')->only('index');
    }

    public function index(Request $request)
    {
        // $mailTracking = $this->model->query();
        // return $mailTracking->get();

        if ($request->ajax()) {

            $permissions = $this->repo->getAccessPermission();

            $model = $this->model->query();
            $mailTracking = $model->filterByMailType($request);

            logActivity('Mail Tracking Master', 'Mail Tracking Master', 'View');

            return Datatables::of($mailTracking)->addIndexColumn()
                ->addColumn('action', function ($mailTracking) use ($permissions) {
                    return actionBtns(
                        $mailTracking->id,
                        'user.edit',
                        'administration/user',
                        $mailTracking->uuid,
                        $permissions
                    );
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/administration/mailtracking/index', [
            'title' => $this->modelName,
        ]);
    }

    public function sendMailToCustomerByManual($orderId, $type)
    {
        $mailActions = [
            '1' => 'sendMailToCustomer',
            '2' => 'sendInvoiceToCustomerByMail',
            '3' => 'sendOutForDeliveryNotifyToCustomerByMail',
            '4' => 'sendDeliveredNotifyToCustomerByMail',
        ];

        if (array_key_exists($type, $mailActions)) {
            $method = $mailActions[$type];
            if (method_exists($this, $method)) {
                $this->$method($orderId);
                return $method . ' done';
            } else {
                // Log an error if the method does not exist
                Log::error("Mail action method [$method] does not exist for type [$type].");
                throw new Exception("Method $method does not exist.");
            }
        } else {
            // Log an error for invalid type
            Log::warning("Invalid mail type [$type] provided for order [$orderId].");
            throw new InvalidArgumentException("Invalid mail type provided.");
        }
    }

    public function sendMailToCustomer($orderId) //confirmation mail
    {
        // $this->sendInvoiceToCustomerByMail($orderId);
        // return  $this->sendDeliveredNotifyToCustomerByMail($orderId);
        // return  $this->sendOutForDeliveryNotifyToCustomerByMail($orderId);
        // return 'done';

        $this->repo->sendConfirmedMail($orderId);
        return redirect()->back();
    }

    public function sendInvoiceToCustomerByMail($orderId) //after shipment mail
    {
        $this->repo->sendShippedMail($orderId);
    }

    public function sendOutForDeliveryNotifyToCustomerByMail($orderId)
    {
        $this->repo->sendDeliveryMail($orderId);
    }

    public function sendDeliveredNotifyToCustomerByMail($orderId)
    {
        $this->repo->sendDeliveredMail($orderId);
    }

    public function sendReturnCreatedNotifyToCustomerByMail($orderId)
    {
        $this->repo->sendReturnCreatedMail($orderId);
    }

    public function sendReturnOrderOutForDeliveryNotifyToCustomerByMail($orderId)
    {
        $this->repo->sendReturnOFDMail($orderId);
    }

    public function preview($path, $orderId)
    {
        return $this->repo->getOrderPreview($path, $orderId);
    }

    public function openFromMail($type, $orderId)
    {
        return $this->repo->openMail($type, $orderId);
    }
}
