<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CurrentWeatherTest extends DuskTestCase
{
    /**
     * Testa diferentes visualizações meteorológicas
     * atuais feitas por um usuário autenticado.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            // autentica-se
            $browser->loginAs(User::find(1))

                // visita página e aguarda previsão carregar
                ->visit('/app')
                ->waitUntilMissing('.loader')
                ->assertVisible('.weather')
                ->assertVisible('.imagem-do-tempo')
                ->assertSee('ºC')

                // obtém previsão local
                ->clickLink('Obter localização')
                ->waitUntilMissing('.loader')
                ->assertVisible('.weather')
                ->assertVisible('.imagem-do-tempo')
                ->assertSee('Rio Grande')

                ->pause(5000);
        });
    }
}
