<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-user-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user password';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = $this->ask('Enter your registered email address');

        $user = User::where('email', $email)->first();
        if ($user) {
            $this->info('user found');

            $newPassword = $this->ask('Enter your new password');

            $user->update([
                'password' => bcrypt($newPassword)
            ]);

            $this->info('User password updated');
        } else {
            $this->error('user not found');
        }
    }
}
