<?php

return [
    /**
     * API get on https://www.tiny.cloud/
     */
    'api_key' => env('TINY_MCE_API', 'no-api-key'),

    /**
     * Your frontend framework what you used to develop your website
     * By default it is laravel blade 
     * blade is available now
     * react, vue and angular are coming soon
     */
    'frontend_framework' => 'blade',
];