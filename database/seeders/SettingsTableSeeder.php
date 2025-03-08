<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'notify_for_quantity_below',
                'value' => '100',
                'is_active' => 1,
                'type' => 'text',
                'type_value' => null,
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'confirmation_mode',
                'value' => 'yes',
                'is_active' => 0,
                'type' => 'text',
                'type_value' => null,
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'warehouse_stock_upload',
                'value' => 'everyTenMinutes',
                'is_active' => 1,
                'type' => 'select',
                'type_value' => 'everyMinute,everyFiveMinutes,everyTenMinutes,everyThirtyMinutes,hourly',
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'import_order_schedule',
                'value' => 'everyFiveMinutes',
                'is_active' => 1,
                'type' => 'select',
                'type_value' => 'everyMinute,everyFiveMinutes,everyTenMinutes,everyThirtyMinutes,hourly',
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'export_order_schedule',
                'value' => 'everyFiveMinutes',
                'is_active' => 1,
                'type' => 'select',
                'type_value' => 'everyMinute,everyFiveMinutes,everyTenMinutes,everyThirtyMinutes,hourly',
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'low_qty_notification_email',
                'value' => 'm.fahath@mirnah.com',
                'is_active' => 1,
                'type' => 'text',
                'type_value' => null,
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'low_qty_notification_schedule',
                'value' => 'daily',
                'is_active' => 1,
                'type' => 'select',
                'type_value' => 'everyMinute,everyFiveMinutes,everyTenMinutes,everyThirtyMinutes,hourly,daily',
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'scheduler_failed_notification_email',
                'value' => 'm.fahath@mirnah.com',
                'is_active' => 1,
                'type' => 'text',
                'type_value' => null,
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']], // Condition to check existing record
                array_merge($setting, ['updated_at' => now()]) // Update data
            );
        }
    }
}
