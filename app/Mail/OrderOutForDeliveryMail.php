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

class OrderOutForDeliveryMail extends Mailable
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
            subject: "On the Way! Your Order #{$this->order['order_id']} Is Out for Delivery to Your Doorstep!",
            // subject: "Your Order #{$this->order['order_id']} Is On Its Way - Out for Delivery Now!",
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
            view: 'mail.invoice.customer-out-for-delivery-mail',
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
            'mailType' => MailLog::IVOICE_OUT_FOR_DELIVERY_MAIL,
            'attachment_path' => $this->attachments() ?? null,
            'view_path' => 'mail.invoice.customer-out-for-delivery-mail',
            'description' => 'order out for delivery mail',
        ];
    }
}
