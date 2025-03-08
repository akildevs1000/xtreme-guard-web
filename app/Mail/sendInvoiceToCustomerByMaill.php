<?php

namespace App\Mail;

use Illuminate\Support\Str;
use App\Models\Mail\MailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class sendInvoiceToCustomerByMaill extends Mailable
{
    use Queueable, SerializesModels, IsMonitored;

    public $order;

    public function __construct($order = [])
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation and Invoice Attached',
        );
    }

    public function headers(): Headers
    {
        return new Headers(
            messageId: 'custom-message-id@example.com',
            references: ['previous-message@example.com'],
            text: [
                'X-Custom-Header' => 'Custom Value',
                'X-Laravel-Mail-Class' => get_class()
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.invoice.index',
            with: [
                // 'customerName' => $this->order['customer']['first_name'] . ' ' . ($this->order['customer']['last_name'] ?? ''),
                // 'OrderDate' => date('d-m-Y', strtotime($this->order['order_date'])),
                // 'InvoiceDate' => date('d-m-Y'),
                // 'data' => $this->order,
                ...$this->setAttrToStore()
            ],
        );
    }

    public function attachments(): array
    {
        $pdfPath = $this->attachedPath();
        return [
            Attachment::fromPath($pdfPath),
        ];
    }

    private function attachedPath()
    {
        $orderId = $this->order['order_id'];
        $pdfPath = asset("storage/invoices/order-$orderId.pdf");

        return $pdfPath;
    }

    private function setAttrToStore(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'mailType' => MailLog::IVOICE_SHIPPED_MAIL,
            'attachment_path' => $this->attachedPath() ?? null,
            'view_path' => 'mail.invoice.index',
            'description' => 'customer confirmation mail',
        ];
    }
}
