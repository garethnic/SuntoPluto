<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'admins',
        'users',
        'tasks',
        'boards',
        'board_user',
        'invites'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (app()->environment() == 'production') {
            die("Not in production\n");
        }

        $this->cleanup();

        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BoardSeeder::class);
        $this->call(TaskSeeder::class);

        Model::reguard();
    }

    private function cleanup()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach($this->tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
