<?php

return [

    'endpoint' => env('EONET_ENDPOINT', 'https://eonet.gsfc.nasa.gov/api/v2.1/'),

    'headers' => [
        'user-agent' => env('EONET_USER_AGENT_HEADER', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36'
        ),
        'accept' => env('EONET_ACCEPT_HEADER', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
        )
    ],

    'paths' => [
        'event' => env('EONET_EVENT', 'events'),
        'category'=> env('EONET_CATEGORY', 'categories'),
    ]



];
