<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Vérifier l\'adresse e-mail')
                ->line('Cliquez sur le bouton ci-dessous pour vérifier votre adresse e-mail.')
                ->action('Vérifier l\'adresse e-mail', $url)
                ->line('Si vous ne souhaitez pas vérifier votre adresse e-mail, ignorez ce message.');
        });
    }
}
