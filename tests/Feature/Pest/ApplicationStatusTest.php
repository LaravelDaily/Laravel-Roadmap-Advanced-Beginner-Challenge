<?php
use function Pest\Laravel\get;

test('check application status up', function () {
    get('/')
        ->assertStatus(302)
        ->assertRedirect('/login');
});
