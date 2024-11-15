<?php

use Laravel\Fortify\Features;

return [

   /*
    |------------------------------------------------- -------------------------
    | Fortifier la garde
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier quel agent d'authentification Fortify utilisera pendant
    | authentifier les utilisateurs. Cette valeur doit correspondre à l'un de vos
    | guards qui est déjà présent dans votre fichier de configuration "auth".
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Fortify Password Broker
    |--------------------------------------------------------------------------
    |
    | Here you may specify which password broker Fortify can use when a user
    | is resetting their password. This configured value should match one
    | of your password brokers setup in your "auth" configuration file.
    |
    */

    'passwords' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Username / Email
    |--------------------------------------------------------------------------
    |
    | This value defines which model attribute should be considered as your
    | application's "username" field. Typically, this might be the email
    | address of the users but you are free to change this value here.
    |
    | Out of the box, Fortify expects forgot password and reset password
    | requests to have a field named 'email'. If the application uses
    | another name for the field you may define it below as needed.
    |
    */

    'username' => 'email',

    'email' => 'email',

    /*
    |--------------------------------------------------------------------------
    | Lowercase Usernames
    |--------------------------------------------------------------------------
    |
    | This value defines whether usernames should be lowercased before saving
    | them in the database, as some database system string fields are case
    | sensitive. You may disable this for your application if necessary.
    |
    */

    'lowercase_usernames' => true,

/*
    |------------------------------------------------- -------------------------
    | Chemin d'accueil
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez configurer le chemin vers lequel les utilisateurs seront redirigés pendant
    | authentification ou réinitialisation du mot de passe lorsque les opérations réussissent
    | et l'utilisateur est authentifié. Vous êtes libre de modifier cette valeur.
    |
    */

    'home' => '/dashboard',

    /*
    |------------------------------------------------- -------------------------
    | Fortifier le préfixe/sous-domaine des routes
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier quel préfixe Fortify attribuera à toutes les routes
    | qu'il s'enregistre auprès de l'application. Si nécessaire, vous pouvez modifier
    | sous-domaine sous lequel toutes les routes Fortify seront disponibles.
    |
    */

    'prefix' => '',

    'domain' => null,

  /*
    |------------------------------------------------- -------------------------
    | Fortifier le middleware des routes
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier quel middleware Fortify attribuera aux routes
    | qu'il s'enregistre auprès de l'application. Si nécessaire, vous pouvez modifier
    | ces middlewares, mais généralement cette valeur par défaut est préférée.
    |
    */

    'middleware' => ['web'],

   /*
    |------------------------------------------------- -------------------------
    | Limitation du débit
    |------------------------------------------------- -------------------------
    |
    | Par défaut, Fortify limitera les connexions à cinq requêtes par minute pour
    | chaque combinaison d’e-mail et d’adresse IP. Toutefois, si vous souhaitez
    | spécifiez un limiteur de débit personnalisé à appeler, vous pouvez le spécifier ici.
    |
    */

    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

   /*
    |------------------------------------------------- -------------------------
    | S'inscrire Voir les itinéraires
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier si les itinéraires renvoyant des vues doivent être désactivés.
    | vous n’en aurez peut-être pas besoin lors de la création de votre propre application. Cela peut être
    | particulièrement vrai si vous écrivez une application personnalisée d'une seule page.
    |
    */

    'views' => true,

    /*
    |------------------------------------------------- -------------------------
    | Caractéristiques
    |------------------------------------------------- -------------------------
    |
    | Certaines des fonctionnalités de Fortify sont facultatives. Vous pouvez désactiver les fonctionnalités
    | en les supprimant de ce tableau. Vous êtes libre de supprimer seulement certains
    | ces fonctionnalités ou vous pouvez même supprimer toutes ces fonctionnalités si vous en avez besoin.
    |
    */

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
            // 'window' => 0,
        ]),
    ],

];
