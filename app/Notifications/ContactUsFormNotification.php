<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUsFormNotification extends Notification
{
    use Queueable;

    public $email;
    public $fname;
    public $lname;
    public $subject;
    public $contactMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->email = $request->input("email");
        $this->fname = $request->input("fname");
        $this->lname = $request->input("lname");
        $this->subject = $request->input("subject");
        $this->contactMessage = $request->input("message");
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->greeting("Hello Admin!")
            ->line("Someone [$this->fname, $this->lname, $this->email] tried to contact you.")
            ->line($this->contactMessage)
            ->subject($this->subject)
            ->from($this->email);
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
