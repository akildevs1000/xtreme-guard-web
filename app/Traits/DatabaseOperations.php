<?php

namespace App\Traits;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Orders\ImportOrderRepo;

trait DatabaseOperations
{
    public function updateOrInsertDublicateForBackup(string $tableName, array $matchConditions, array $data): bool
    {
        try {
            // Validate table name
            if (empty($tableName)) {
                throw new \InvalidArgumentException("Table name cannot be empty.");
            }

            // Validate match conditions and data
            $validator = Validator::make(
                ['matchConditions' => $matchConditions, 'data' => $data],
                [
                    'matchConditions' => 'required|array|min:1',
                    'data' => 'required|array|min:1',
                ]
            );

            if ($validator->fails()) {
                Log::error("DatabaseOperations: Validation failed for updateOrInsertDynamic.", [
                    'errors' => $validator->errors()->toArray(),
                ]);
                return false;
            }

            // Perform update or insert
            DB::table($tableName)->updateOrInsert($matchConditions, $data);

            // Log success
            Log::info("updateOrInsertDynamic executed successfully.", [
                'table' => $tableName,
                'matchConditions' => $matchConditions,
                'data' => $data,
            ]);

            return true;
        } catch (\Exception $e) {
            // Log error
            Log::error("DatabaseOperations: Error in updateOrInsertDynamic.", [
                'message' => $e->getMessage(),
                'table' => $tableName,
                'matchConditions' => $matchConditions,
                'data' => $data,
            ]);
            return false;
        }
    }
}
