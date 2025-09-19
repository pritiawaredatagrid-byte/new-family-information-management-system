<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\Models\Admin;

class HashAdminPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hash-admin-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hashes all plaintext passwords in the admin table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admins = Admin::all();
        $count = 0;

        foreach ($admins as $admin) {
            if (strpos($admin->password, '$2y$') !== 0) {
                $admin->password = Hash::make($admin->password);
                $admin->save();
                $count++;
            }
        }

        $this->info("Hashed $count admin passwords.");
    }
}
