<?php

use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Flisk\Board::class, 2)->create();

        $user = \Flisk\User::find(6);
        $user2 = \Flisk\User::find(5);
        $board = \Flisk\Board::find(1);

        $board->users()->attach($user, ['owner' => $user->id, 'active' => true]);
        $board->users()->attach($user2, ['active' => true]);

        $user3 = \Flisk\User::find(1);
        $user4 = \Flisk\User::find(2);
        $board = \Flisk\Board::find(2);

        $board->users()->attach($user3, ['owner' => $user3->id, 'active' => true]);
        $board->users()->attach($user4, ['active' => false]);
    }
}
