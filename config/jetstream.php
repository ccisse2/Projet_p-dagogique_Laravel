<?php

use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Middleware\AuthenticateSession;

return [

  /*
    |------------------------------------------------- -------------------------
    | Pile Jetstream
    |------------------------------------------------- -------------------------
    |
    | Cette valeur de configuration informe Jetstream de quelle "pile" vous serez
    | utiliser pour votre application. En général, cette valeur est définie pour vous
    | lors de l'installation et n'aura pas besoin d'être modifié par la suite.
    |
    */

    'stack' => 'livewire',

  /*
    |------------------------------------------------- -------------------------
    | Intergiciel de route Jetstream
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier quel middleware Jetstream attribuera aux routes
    | qu'il s'enregistre auprès de l'application. Si nécessaire, vous pouvez modifier
    | ces middlewares ; cependant, cette valeur par défaut est généralement suffisante.
    |
    */

    'middleware' => ['web'],

    'auth_session' => AuthenticateSession::class,

/*
    |------------------------------------------------- -------------------------
    | Garde Jetstream
    |------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier le garde d'authentification que Jetstream utilisera pendant
    | authentifier les utilisateurs. Cette valeur doit correspondre à l'un de vos
    | guards qui est déjà présent dans votre fichier de configuration "auth".
    |
    */

    'guard' => 'sanctum',
/*
    |------------------------------------------------- -------------------------
    | Caractéristiques
    |------------------------------------------------- -------------------------
    |
    | Certaines fonctionnalités de Jetstream sont facultatives. Vous pouvez désactiver les fonctionnalités
    | en les supprimant de ce tableau. Vous êtes libre de supprimer seulement certains
    | ces fonctionnalités ou vous pouvez même supprimer toutes ces fonctionnalités si vous en avez besoin.
    |
    */

    'features' => [
        // Features::termsAndPrivacyPolicy(),
        Features::profilePhotos(),
        // Features::api(),
        // Features::teams(['invitations' => true]),
        Features::accountDeletion(),
    ],

 /*
    |------------------------------------------------- -------------------------
    | Disque de photos de profil
    |------------------------------------------------- -------------------------
    |
    | Cette valeur de configuration détermine le disque par défaut qui sera utilisé
    | lors du stockage des photos de profil des utilisateurs de votre application. Typiquement
    | ce sera le disque "public" mais vous pourrez l'ajuster si nécessaire.
    |
    */

    'profile_photo_disk' => 'public',

];
