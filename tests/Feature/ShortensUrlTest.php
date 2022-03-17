<?php

use function Pest\Laravel\post;

it('should short a url and generate a custom 4 digit hash', function () {
    $response = post('/short-urls');

    $response
        ->assertRedirect('/short-urls');
});
