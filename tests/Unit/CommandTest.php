<?php

namespace dees040\Festing\Tests\Unit;

use dees040\Festing\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class CommandTest extends TestCase
{
    /** @test */
    public function the_command_requires_a_test_name()
    {
        $this->expectException(\RuntimeException::class);

        Artisan::call('make:fest');
    }

    /** @test */
    public function the_command_can_create_a_new_feature_test_file()
    {
        with(new Filesystem())->deleteDirectory(base_path('tests'));

        Artisan::call('make:fest', [
            'name' => 'FooTest',
        ]);

        $resultAsText = Artisan::output();

        $this->assertEquals("Test created successfully.\n", $resultAsText);
        $this->assertFileExists(base_path('tests/Feature/FooTest.php'));
    }

    /** @test */
    public function the_command_can_create_a_new_unit_test_file()
    {
        with(new Filesystem())->deleteDirectory(base_path('tests'));

        Artisan::call('make:fest', [
            'name' => 'BarTest',
            '--unit' => 'true'
        ]);

        $resultAsText = Artisan::output();

        $this->assertEquals("Test created successfully.\n", $resultAsText);
        $this->assertFileExists(base_path('tests/Unit/BarTest.php'));
    }
}
