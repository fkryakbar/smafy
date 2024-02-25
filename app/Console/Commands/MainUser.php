<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MainUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:main-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a main user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating main user');

        $user = User::create([
            'name' => 'Fkry',
            'email' => 'fikriafa289@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'user',
        ]);

        $this->info('Main user account successfully created');
    }
}
