<?php

namespace Tests\Feature;

use Tests\TestCase;
use dees040\Festing\ShouldFest;
use Illuminate\Foundation\Testing\WithFaker;

class ExampleTest extends TestCase
{
    use ShouldFest;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
