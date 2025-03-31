<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // تأكد من وجود الصلاحيات
        $permissions = Permission::pluck('name')->toArray();

        // توزيع الصلاحيات حسب الدور
        $rolesPermissions = [
            'مدخل بيانات' => [
                'view_seized_vehicle', 'create_seized_vehicle', 'update_seized_vehicle',
                'view_seized_vehicle_status_updates', 'create_seized_vehicle_status_updates',
                'view_seized_vehicle_attachments', 'create_seized_vehicle_attachments',
                'view_seized_vehicle_transfers', 'create_seized_vehicle_transfers',
                'view_seized_vehicle_edit_requests', 'create_seized_vehicle_edit_requests',
            ],
            'مدقق' => [
                'view_seized_vehicle', 'update_seized_vehicle',
                'view_seized_vehicle_status_updates', 'create_seized_vehicle_status_updates',
                'view_seized_vehicle_attachments',
                'view_seized_vehicle_transfers',
                'view_seized_vehicle_edit_requests', 'update_seized_vehicle_edit_requests',
                'view_activity_logs',
            ],
            'قِسم الآليات' => [
                'view_seized_vehicle', 'view_seized_vehicle_transfers',
                'view_government_vehicle', 'create_government_vehicle', 'update_government_vehicle',
            ],
            'مستلم' => [
                'view_seized_vehicle', 'view_seized_vehicle_transfers',
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
