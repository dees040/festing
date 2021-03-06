<?php 

return [

   /*
   |--------------------------------------------------------------------------
   | The database path
   |--------------------------------------------------------------------------
   |
   | While running the tests we need to make some files. These files will be
   | saved in the following directory. By default we will use the database
   | directory.
   |
   */

    'database_path' => database_path(),

   /*
   |--------------------------------------------------------------------------
   | Database testing connection
   |--------------------------------------------------------------------------
   |
   | The name of the database connection which is needed to use while
   | testing.
   |
   */

    'database_connection' => 'testing',
    
    /*
    |--------------------------------------------------------------------------
    | The sqlite file name
    |--------------------------------------------------------------------------
    |
    | When running the first test the package creates a testing.sqlite file.
    | In this file we will run all migrations.
    |
    | Here choose how you want the sqlite file to be named.
    |
    */

    'sqlite_file' => 'testing.sqlite',

    /*
    |--------------------------------------------------------------------------
    | The schema file name
    |--------------------------------------------------------------------------
    |
    | After running the migrations and storing them in a sqlite file, the
    | package will write all sql into a .sql file. This file will then by used
    | to read all the schemas/tables which are created after the migrations.
    | The content which has been read will be cached into a static variable.
    |
    | Here you can specify which name you want to use for the .sql file.
    |
    */

    'schema_file' => 'schema.sql',

    /*
   |--------------------------------------------------------------------------
   | Artisan commands to run
   |--------------------------------------------------------------------------
   |
   | Before the database structure + data is cached we'll run a list of artisan
   | commands. This can be useful if you want the migrations to be in the cached
   | data or maybe you want a seeder to run. You can specify a list of commands
   | which you'd like to be run. If you'd like to add arguments to your commands
   | you should make the command the key and add the options as an array to the
   | specific command, for example:
   |
   | 'db:seed' => ['--class' => 'RolesTableSeeder'],
   |
   */

    'commands' => [
        'migrate',
    ],
];
