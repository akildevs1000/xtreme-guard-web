<?php

namespace Database\Seeders;

use App\Models\Menu\MenuDetail;
use App\Models\Menu\MenuHeader;
use Illuminate\Database\Seeder;
use App\Models\Menu\MenuSubDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_headers')->truncate();
        DB::table('menu_details')->truncate();
        DB::table('menu_sub_details')->truncate();

        $currentDateTime = now();
        $prefix = 'admin';

        $menuHeaderDashboard = MenuHeader::create([
            'name1' => 'Dashboards',
            'name2' => 'Dashboards',
            'is_active' => 1,
            'icon' => 'ri-dashboard-2-line',
            'menu_slug' => null,
            'menu_code' => 1,
            'menu' => null,
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        ]);

        $menuHeaderOrganization = MenuHeader::create([
            'name1' => 'Organization',
            'name2' => 'Organization',
            'is_active' => 1,
            'icon' => 'ri-dashboard-2-line',
            'menu_slug' => null,
            'menu_code' => 100,
            'menu' => null,
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        ]);

        $menuHeaderAdministration = MenuHeader::create([
            'name1' => 'Administration',
            'name2' => 'Administration',
            'is_active' => 1,
            'icon' => 'ri-admin-line',
            'menu_slug' => null,
            'menu_code' => 300,
            'menu' => json_encode(['item1' => 'value1', 'item2' => 'value2']),
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        ]);

        $menuDetails = [
            [
                'menu_header_id' => $menuHeaderOrganization->id,
                'name1' => 'Category',
                'name2' => 'Category',
                'sequence' => '10',
                'menu_slug' => '',
                'page_url' => "$prefix/category",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-download-cloud-2-fill',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrganization->id,
                'name1' => 'Product',
                'name2' => 'Product',
                'sequence' => '20',
                'menu_slug' => '',
                'page_url' => "$prefix/products",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-arrow-go-back-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrganization->id,
                'name1' => 'Blog',
                'name2' => 'Blog',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => "$prefix/blog",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shopping-bag-3-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],

            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Users',
                'name2' => 'Users',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/user",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-user-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Role',
                'name2' => 'Role',
                'sequence' => '2',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/role",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shield-user-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Permission',
                'name2' => 'Permission',
                'sequence' => '3',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/permission",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shield-keyhole-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'User Activity',
                'name2' => 'User Activity',
                'sequence' => '4',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/user-activity",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-user-follow-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Logged Users Tracking',
                'name2' => 'Logged Users Tracking',
                'sequence' => '5',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/logged-user-tracking",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shield-keyhole-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Mail Tracking',
                'name2' => 'Mail Tracking',
                'sequence' => '6',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/mail-tracking",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-mail-check-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Setting',
                'name2' => 'Setting',
                'sequence' => '7',
                'menu_slug' => '',
                'page_url' => "$prefix/administration/setting",
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-settings-5-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
        ];

        // MenuDetail::insert($menuDetails);

        foreach ($menuDetails as $menuDetail) {
            MenuDetail::updateOrCreate(
                [
                    // Match based on unique fields, e.g., `menu_header_id` and `menu_slug`
                    'menu_header_id' => $menuDetail['menu_header_id'],
                    // 'menu_slug' => $menuDetail['menu_slug'],
                    'name1' => $menuDetail['name1'],
                ],
                [
                    // Update or create with these values
                    'name1' => $menuDetail['name1'],
                    'name2' => $menuDetail['name2'],
                    'sequence' => $menuDetail['sequence'],
                    'page_url' => $menuDetail['page_url'],
                    'is_submenu_available' => $menuDetail['is_submenu_available'],
                    'is_active' => $menuDetail['is_active'],
                    'icon' => $menuDetail['icon'],
                    'created_at' => $menuDetail['created_at'],
                    'updated_at' => $menuDetail['updated_at'],
                ]
            );
        }

        generateMenuSlug();
    }
}
