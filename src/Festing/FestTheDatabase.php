<?php

namespace Dees040\Festing;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

trait FestTheDatabase
{
    /**
     * Indicates if the database setup has already ran.
     *
     * @var bool
     */
    protected static $ranSetup = false;

    /**
     * Represents the database content a.k.a. cache.
     *
     * @var string
     */
    protected static $databaseContent;

    /**
     * An array with lines which are skipable.
     *
     * @var array
     */
    protected $skipableLines = [
        'CREATE TABLE sqlite_sequence(name,seq);',
    ];

    /**
     * Run the database setup if needed and install the contents.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function runFester()
    {
        if (! static::$ranSetup) {
            $this->setUpDatabase();
        }

        $this->installDatabaseContent();
    }

    /**
     * Create a migrated sqlite database.
     *
     * @return void
     */
    private function setUpDatabase()
    {
        $databasePath = rtrim(config('festing.database_path'), '/\\');

        $fileName = config('festing.sqlite_file');
        $schemaName = config('festing.schema_file');

        $filePath = $databasePath . '/' . ltrim($fileName, '/\\');
        $schemaPath = $databasePath . '/' . ltrim($schemaName, '/\\');

        if (! file_exists($filePath)) {
            touch($filePath);
        }

        file_put_contents($filePath, '');

        $this->runCommandsBeforeDumpingDbContent();

        exec("cd {$databasePath} && sqlite3 {$fileName} .dump > {$schemaName}");

        static::$databaseContent = file_get_contents($schemaPath);

        unlink($schemaPath);

        static::$ranSetup = true;
    }

    /**
     * Before we dump the database contents we need to run the artisan commands,
     * if any are given in the settings. This can be useful if the users likes
     * to not only run the migrations, but also want some seeders to be ran.
     *
     * @return void
     */
    private function runCommandsBeforeDumpingDbContent()
    {
        $commands = config('festing.commands');

        foreach ($commands as $command => $parameters) {
            if (is_string($parameters)) {
                $command = $parameters;
                $parameters = [];
            }

            Artisan::call($command, $parameters);
        }
    }

    /**
     * Install the contents of migration to inline memory.
     *
     * @return void
     *
     * @throws \Exception
     */
    private function installDatabaseContent()
    {
        $connection = config('festing.database_connection');

        config(["database.connections.{$connection}.database" => ':memory:']);

        DB::purge('testing');

        $lines = explode("\n", self::$databaseContent);

        foreach($lines as $line) {
            try {
                DB::statement($line);
            } catch (\Exception $e) {
                if (! in_array($line, $this->skipableLines)) {
                    throw $e;
                }
            }
        }
    }
}
