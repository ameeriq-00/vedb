<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::pluck('name')->toArray();

        $rolesPermissions = [
            'مدخل بيانات' => [
                'view_seizedvehicle', 'create_seizedvehicle', 'update_seizedvehicle',
                'view_seizedvehicle_statusupdates', 'create_seizedvehicle_statusupdates',
                'view_seizedvehicle_attachments', 'create_seizedvehicle_attachments',
                'view_seizedvehicle_transfers', 'create_seizedvehicle_transfers',
                'view_seizedvehicle_editrequests', 'create_seizedvehicle_editrequests',
            ],
            'مدقق' => [
                'view_seizedvehicle', 'update_seizedvehicle',
                'view_seizedvehicle_statusupdates', 'create_seizedvehicle_statusupdates',
                'view_seizedvehicle_attachments',
                'view_seizedvehicle_transfers',
                'view_seizedvehicle_editrequests', 'update_seizedvehicle_editrequests',
                'view_seizedvehicle_activitylogs',
            ],
            'قِسم الآليات' => [
                'view_seizedvehicle', 'view_seizedvehicle_transfers',
                'view_governmentvehicle', 'create_governmentvehicle', 'update_governmentvehicle',
            ],
            'مستلم' => [
                'view_seizedvehicle', 'view_seizedvehicle_transfers',
            ],
            'مدير النظام' => $permissions,
        ];

        foreach ($rolesPermissions as $role => $perms) {
            $r = Role::where('name', $role)->first();
            if ($r) {
                $r->syncPermissions($perms);
            }
        }
    }
}
