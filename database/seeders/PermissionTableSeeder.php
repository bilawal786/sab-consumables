<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'setting',
            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',
            'stock-list',
            'stock-create',
            'stock-delete',
            'employee-list',
            'employee-import',
            'distribution',
            'damages-list',
            'damages-create',
            'damages-approve',
            'damages-reject',
            'distribution-report-list',
            'distribution-report-show',
            'stock-report-list',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
