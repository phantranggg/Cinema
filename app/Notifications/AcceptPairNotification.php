<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShoudQueue;
use Illuminate\Notifications\Notification;

class AcceptPairNotification extends Notification {
    use Queueable;

    protected $invitationId;

    public function __construct($invitationId) {
        $this->invitationId = $invitationId;
    }
    
    public function via($notifiable) {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'noti' => auth()->user()->name . ' đã đồng ý mời bạn',
            'invitationId' => $this->invitationId,
            'hasButton' => false
        ];
    }

}