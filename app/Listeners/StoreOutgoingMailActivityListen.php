<?php

namespace App\Listeners;

use App\Models\Mail\MailLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Events\MessageSending;

class StoreOutgoingMailActivityListen
{
    public function __construct()
    {
        //
    }

    public function handle($event): void
    {
        if ($event instanceof MessageSending) {
            $this->handleMessageSending($event);
        } elseif ($event instanceof MessageSent) {
            $this->handleMessageSent($event);
        }
    }

    protected function handleMessageSending(MessageSending $event)
    {
        if (empty($event->data['uuid'])) {
            return null;
        }
        $send = MailLog::create($this->getDefaultSendAttributes($event));
    }

    protected function handleMessageSent(MessageSent $event)
    {
        if (empty($event->data['uuid'])) {
            return null;
        }
        $mailLog = MailLog::where('uuid', $event->data['uuid'])->first();

        if ($mailLog) {
            $mailLog->update(['sent_at' => now(), 'is_sent' => 1]);
        }
    }

    protected function getDefaultSendAttributes(MessageSending $event): array
    {
        return [
            'uuid'            => $this->getAttr($event, 'uuid'),
            'view_path'       => $this->getAttr($event, 'view_path'),
            'mail_type'       => $this->getAttr($event, 'mailType'),
            'mail_class'      => $this->getMailClassHeaderValue($event),
            'description'     => $this->getAttr($event, 'description'),
            'attachment_path' => $this->getAttr($event, 'attachment_path'),
            'order_id'        => $event->data['order']['order_id'] ?? '',
            'subject'         => $event->message->getSubject(),
            'content'         => $this->getContent($event),
            'from'            => $this->getAddressesValue($event->message->getFrom()),
            'to'              => $this->getAddressesValue($event->message->getTo()),
            'cc'              => $this->getAddressesValue($event->message->getCc()),
            'bcc'             => $this->getAddressesValue($event->message->getBcc()),
            'sent_at'         => null, // Not sent yet
            'is_sent'         => 0,
        ];
    }

    protected function getContent(MessageSending $event): ?string
    {
        // if (config('sends.store_content', false) === false) {
        //     return null;
        // }
        return $event->message->getHtmlBody();
    }

    protected function getAttr(MessageSending $event, $key): ?string
    {
        // Log::info(json_encode($event->data[$key], JSON_PRETTY_PRINT));
        // dd($event->data['uuid']);

        if ($event->data[$key]) {
            return $event->data[$key];
        }

        return null;
    }

    protected function getMailClassHeaderValue(MessageSending $event): ?string
    {
        $mailClassHeader = 'X-Laravel-Mail-Class';

        if (! $event->message->getHeaders()->has($mailClassHeader)) {
            return null;
        }

        $headerValue = $event->message->getHeaders()->get($mailClassHeader);

        if (is_null($headerValue)) {
            return null;
        }

        return $headerValue->getBodyAsString();
    }

    protected function getAddressesValue(array $address)
    {
        foreach ($address as $addr) {
            return $addr->getAddress() ?? null;
        }

        return null;
    }

    private function getAllMethods(MessageSending $event)
    {
        // -----------------
        // Get all methods of the message object
        $methods = get_class_methods($event->message);

        foreach ($methods as $key => $method) {
            try {
                // Check if the method is callable
                if (is_callable([$event->message, $method])) {
                    // Call the method and store its result
                    $result = $event->message->$method();
                } else {
                    $result = 'Not callable';
                }

                // Log the key, method name, and result
                $jj = json_encode([
                    'key' => $key,
                    'method' => $method,
                    'result' => $result
                ], JSON_PRETTY_PRINT);

                Log::info($jj);
            } catch (\Throwable $e) {
                // Log any exception that occurs during method execution
                Log::error("Error calling method {$method}: " . $e->getMessage());
            }
        }
        // -----------------
    }

    private function getAllMethodsByParam($event)
    {
        // -----------------
        // Get all methods of the message object
        $methods = get_class_methods($event);
        Log::info(json_encode($methods, JSON_PRETTY_PRINT));


        foreach ($methods as $key => $method) {
            try {
                // Check if the method is callable
                if (is_callable([$event->message, $method])) {
                    // Call the method and store its result
                    $result = $event->message->$method();
                } else {
                    $result = 'Not callable';
                }

                // Log the key, method name, and result
                $jj = json_encode([
                    'key' => $key,
                    'method' => $method,
                    'result' => $result
                ], JSON_PRETTY_PRINT);

                Log::info($jj);
            } catch (\Throwable $e) {
                // Log any exception that occurs during method execution
                Log::error("Error calling method {$method}: " . $e->getMessage());
            }
        }
        // -----------------
    }
}
