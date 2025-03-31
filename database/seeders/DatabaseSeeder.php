<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Directorate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء المديريات
        $directorates = [
            'مديرية بغداد',
            'مديرية نينوى',
            'مديرية البصرة',
        ];

        foreach ($directorates as $name) {
            Directorate::firstOrCreate(['name' => $name]);
        }

        // إنشاء الأدوار
        $roles = [
            'مدخل بيانات',
            'مدقق',
            'قِسم الآليات',
            'مستلم',
            'مدير النظام',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // إنشاء مستخدمين تجريبيين
        $users = [
            [
                'name' => 'مدخل بغداد',
                'email' => 'baghdad@datainput.com',
                'password' => Hash::make('password'),
                'role' => 'مدخل بيانات',
                'directorate_id' => Directorate::where('name', 'مديرية بغداد')->first()?->id,
            ],
            [
                'name' => 'مدقق مركزي',
                'email' => 'auditor@vedb.com',
                'password' => Hash::make('password'),
                'role' => 'مدقق',
            ],
            [
                'name' => 'قِسم الآليات',
                'email' => 'fleet@vedb.com',
                'password' => Hash::make('password'),
                'role' => 'قِسم الآليات',
            ],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@vedb.com',
                'password' => Hash::make('admin123'),
                'role' => 'مدير النظام',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'directorate_id' => $data['directorate_id'] ?? null,
                ]
            );

            if (isset($data['role'])) {
                $user->assignRole($data['role']);
            }
        }
    }
}
