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

class OrderReturnCreatedMail extends Mailable
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
            subject: "Return Initiated! Your Order #{$this->order['order_id']} Will Be Picked Up Soon!"
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
            view: 'mail.invoice.customer-return-created-mail',
            with: [
                ...$this->setAttrToStore()
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    private function setAttrToStore(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'mailType' => MailLog::RETURN_CREATED,
            'attachment_path' => $this->attachments() ?? null,
            'view_path' => 'mail.invoice.customer-return-created-mail',
            'description' => 'customer order return created mail',
        ];
    }
}
