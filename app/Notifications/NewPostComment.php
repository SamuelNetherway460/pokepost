<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostComment extends Notification
{
    use Queueable;

    public $comment;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $user)
    {
        $this->comment = $comment;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param   mixed $notifiable
     * @return  array
     */
    public function toDatabase($notifiable)
    {
        return [
            'comment' => $this->comment,
            'user' => $this->user,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param   mixed $notifiable
     * @return  array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage ([
            'comment' => $this->comment,
            'user' => $this->user,
        ]);
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
            //
        ];
    }
}
