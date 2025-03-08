<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder_backup_18_02_2025 extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'notify_for_quantity_below',
                'value' => '100',
                'is_active' => 1,
                'type' => 'text',
                'type_value' => null,
                'user_id' => null,
                'level' => 'app',
                'is_visible' => 1,
                'created_at' => '2024-10-09 10:36:58',
                'updated_at' => '2024-11-06 07:56:34',
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
                'created_at' => '2024-10-09 11:04:58',
                'updated_at' => '2024-10-16 11:53:01',
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
                'created_at' => '2024-10-09 11:04:58',
                'updated_at' => '2024-10-24 11:41:37',
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
                'created_at' => '2024-10-09 11:04:58',
                'updated_at' => '2024-10-28 11:12:50',
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
                'created_at' => '2024-10-09 11:04:58',
                'updated_at' => '2024-10-21 11:07:57',
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
                'created_at' => '2024-10-09 10:36:58',
                'updated_at' => '2024-10-25 07:45:19',
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
                'created_at' => '2024-10-09 11:04:58',
                'updated_at' => '2024-10-28 11:22:20',
            ],
        ]);
    }
}
