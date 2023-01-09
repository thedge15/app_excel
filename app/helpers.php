<?php

use App\Models\FailedRow;

if (!function_exists('process_failures')) {
    function processFailures($failures, $attributesMap, $task)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = [
                    'key' => $attributesMap[$failure->attribute()],
                    'message' => $error,
                    'row' => $failure->row(),
                    'task_id' => $task->id,
                ];
            }
        }

        if (count($map) > 0) FailedRow::insertFailedRows($map, $task);
    }
}
