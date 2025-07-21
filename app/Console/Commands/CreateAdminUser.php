<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user for the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating admin user...');

        // Check if admin already exists
        $existingAdmin = User::where('role', 'admin')->first();
        
        if ($existingAdmin) {
            $this->info('Existing admin user found:');
            $this->table(
                ['Name', 'Email', 'Student ID'],
                [[$existingAdmin->name, $existingAdmin->email, $existingAdmin->student_id]]
            );
            
            if (!$this->confirm('Do you want to create another admin user?')) {
                $this->info('Admin creation cancelled.');
                return;
            }
        }

        // Create new admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@uc.edu.ph',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'course' => 'System Administration',
            'track' => null,
            'student_id' => 'ADMIN-' . date('Y') . '-' . str_pad(User::where('role', 'admin')->count() + 1, 3, '0', STR_PAD_LEFT),
            'phone' => '+63 917 555 0000',
            'date_of_birth' => '1980-01-01',
            'gender' => 'Other',
            'address' => '123 University Campus, Cebu City, Philippines',
            'emergency_contact_name' => 'IT Support Team',
            'emergency_contact_phone' => '+63 917 555 0001',
            'emergency_contact_relationship' => 'Colleague',
        ]);

        $this->info('Admin user created successfully!');
        $this->table(
            ['Field', 'Value'],
            [
                ['Name', $admin->name],
                ['Email', $admin->email],
                ['Password', 'admin123'],
                ['Student ID', $admin->student_id],
                ['Role', $admin->role],
            ]
        );

        $this->info('You can now access the admin dashboard at: /admin/dashboard');
    }
}
