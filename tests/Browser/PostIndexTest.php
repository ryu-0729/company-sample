<?php

namespace Tests\Browser;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostIndexTest extends DuskTestCase
{

    /**
     * Test Post Index.
     *
     * @return void
     */
    public function testPostIndex()
    {
        /* $this->browse(function (Browser $browser) {
            $browser->visit('/company-sample/public/posts')
                    ->assertSee('Dr.')
                    ->assertSee('Eum maxime non officiis et autem ut. Et omnis expedita consequatur aperiam. Voluptas quae doloremque tenetur eveniet corporis quia eum.')
                    ->screenshot('post_index');
        }); */
    }
}
