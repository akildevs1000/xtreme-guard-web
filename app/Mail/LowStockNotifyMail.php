<?php

namespace App\Mail;

use Illuminate\Support\Str;
use App\Models\Mail\MailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class LowStockNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Low Stock Alert',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.stock.index',
            with: [
                'InvoiceDate' => date('d-m-Y'),
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
        $fileNmae = 'low-stock-' . date('Y-m-d');
        $pdfPath = asset("storage/lowstock/$fileNmae.pdf");

        return $pdfPath;
    }

    private function setAttrToStore(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'mailType' => MailLog::LOW_STOCK_STATUS,
            'attachment_path' => $this->attachedPath() ?? null,
            'view_path' => 'mail.stock.index',
            'description' => 'low stock status update',
        ];
    }
}
