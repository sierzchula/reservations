<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApartmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path_test()
    {
        $apartment = factory('App\Apartments')->create();
        $this->assertEquals('/apartments/' . $apartment->id, $apartment->path() );
    }
}
