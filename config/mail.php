<?php

return [

  /*
    |------------------------------------------------- -------------------------
    | Messagerie par défaut
    |------------------------------------------------- -------------------------
    |
    | Cette option contrôle le logiciel de messagerie par défaut utilisé pour envoyer tous les e-mails
    | messages sauf si un autre logiciel de messagerie est explicitement spécifié lors de l'envoi
    | le message. Tous les mailers supplémentaires peuvent être configurés dans le
    | tableau "mailers". Des exemples de chaque type de courrier sont fournis.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

   /*
    |------------------------------------------------- -------------------------
    | Configurations de messagerie
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez configurer tous les mailers utilisés par votre application ainsi que
    | leurs réglages respectifs. Plusieurs exemples ont été configurés pour
    | vous et vous êtes libres d’ajouter le vôtre selon les besoins de votre candidature.
    |
    | Laravel prend en charge une variété de pilotes de « transport » de courrier qui peuvent être utilisés
    | lors de la livraison d'un e-mail. Vous pouvez spécifier celui que vous utilisez pour
    | vos mailers ci-dessous. Vous pouvez également ajouter des courriers supplémentaires si nécessaire.
    |
    | Pris en charge : "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "cachet de la poste", "renvoyer", "journal", "tableau",
    |            "basculement", "tourniquet"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],

    ],

/*
    |------------------------------------------------- -------------------------
    | Adresse globale « De »
    |------------------------------------------------- -------------------------
    |
    | Vous souhaiterez peut-être que tous les e-mails envoyés par votre candidature soient envoyés depuis
    | la même adresse. Ici, vous pouvez spécifier un nom et une adresse qui sont
    | utilisé globalement pour tous les e-mails envoyés par votre application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'poutlar91@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
