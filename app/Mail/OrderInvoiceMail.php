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
use Illuminate\Contracts\Queue\ShouldQueue;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class OrderInvoiceMail extends Mailable
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
            subject: "Confirmation of Ploom order " . $this->order['order_id'],
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
            view: 'mail.invoice.customer-invoice-mail',
            with: [
                'customerName' => $this->order['customer']['first_name'] . ' ' . ($this->order['customer']['last_name'] ?? ''),
                'OrderDate' => date('d-m-Y', strtotime($this->order['order_date'])),
                'InvoiceDate' => date('d-m-Y'),
                'order' => $this->order,
                ...$this->setAttrToStore()
            ],
        );
    }

    public function attachments(): array
    {
        return [];
        $orderId = $this->order['order_id'];
        $pdfPath = asset("storage/invoices/order-$orderId.pdf");
        return [
            Attachment::fromPath($pdfPath),
        ];
    }

    private function setAttrToStore(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'mailType' => MailLog::IVOICE_CONFIRMED_MAIL,
            'attachment_path' => $this->attachments() ?? null,
            'view_path' => 'mail.invoice.customer-invoice-mail',
            'description' => 'customer confirmation mail',
        ];
    }
}
