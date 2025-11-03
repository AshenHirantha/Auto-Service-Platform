<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Customer permissions
            'view_own_vehicles',
            'manage_own_vehicles',
            'book_services',
            'view_service_history',
            'order_parts',
            'view_own_orders',
            
            // Service Station permissions
            'manage_service_requests',
            'manage_staff',
            'manage_service_bays',
            'view_station_reports',
            'manage_station_inventory',
            
            // Vendor permissions
            'manage_parts_catalog',
            'manage_parts_orders',
            'manage_vendor_inventory',
            'view_vendor_reports',
            
            // Admin permissions
            'manage_users',
            'manage_all_service_stations',
            'manage_all_vendors',
            'view_all_reports',
            'system_configuration',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $customerRole = Role::create(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'view_own_vehicles',
            'manage_own_vehicles',
            'book_services',
            'view_service_history',
            'order_parts',
            'view_own_orders',
        ]);

        $serviceStationRole = Role::create(['name' => 'service_station']);
        $serviceStationRole->givePermissionTo([
            'manage_service_requests',
            'manage_staff',
            'manage_service_bays',
            'view_station_reports',
            'manage_station_inventory',
        ]);

        $vendorRole = Role::create(['name' => 'vendor']);
        $vendorRole->givePermissionTo([
            'manage_parts_catalog',
            'manage_parts_orders',
            'manage_vendor_inventory',
            'view_vendor_reports',
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}