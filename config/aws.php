<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. The minimum
    | required options are declared here, but the full set of possible options
    | are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */

    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID', 'AKIAIQ4F7SYH4A2QBTUA'),
        'secret' => env('AWS_SECRET_KEY', '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'),
    ],
    'region' => env('AWS_REGION', 'us-west-2'),
    'version' => 'latest',
     'http'    => [
        'verify' => false
    ],
    'ua_append' => [
        'L5MOD/' . AwsServiceProvider::VERSION,
    ],
];
