<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Models\User::class,
        'key'    => '',
        'secret' => '',
    ],
    'wechat' => [
        'client_id' => env('WEIXIN_KEY','wx11d5991f5ed048f8'),
        'client_secret' => env('WEIXIN_SECRET','def48bece237339faad4f6e253a8036f'),
        'redirect' => env('WEIXIN_REDIRECT_URI','http://www.duitujia.com/wechat/callback'),
    ],

    'qq' => [
        'client_id' => env('QQ_KEY','101269781'),
        'client_secret' => env('QQ_SECRET','7bbbc65f2f8fa98ef265d9f21ad04179'),
        'redirect' => env('QQ_REDIRECT_URI','http://www.duitujia.com/qq/callback'),
    ],

];
