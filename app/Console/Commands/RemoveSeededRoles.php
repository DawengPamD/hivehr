<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class RemoveSeededRoles extends Command
{
    protected $signature = 'db:remove-seeded-roles';
    protected $description = 'Remove seeded roles from the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $roles = [
            'Company Admins',
            'Project Managers',
            'Team Leaders',
            'Team Members-Employee',
            'HR Personnel',
            'Company Admin',
            'Project Manager',
            'Team Leader',
            'Team Members-Employe',
        ];

        foreach ($roles as $role) {
            $roleModel = Role::where('name', $role)->first();
            if ($roleModel) {
                $roleModel->delete();
                $this->info("Role '{$role}' deleted.");
            } else {
                $this->info("Role '{$role}' does not exist.");
            }
        }

        $this->info('Seeded roles removed successfully.');
    }
}
