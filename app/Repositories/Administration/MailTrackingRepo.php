<?php

namespace App\Repositories\Administration;

use App\Mail\DeliveredMail;
use App\Models\Mail\MailLog;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderReturnCreatedMail;
use App\Repositories\BaseRepository;
use App\Mail\OrderOutForDeliveryMail;
use App\Repositories\Orders\ShipmentRepo;
use App\Mail\sendInvoiceToCustomerByMaill;
use App\Http\Controllers\Pages\Application\MailController;

class MailTrackingRepo extends BaseRepository
{
    protected $model;

    public function __construct(MailLog $model)
    {
        $this->model = $model;
    }

    public function __call($method, $parameters)
    {
        // Forward calls to the model instance
        $isExisit = $this->model->$method(...$parameters);

        if ($isExisit) {
            return $isExisit;
        }

        throw new \BadMethodCallException("Method {$method} does not exist on the model.");
    }

    public function sendConfirmedMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            $receiverEmail = $order->billingAddress->email;

            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '1 - Confirmed Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if ($this->isAlreadySent($orderId, 1)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '1 - Confirmed Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '1 - Confirmed Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if ($order) {

                if ($receiverEmail) {
                    if (env('APP_ENV') == 'production') {
                        MailController::toSendMail($receiverEmail, new OrderInvoiceMail(), $order, true);
                    }

                    MailController::toSendMail('m.fahath@mirnah.com', new OrderInvoiceMail(), $order, true);
                }

                $out = [
                    'mail_type' => '1 - Confirmed Mail',
                    'customer' => $order->customer->first_name,
                    'order_id' => $order->order_id,
                    'customer_mail' => $receiverEmail,
                ];
                Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
                return redirect()->back()->with('success',  'Invoice successfully sent to the customer email');
            }
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function sendShippedMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '2 - Shipment Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if ($this->isAlreadySent($orderId, 2)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '2 - Shipment Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '2 - Shipment Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if (env('APP_ENV') == 'production') {
                MailController::toSendMail($receiverEmail, new sendInvoiceToCustomerByMaill(), $order, true);
            }

            MailController::toSendMail('m.fahath@mirnah.com', new sendInvoiceToCustomerByMaill(), $order, true);

            $out = [
                'mail_type' => '2 - Shipment Mail',
                'customer' => $order->customer->first_name,
                'order_id' => $order->order_id,
                'customer_mail' => $receiverEmail,
            ];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return true;
        } catch (\Throwable $th) {
            Log::channel('invoiceMail')->error(json_encode([
                'mail_type' => '2 - Shipment Mail',
                'status' => 'error',
                'message' => $th,
            ], JSON_PRETTY_PRINT));
            return $th;
        }
    }

    public function sendDeliveryMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '3 - Out For Delivery Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '3 - Out For Delivery Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }


            if ($this->isAlreadySent($orderId, 3)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '3 - Out For Delivery Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if (env('APP_ENV') == 'production') {
                MailController::toSendMail($receiverEmail, new OrderOutForDeliveryMail(), $order, true);
            }

            MailController::toSendMail('m.fahath@mirnah.com', new OrderOutForDeliveryMail(), $order, true);

            $out = [
                'mail_type' => '3 - Out For Delivery Mail',
                'customer' => $order->customer->first_name,
                'order_id' => $order->order_id,
                'customer_mail' => $receiverEmail,
            ];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function sendReturnCreatedMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '5 - Return Created Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '5 - Return Created Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if ($this->isAlreadySent($orderId, 5)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '5 - Return Created Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if (env('APP_ENV') == 'production') {
                MailController::toSendMail($receiverEmail, new OrderReturnCreatedMail(), $order, true);
            }

            MailController::toSendMail('m.fahath@mirnah.com', new OrderReturnCreatedMail(), $order, true);
            // MailController::toSendMail('mikhail.buzumurga@jti.com', new OrderReturnCreatedMail(), $order, true);

            $out = [
                'mail_type' => '5 - Return Created Mail',
                'customer' => $order->customer->first_name,
                'order_id' => $order->order_id,
                'customer_mail' => $receiverEmail,
            ];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function sendReturnOFDMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '4 - Return Out For Delivery Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '4 - Return Out For Delivery Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }


            if ($this->isAlreadySent($orderId, 3)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '4 - Return Out For Delivery Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if (env('APP_ENV') == 'production') {
                MailController::toSendMail($receiverEmail, new OrderOutForDeliveryMail(), $order, true);
            }

            MailController::toSendMail('m.fahath@mirnah.com', new OrderOutForDeliveryMail(), $order, true);

            $out = [
                'mail_type' => '4 - Return Out For Delivery Mail',
                'customer' => $order->customer->first_name,
                'order_id' => $order->order_id,
                'customer_mail' => $receiverEmail,
            ];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function sendDeliveredMail($orderId)
    {
        try {
            $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
            if (!$order) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '4 - Delivered Mail',
                    'message' => 'Order not found for sending mail',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            $receiverEmail = $order->billingAddress->email;
            if (!$receiverEmail) {
                Log::channel('invoiceMail')->error(json_encode([
                    'mail_type' => '4 - Delivered Mail',
                    'message' => 'Customer email not found',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if ($this->isAlreadySent($orderId, 4)) {
                Log::channel('invoiceMail')->warning(json_encode([
                    'mail_type' => '4 - Delivered Mail',
                    'order_id' => $order->order_id,
                    'message' => 'Mail already sent to the customer',
                ], JSON_PRETTY_PRINT));
                return false;
            }

            if (env('APP_ENV') == 'production') {
                MailController::toSendMail($receiverEmail, new DeliveredMail(), $order, true);
            }

            MailController::toSendMail('m.fahath@mirnah.com', new DeliveredMail(), $order, true);

            $out = [
                'mail_type' => '4 - Delivered Mail',
                'customer' => $order->customer->first_name,
                'order_id' => $order->order_id,
                'customer_mail' => $receiverEmail,
            ];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function openMail($type, $orderId)
    {
        MailLog::where('mail_type', $type)->whereOrderId($orderId)
            ->update(['opens' => 1, 'last_opened_at' => now()]);

        return redirect('https://www.ploom.ph/en/profile#/orders/');
    }

    public function getOrderPreview($path, $orderId)
    {
        // If no orderId is provided, return the view directly
        if (!$orderId) {
            return view($path);
        }

        // Fetch the order using the provided orderId
        $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);

        // If the order is not found, abort with a 404
        if (!$order) {
            abort(404, 'Order not found.');
        }

        // Return the view with the order data
        return view($path, [
            'order' => $order,
        ]);
    }

    public function isAlreadySent($orderId, $mailType)
    {
        if (empty($orderId) || empty($mailType)) {
            throw new \InvalidArgumentException("Order ID and Mail Type are required.");
        }

        if (env('APP_ENV') == 'production') {
            return MailLog::where('mail_type', $mailType)->whereOrderId($orderId)->exists();
        }
        return false;
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => false,
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false,
            'isTracking' => false
        ];
    }
}
