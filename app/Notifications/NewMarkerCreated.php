<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
class NewMarkerCreated extends Notification
{
    use Queueable;

    protected $marker;

    public function __construct($marker)
    {
        $this->marker = $marker;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; 
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'มีโครงการใหม่',
            'message' => 'ชื่อโครงการ: ' . $this->marker->Nactivity,
            'id' => $this->marker->id,
        ];
    }
        public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('แจ้งเตือน: มีโครงการใหม่')
            ->greeting('สวัสดีครับ ' . $notifiable->name)
            ->line('มีโครงการใหม่ชื่อ: ' . $this->marker->Nactivity)
            ->line('ผู้เพิ่มโครงการ: ' . auth()->user()->name)
            ->action('ดูโครงการ', url('/dashboard')) // หรือ route()
            ->line('ขอบคุณที่ใช้ระบบของเรา');
    }
}
