<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $board = \Flisk\Board::find(1);
        $board2 = \Flisk\Board::find(2);

        factory(\Flisk\Task::class, 10)->create([
            'board_identifier' => $board->identifier,
            'user_id' => 6
        ]);

        factory(\Flisk\Task::class, 10)->create([
            'board_identifier' => $board2->identifier,
            'user_id' => 1
        ]);
    }
}
