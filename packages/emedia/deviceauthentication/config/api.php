<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | The API key is used to identify trusted devices when there is an API
    | call made. API key is shared with the client application at development
    | stage.
    |
    | API should not expose any sensetive information to any client bearing
    | this key there is a high chance a third party get access to this key
    | based on the method used to store the API key at client side. More
    | secure token should be usied for exposing such data. Eg. OAuth 2, JWT
    |
    | This key should not be publically shared though.
    |
    */

    'key' => env('API_KEY', 'zTpmXn4jZGy17aKdVJkpJxs4FVfj6CsUS'),
];
