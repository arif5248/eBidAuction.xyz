<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use App\Mail\EmailManager;
use Auth;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $user = Auth::user();
        $user->verification_code = encrypt($user->id);
        $user->save();

        $array['view'] = 'emails.verification';
        $array['subject'] = translate('Email Verification');
        $array['content'] = 'Please click the button below to verify your email address.';
        $array['link'] = route('email.verification.confirmation', $user->verification_code);

        return (new MailMessage)
            ->view('emails.verification', ['array' => $array])
            ->subject(translate('Email Verification - ').env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}