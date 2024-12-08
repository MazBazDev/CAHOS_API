<?php

use App\Models\Log;

if (!function_exists('activity')) {
    function activity(string $action, string $message, $replace = []) {
        $message = str_replace(array_keys($replace), array_values($replace), $message);

        Log::create([
            'action' => $action,
            'user_id' => auth()->id(),
            'message' => $message,
        ]);
    }
}
