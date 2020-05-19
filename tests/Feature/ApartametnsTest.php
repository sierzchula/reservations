<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartametnsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function testCreateAppartamentTest()
    {
        //$this->withoutExceptionHandling();

        $this->attributes = factory('App\Apartaments')->raw();
        
        $this->post('/apartaments', $this->attributes)->assertRedirect('/apartaments');

        $this->assertDatabaseHas('apartaments', $this->attributes);

    }

    public function testApartamentsRequiredFieldsTest()
    {
        $this->post('/apartaments', [])->assertSessionHasErrors(['name','address','persons']);
    }
    
}
