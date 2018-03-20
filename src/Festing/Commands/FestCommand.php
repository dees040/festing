<?php

namespace Dees040\Festing\Commands;

use Illuminate\Foundation\Console\TestMakeCommand;

class FestCommand extends TestMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:fest {name : The name of the class} {--unit : Create a unit test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new fast test class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('unit')) {
            return __DIR__.'/stubs/unit-test.stub';
        }

        return __DIR__.'/stubs/test.stub';
    }
}
