<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class MakePermission extends Command
{
    // Command Signature
    protected $signature = 'app:permission {name : The name of the permission} {guard? : Guard name (optional)}';

    // Description
    protected $description = 'Create a new permission using Spatie Permission package';

    // Command logic
    public function handle()
    {
        $name = $this->argument('name');
        $guard = $this->argument('guard') ?? 'web';

        // Check if permission already exists
        if (Permission::where('name', $name)->where('guard_name', $guard)->exists()) {
            $this->error("Permission '{$name}' already exists for guard '{$guard}'");
            return 1;
        }

        // Create new permission
        Permission::create([
            'name' => $name,
            'guard_name' => $guard,
        ]);

        $this->info("✅ Permission '{$name}' created successfully under guard '{$guard}'");
        return 0;
    }
}
