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

class DeliveredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order = [])
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Delivered! Your Order #{$this->order['order_id']} Has Arrived at Your Doorstep!"
        );
    }

    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-Laravel-Mail-Class' => get_class()
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.invoice.customer-delivered-mail',
            with: [
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
            'mailType' => 4, // MailLog::IVOICE_DELIVERED_MAIL,
            'attachment_path' => $this->attachments() ?? null,
            'view_path' => 'mail.invoice.customer-delivered-mail',
            'description' => 'order delivered mail',
        ];
    }
}
