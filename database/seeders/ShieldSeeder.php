<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"panel_user","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_backup","view_any_backup","create_backup","update_backup","restore_backup","restore_any_backup","replicate_backup","reorder_backup","delete_backup","delete_any_backup","force_delete_backup","force_delete_any_backup","view_customer","view_any_customer","create_customer","update_customer","restore_customer","restore_any_customer","replicate_customer","reorder_customer","delete_customer","delete_any_customer","force_delete_customer","force_delete_any_customer","view_inventory","view_any_inventory","create_inventory","update_inventory","restore_inventory","restore_any_inventory","replicate_inventory","reorder_inventory","delete_inventory","delete_any_inventory","force_delete_inventory","force_delete_any_inventory","view_product","view_any_product","create_product","update_product","restore_product","restore_any_product","replicate_product","reorder_product","delete_product","delete_any_product","force_delete_product","force_delete_any_product","view_product::sale::price","view_any_product::sale::price","create_product::sale::price","update_product::sale::price","restore_product::sale::price","restore_any_product::sale::price","replicate_product::sale::price","reorder_product::sale::price","delete_product::sale::price","delete_any_product::sale::price","force_delete_product::sale::price","force_delete_any_product::sale::price","view_purchase","view_any_purchase","create_purchase","update_purchase","restore_purchase","restore_any_purchase","replicate_purchase","reorder_purchase","delete_purchase","delete_any_purchase","force_delete_purchase","force_delete_any_purchase","view_sale","view_any_sale","create_sale","update_sale","restore_sale","restore_any_sale","replicate_sale","reorder_sale","delete_sale","delete_any_sale","force_delete_sale","force_delete_any_sale","view_supplier","view_any_supplier","create_supplier","update_supplier","restore_supplier","restore_any_supplier","replicate_supplier","reorder_supplier","delete_supplier","delete_any_supplier","force_delete_supplier","force_delete_any_supplier","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_MyProfilePage","widget_AdminWidgetStats"]},{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_backup","view_any_backup","create_backup","update_backup","restore_backup","restore_any_backup","replicate_backup","reorder_backup","delete_backup","delete_any_backup","force_delete_backup","force_delete_any_backup","view_customer","view_any_customer","create_customer","update_customer","restore_customer","restore_any_customer","replicate_customer","reorder_customer","delete_customer","delete_any_customer","force_delete_customer","force_delete_any_customer","view_inventory","view_product","view_any_product","create_product","update_product","restore_product","restore_any_product","replicate_product","reorder_product","delete_product","delete_any_product","force_delete_product","force_delete_any_product","view_product::sale::price","view_any_product::sale::price","create_product::sale::price","update_product::sale::price","restore_product::sale::price","restore_any_product::sale::price","replicate_product::sale::price","reorder_product::sale::price","delete_product::sale::price","delete_any_product::sale::price","force_delete_product::sale::price","force_delete_any_product::sale::price","view_purchase","view_any_purchase","create_purchase","update_purchase","restore_purchase","restore_any_purchase","replicate_purchase","reorder_purchase","delete_purchase","delete_any_purchase","force_delete_purchase","force_delete_any_purchase","view_sale","view_any_sale","create_sale","update_sale","restore_sale","restore_any_sale","replicate_sale","reorder_sale","delete_sale","delete_any_sale","force_delete_sale","force_delete_any_sale","view_supplier","view_any_supplier","create_supplier","update_supplier","restore_supplier","restore_any_supplier","replicate_supplier","reorder_supplier","delete_supplier","delete_any_supplier","force_delete_supplier","force_delete_any_supplier","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_MyProfilePage","widget_AdminWidgetStats"]},{"name":"admin","guard_name":"web","permissions":["view_backup","view_any_backup","create_backup","update_backup","restore_backup","restore_any_backup","replicate_backup","reorder_backup","delete_backup","delete_any_backup","force_delete_backup","force_delete_any_backup","view_customer","view_inventory","view_product::sale::price","view_any_product::sale::price","create_product::sale::price","update_product::sale::price","restore_product::sale::price","restore_any_product::sale::price","replicate_product::sale::price","reorder_product::sale::price","delete_product::sale::price","delete_any_product::sale::price","force_delete_product::sale::price","force_delete_any_product::sale::price","view_purchase","view_any_purchase","create_purchase","update_purchase","restore_purchase","restore_any_purchase","replicate_purchase","reorder_purchase","delete_purchase","delete_any_purchase","force_delete_purchase","force_delete_any_purchase","view_sale","view_any_sale","create_sale","update_sale","restore_sale","restore_any_sale","replicate_sale","reorder_sale","delete_sale","delete_any_sale","force_delete_sale","force_delete_any_sale","view_supplier","view_any_supplier","create_supplier","update_supplier","restore_supplier","restore_any_supplier","replicate_supplier","reorder_supplier","delete_supplier","delete_any_supplier","force_delete_supplier","force_delete_any_supplier","view_user","view_any_user","create_user","update_user","page_MyProfilePage"]},{"name":"vendedor","guard_name":"web","permissions":["view_inventory","view_any_inventory","create_inventory","update_inventory","restore_inventory","restore_any_inventory","replicate_inventory","reorder_inventory","delete_inventory","delete_any_inventory","force_delete_inventory","force_delete_any_inventory","view_sale","view_any_sale","create_sale","update_sale","restore_sale","restore_any_sale","replicate_sale","reorder_sale","delete_sale","delete_any_sale","force_delete_sale","force_delete_any_sale"]},{"name":"supervisor","guard_name":"web","permissions":["view_inventory","view_any_inventory","create_inventory","update_inventory","restore_inventory","restore_any_inventory","replicate_inventory","reorder_inventory","delete_inventory","delete_any_inventory","force_delete_inventory","force_delete_any_inventory","view_purchase","view_any_purchase","create_purchase","update_purchase","restore_purchase","restore_any_purchase","replicate_purchase","reorder_purchase","delete_purchase","delete_any_purchase","force_delete_purchase","force_delete_any_purchase"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
