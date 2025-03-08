<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\Administration\CronFailure;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class schedulerFailedNotification extends Notification
{
    use Queueable;
    public $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $created =  CronFailure::create([
            'job_name' => $this->data['job_name'] ?? 'Unknown Job',
            'recipient_email' => $notifiable->email ?? 'm.fahath@mirnah.com',
            'error_message' => $this->data['data'],
        ]);

        return (new MailMessage)
            ->line('Scheduler Failed importStockFromRoutePro/UploadWarehouse: Error Details.')
            ->action('Click to view issue', url('development/cron-failed/' . $created->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    private function setAttrToStore(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'mailType' => 20,
            'attachment_path' =>  null,
            'view_path' => 'mail.invoice.customer-return-created-mail',
            'description' => 'customer order return created mail',
        ];
    }
}
