<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMfaOtpNotification extends Notification
{
    use Queueable;

    private string $otp; // private property to hold the OTP value


    // function to initialize the notification with the otp value
    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    // function to specify the notification channels (in this case, email)
    public function via( object $notifiable) : array {
        return ['mail'];
    }

    // function to define the email body of the notification, including subject, lines, and the OTP value
    public function toMail(object $notifiable):MailMessage{
        return (new MailMessage)
            ->subject('Your MFA OTP Code')
            ->line('Your One-Time Password (OTP) for Multi-Factor Authentication (MFA) is:')
            ->line($this->otp)
            ->line('This OTP is valid for 5 minutes. Please do not share it with anyone.');
    }
}
