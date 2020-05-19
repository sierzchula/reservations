<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartametnsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function test_create_appartment_test()
    {
        //$this->withoutExceptionHandling();
        $attributes = factory('App\Apartments')->raw();
        $this->post('/apartments', $attributes)->assertRedirect('/apartments');
        $this->assertDatabaseHas('apartments', $attributes);

    }

    public function test_if_apartments_show_shows_test()
    {
        //$this->withoutExceptionHandling();
        $apartment = factory('App\Apartments')->create();
        $this->assertDatabaseHas('apartments', ['id' => $apartment->id]);
        $this->get('/apartments/' . $apartment->id)->assertSee($apartment->name);
    }

    public function test_apartments_required_fields_test()
    {
        $this->post('/apartments', [])->assertSessionHasErrors(['name','address','persons']);
    }

}
