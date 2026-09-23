<?php



namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;





class PaymentSuccessNotification extends Notification{


    use Queueable;

     public function toMail(object $notifiable):MailMessage{
        return (new MailMessage)
            ->subject('Payment Successful : Your payment invoice')
            ->line('Your Payment Invoice ')
            ->line('Your payment invoice is valid');
    }


    
}




?>