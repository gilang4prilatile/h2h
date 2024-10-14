<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            // $browser->visit('/login');
            // $browser->type('email', 'super@store2go.com');
            // $browser->type('password', 'admin123');
            // $browser->press('Masuk');
            // $browser->assertPathIs('/dashboard');
        });
    }
}
