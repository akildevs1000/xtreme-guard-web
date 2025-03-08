<?php

namespace Database\Seeders;

use App\Models\Menu\MenuDetail;
use App\Models\Menu\MenuHeader;
use Illuminate\Database\Seeder;
use App\Models\Menu\MenuSubDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenusTableSeedercopy extends Seeder
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

        $menuHeaderOrder = MenuHeader::create([
            'name1' => 'Orders',
            'name2' => 'Orders',
            'is_active' => 1,
            'icon' => 'ri-dashboard-2-line',
            'menu_slug' => null,
            'menu_code' => 100,
            'menu' => null,
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        ]);

        $menuHeaderShipment = MenuHeader::create([
            'name1' => 'Shipment',
            'name2' => 'Shipment',
            'is_active' => 0,
            'icon' => 'ri-apps-2-line',
            'menu_slug' => null,
            'menu_code' => 200,
            'menu' => null,
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
        ]);

        $menuHeaderReport = MenuHeader::create([
            'name1' => 'Reports',
            'name2' => 'Reports',
            'is_active' => 1,
            'icon' => 'ri-file-chart-line',
            'menu_slug' => null,
            'menu_code' => 400,
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
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Import Orders',
                'name2' => 'Import Orders',
                'sequence' => '10',
                'menu_slug' => '',
                'page_url' => '#',
                'is_submenu_available' => 0,
                'is_active' => 0,
                'icon' => 'ri-download-cloud-2-fill',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Import Returns',
                'name2' => 'Import Returns',
                'sequence' => '20',
                'menu_slug' => '',
                'page_url' => '#',
                'is_submenu_available' => 0,
                'is_active' => 0,
                'icon' => 'ri-arrow-go-back-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Pending Orders',
                'name2' => 'Pending Orders',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => 'order/order',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shopping-bag-3-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Confirmed Orders',
                'name2' => 'Confirmed Orders',
                'sequence' => '2',
                'menu_slug' => '',
                'page_url' => 'order/confirmed-order',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-truck-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Stock Status',
                'name2' => 'Stock Status',
                'sequence' => '5',
                'menu_slug' => '',
                'page_url' => 'order/warehouse',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-store-2-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Delivered Orders',
                'name2' => 'Delivered Orders',
                'sequence' => '3',
                'menu_slug' => '',
                'page_url' => 'order/delivered-order',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-truck-fill',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Pickup Orders',
                'name2' => 'Pickup Orders',
                'sequence' => '4',
                'menu_slug' => '',
                'page_url' => 'order/pickup-order',
                'is_submenu_available' => 0,
                'is_active' => 0,
                'icon' => 'ri-building-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderOrder->id,
                'name1' => 'Tracking',
                'name2' => 'Tracking',
                'sequence' => '5',
                'menu_slug' => '',
                'page_url' => '#',
                'is_submenu_available' => 1,
                'is_active' => 1,
                'icon' => 'ri-map-pin-2-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],

            //menuHeaderShipment
            [
                'menu_header_id' => $menuHeaderShipment->id,
                'name1' => 'Add Shipment',
                'name2' => 'Add Shipment',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => '#',
                'is_submenu_available' => 0,
                'is_active' => 0,
                'icon' => 'ri-add-circle-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderShipment->id,
                'name1' => 'Delivery',
                'name2' => 'Delivery',
                'sequence' => '2',
                'menu_slug' => '',
                'page_url' => '#',
                'is_submenu_available' => 0,
                'is_active' => 0,
                'icon' => 'ri-truck-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],


            //menuHeaderAdministration

            [
                'menu_header_id' => $menuHeaderAdministration->id,
                'name1' => 'Users',
                'name2' => 'Users',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => 'administration/user',
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
                'page_url' => 'administration/role',
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
                'page_url' => 'administration/permission',
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
                'page_url' => 'administration/user-activity',
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
                'page_url' => 'administration/logged-user-tracking',
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
                'page_url' => 'administration/mail-tracking',
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
                'page_url' => 'administration/setting',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-settings-5-line',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],

            //menuHeaderReport
            [
                'menu_header_id' => $menuHeaderReport->id,
                'name1' => 'By Orders',
                'name2' => 'By Orders',
                'sequence' => '1',
                'menu_slug' => '',
                'page_url' => 'report/received-order',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-download-cloud-2-fill',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderReport->id,
                'name1' => 'Warehouse Stock',
                'name2' => 'Warehouse Stock',
                'sequence' => '2',
                'menu_slug' => '',
                'page_url' => 'report/warehouse-stock',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-download-2-fill',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'menu_header_id' => $menuHeaderReport->id,
                'name1' => 'By Products',
                'name2' => 'By Products',
                'sequence' => '3',
                'menu_slug' => '',
                'page_url' => 'report/product-by-order',
                'is_submenu_available' => 0,
                'is_active' => 1,
                'icon' => 'ri-shopping-basket-2-fill',
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

        MenuSubDetail::create([
            'menu_detail_id' => 8,
            'name1' => 'Shipment',
            'name2' => 'Shipment',
            'sequence' => '1',
            'page_url' => 'shipment/tracking',
            'is_active' => 1,
            'icon' => 'ri-ship-line',
        ]);

        MenuSubDetail::create([
            'menu_detail_id' => 8,
            'name1' => 'Delivery',
            'name2' => 'Delivery',
            'sequence' => '2',
            'page_url' => 'order/pickup-order',
            'is_active' => 1,
            'icon' => 'ri-truck-line',
        ]);

        generateMenuSlug();
    }
}
