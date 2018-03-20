<?php

namespace Tests;

use dees040\Festing\FestTheDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, FestTheDatabase;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[\dees040\Festing\ShouldFest::class])) {
            $this->runFester();
        }

        return $uses;
    }
}
