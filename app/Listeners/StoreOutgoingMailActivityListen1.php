<?php

namespace App\Listeners;

use App\Models\Mail\MailLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Mime\Address;
use Illuminate\Support\Collection;

class StoreOutgoingMailActivityListen1
{
    public function __construct()
    {
        //
    }

    public function handle(MessageSent $event): void
    {
        $send = $this->createSendModel($event);
        Log::info('Message sent event handled by StoreOutgoingMailActivityListen listener.');
        Log::info(json_encode($event));

        // $methods = get_class_methods($event->message);
        // Log::info(json_encode($methods));
        // Log::info(json_encode($event->message->getTo()));

        // $this->attachModelsToSendModel($event, $send);
    }

    protected function createSendModel(MessageSent $event)
    {
        return MailLog::create($this->getDefaultSendAttributes($event));
    }

    protected function getDefaultSendAttributes(MessageSent $event): array
    {
        return [
            'uuid' => $this->getSendUuid($event),
            'mail_class' => $this->getMailClassHeaderValue($event),
            'subject' => $event->message->getSubject(),
            'content' => $this->getContent($event),
            'from' => $this->getAddressesValue($event->message->getFrom()),
            // 'reply_to' => $this->getAddressesValue($event->message->getReplyTo()),
            'to' => $this->getAddressesValue($event->message->getTo()),
            'cc' => $this->getAddressesValue($event->message->getCc()),
            'bcc' => $this->getAddressesValue($event->message->getBcc()),
            'sent_at' => now(),
        ];
    }

    protected function getContent(MessageSent $event): ?string
    {
        // if (config('sends.store_content', false) === false) {
        //     return null;
        // }
        return $event->message->getHtmlBody();
    }

    protected function getSendUuid(MessageSent $event): ?string
    {
        // $sendUuidHeader = config('sends.headers.send_uuid');
        // $sendUuidHeader = 'X-Laravel-Send-UUID';
        $sendUuidHeader = 'Message-ID';

        if ($sendUuidHeader === 'Message-ID') {
            return $event->sent->getMessageId();
        }

        if (! $event->message->getHeaders()->has($sendUuidHeader)) {
            return null;
        }

        $headerValue = $event->message->getHeaders()->get($sendUuidHeader);

        if (is_null($headerValue)) {
            return null;
        }

        return $headerValue->getBodyAsString();
    }

    protected function getMailClassHeaderValue(MessageSent $event): ?string
    {
        // $mailClassHeader = config('sends.headers.mail_class');
        $mailClassHeader = 'X-Laravel-Mail-Class';

        if (! $event->message->getHeaders()->has($mailClassHeader)) {
            return null;
        }

        $headerValue = $event->message->getHeaders()->get($mailClassHeader);

        if (is_null($headerValue)) {
            return null;
        }

        return decrypt($headerValue->getBodyAsString());
    }

    protected function getAddressesValue(array $address): ?Collection
    {
        $addresses = collect($address)
            ->flatMap(fn(Address $address) => [$address->getAddress() => $address->getName() === '' ? null : $address->getName()]);

        return $addresses->count() > 0 ? $addresses : null;
    }
}
