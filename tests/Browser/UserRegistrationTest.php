<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegistrationTest extends DuskTestCase
{
    /**
     * Testa a criação de usuário e autenticação
     * com mudanças na interface gráfica.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $user = (object) [
            'name'      => 'James Bond',
            'email'     => 'james@example.com',
            'password'  => 'Shaken, not stirred'
        ];

        // navega até página de registro e cria usuário
        $this->browse(function (Browser $browser) use ($user) {

            $delay          = 0;
            $final_delay    = 2000;

            $browser->visit('/')

                    // navega para a criação de usuário
                    ->clickLink('Registrar')
                    ->assertPathIs('/register')
                    ->pause($delay)

                    // preenchimento de formulário
                    ->type('name',                  $user->name)
                    ->type('email',                 $user->email)
                    ->type('password',              $user->password)
                    ->type('password_confirmation', $user->password)
                    ->pause($delay)
                    ->click('button[type="submit"]')

                    // verifica redirecionamento
                    ->assertPathIsNot('/register')
                    ->assertSee($user->name)

                    ->pause($final_delay);
        });

        // remove usuário
        $user = User::where('email', $user->email)->first();
        if($user) {
            $user->delete();
        }

    }
}
