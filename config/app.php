<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Sortir_Eni'),

/*
    |------------------------------------------------- -------------------------
    | Environnement d'application
    |------------------------------------------------- -------------------------
    |
    | Cette valeur détermine "l'environnement" dans lequel se trouve actuellement votre application.
    | en cours d'exécution. Cela peut déterminer la façon dont vous préférez configurer divers
    | services utilisés par l'application. Définissez ceci dans votre fichier ".env".
    |
    */

    'env' => env('APP_ENV', 'development'),

/*
    |------------------------------------------------- -------------------------
    | Mode de débogage des applications
    |------------------------------------------------- -------------------------
    |
    | Lorsque votre application est en mode débogage, des messages d'erreur détaillés avec
    | les traces de pile seront affichées pour chaque erreur qui se produit dans votre
    | application. Si cette option est désactivée, une simple page d'erreur générique s'affiche.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

/*
    |------------------------------------------------- -------------------------
    | URL de la demande
    |------------------------------------------------- -------------------------
    |
    | Cette URL est utilisée par la console pour générer correctement les URL lors de l'utilisation
    | l'outil de ligne de commande Artisan. Vous devriez définir ceci à la racine de
    | l'application afin qu'elle soit disponible dans les commandes Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

  /*
    |------------------------------------------------- -------------------------
    | Fuseau horaire de l'application
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier le fuseau horaire par défaut de votre application, qui
    | sera utilisé par les fonctions PHP date et date-heure. Le fuseau horaire
    | est défini sur "UTC" par défaut car il convient à la plupart des cas d'utilisation.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

   /*
    |------------------------------------------------- -------------------------
    | Configuration des paramètres régionaux de l'application
    |------------------------------------------------- -------------------------
    |
    | Les paramètres régionaux de l'application déterminent les paramètres régionaux par défaut qui seront utilisés
    | par les méthodes de traduction/localisation de Laravel. Cette option peut être
    | défini sur n'importe quel paramètre régional pour lequel vous prévoyez d'avoir des chaînes de traduction.
    |
    */

    'locale' => env('APP_LOCALE', 'fr'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'fr'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'fr_FR'),

 /*
    |------------------------------------------------- -------------------------
    | Clé de cryptage
    |------------------------------------------------- -------------------------
    |
    | Cette clé est utilisée par les services de chiffrement de Laravel et doit être définie
    | à une chaîne aléatoire de 32 caractères pour garantir que toutes les valeurs cryptées
    | sont sécurisés. Vous devez le faire avant de déployer l'application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

   /*
    |------------------------------------------------- -------------------------
    | Pilote du mode maintenance
    |------------------------------------------------- -------------------------
    |
    | Ces options de configuration déterminent le pilote utilisé pour déterminer et
    | gérer le statut "mode maintenance" de Laravel. Le pilote "cache"
    | permettre de contrôler le mode maintenance sur plusieurs machines.
    |
    | Pilotes pris en charge : "fichier", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
