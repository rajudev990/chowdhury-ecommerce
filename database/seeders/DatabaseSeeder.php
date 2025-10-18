<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bannar;
use App\Models\Bkash;
use App\Models\Couriore;
use App\Models\Marketing;
use App\Models\Nagad;
use App\Models\Pathau;
use App\Models\Payment;
use App\Models\Pixel;
use App\Models\Redx;
use App\Models\Setting;
use App\Models\Smtp;
use App\Models\SslCommerc;
use App\Models\StredFast;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default setting
        Setting::firstOrCreate([
            'header_logo' => ''
        ]);

        Smtp::firstOrCreate([
            'mail_mailer'=>''
        ]);

        Pixel::firstOrCreate([
            'pixel_name'=>''
        ]);

        StredFast::firstOrCreate([
            'url'=>''
        ]);

        Pathau::firstOrCreate([
            'api_key'=>''
        ]);
        Redx::firstOrCreate([
            'url'=>''
        ]);
        Couriore::firstOrCreate([
            'api_key'=>''
        ]);
        
        Bkash::firstOrCreate([
            'bkash_app_key'=>''
        ]);
        
        Bannar::firstOrCreate([
            'title'=>''
        ]);


        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create Super Admin
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Change it in production
            ]
        );

        // Create super-admin role
        $role = Role::firstOrCreate(
            ['name' => 'super-admin', 'guard_name' => 'admin']
        );

        // Define all permissions
        $permissions = [
            'create dashboard',
            'edit dashboard',
            'view dashboard',
            'delete dashboard',

            // role permissions
            'create role',
            'edit role',
            'view role',
            'delete role',

            // permission permissions
            'create permission',
            'edit permission',
            'view permission',
            'delete permission',


            // user permissions
            'create user',
            'edit user',
            'view user',
            'delete user',


            // setting permissions
            'create setting',
            'edit setting',
            'view setting',
            'delete setting',


            // category permissions
            'create category',
            'edit category',
            'view category',
            'delete category',

            // subcategory permissions
            'create subcategory',
            'edit subcategory',
            'view subcategory',
            'delete subcategory',

            // subsubcategory permissions
            'create subsubcategory',
            'edit subsubcategory',
            'view subsubcategory',
            'delete subsubcategory',

            // product permissions
            'create product',
            'edit product',
            'view product',
            'delete product',

            // seller-product permissions
            'create seller-product',
            'edit seller-product',
            'view seller-product',
            'delete seller-product',

             // order permissions
            'create order',
            'edit order',
            'view order',
            'delete order',

             // pending-order permissions
            'create pending-order',
            'edit pending-order',
            'view pending-order',
            'delete pending-order',

             // processing-order permissions
            'create processing-order',
            'edit processing-order',
            'view processing-order',
            'delete processing-order',

             // on-the-way permissions
            'create on-the-way',
            'edit on-the-way',
            'view on-the-way',
            'delete on-the-way',


             // hold permissions
            'create hold',
            'edit hold',
            'view hold',
            'delete hold',

             // courier permissions
            'create couriers',
            'edit couriers',
            'view couriers',
            'delete couriers',

             // complete permissions
            'create complete',
            'edit complete',
            'view complete',
            'delete complete',

             // cancelled permissions
            'create cancelled',
            'edit cancelled',
            'view cancelled',
            'delete cancelled',

             // coupon permissions
            'create coupon',
            'edit coupon',
            'view coupon',
            'delete coupon',

             // smtp permissions
            'create smtp',
            'edit smtp',
            'view smtp',
            'delete smtp',

             // courier permissions
            'create courier',
            'edit courier',
            'view courier',
            'delete courier',

             // marketing permissions
            'create marketing',
            'edit marketing',
            'view marketing',
            'delete marketing',

             // payment permissions
            'create payment',
            'edit payment',
            'view payment',
            'delete payment',

             // banner permissions
            'create banner',
            'edit banner',
            'view banner',
            'delete banner',

             // configuration permissions
            'create configuration',
            'edit configuration',
            'view configuration',
            'delete configuration',

             // affiliate-user permissions
            'create affiliate-user',
            'edit affiliate-user',
            'view affiliate-user',
            'delete affiliate-user',

             // affiliate-withdraw permissions
            'create affiliate-withdraw',
            'edit affiliate-withdraw',
            'view affiliate-withdraw',
            'delete affiliate-withdraw',

             // sellers permissions
            'create sellers',
            'edit sellers',
            'view sellers',
            'delete sellers',

            // report permissions
            'create report',
            'edit report',
            'view report',
            'delete report',




        ];

        // Create and assign permissions to role
        foreach ($permissions as $perm) {
            $permission = Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'admin'
            ]);

            // Assign permission to role if not already assigned
            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }
        }

        // Assign role to admin
        if (!$admin->hasRole($role)) {
            $admin->assignRole($role);
        }
    }
}
