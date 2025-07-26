<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckDeanUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dean:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check dean user accounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deans = User::where('role', 'dean')->get();
        
        if ($deans->isEmpty()) {
            $this->error('No dean users found!');
            return;
        }
        
        $this->info('Dean users found:');
        foreach ($deans as $dean) {
            $this->line("Name: {$dean->name}");
            $this->line("Email: {$dean->email}");
            $this->line("Student ID: {$dean->student_id}");
            $this->line("---");
        }
    }
}
