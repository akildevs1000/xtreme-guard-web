<?php

use App\Models\Administration\CronFailure;
use Illuminate\Support\Carbon;


if (!function_exists('getDateAndTime')) {
    function getDateAndTime($int)
    {
        $dateString = $int;
        if (!$dateString) {
            return '---';
        }

        preg_match('/Date\((\d+)([+-]\d{4})\)/', $dateString, $matches);

        if (count($matches) === 3) {
            $timestamp = (int) $matches[1] / 1000;
            $timezoneOffset = $matches[2];

            $dateTime = new DateTime("@$timestamp");
            $dateTime->setTimezone(new DateTimeZone($timezoneOffset));

            return $dateTime->format('Y-m-d H:i:s');
        } else {
            return '---';
        }
    }
}

if (!function_exists('logAction')) {
    function logAction($value)
    {
        $arr = [
            'Create' => 'bg-success',
            'Update' => 'bg-primary',
            'Delete' => 'bg-danger',
        ];

        return " <span class='badge  " . $arr[$value] . "'> $value </span> ";
        return "<h5 class='fs-14 my-1 fw-normal'> <span class='badge  " . $arr[$value] . "'> $value </span> </h5>";
    }
}


if (!function_exists('getDeviceIcon')) {
    function getDeviceIcon($device)
    {
        $icons = [
            'Mobile' => 'ri-smartphone-line',
            'Tablet' => 'ri-tablet-line',
            'Desktop' => 'ri-computer-line',
        ];

        return $icons[$device] ?? 'ri-question-line';
    }
}

if (!function_exists('setDefultDateForReturn')) {
    function setDefultDateForReturn()
    {
        $today = now();
        $endOfMonth = now()->endOfMonth();

        return $today->format('d M, Y') . ' to ' . $endOfMonth->format('d M, Y');
    }
}

if (!function_exists('getLastCronFailedIssue')) {
    function getLastCronFailedIssue()
    {
        return CronFailure::orderBy('failed_at', 'desc')->where('is_fixed', 0)->first();
    }
}

if (!function_exists('getLastCronFailedIssueFoNotification')) {
    function getLastCronFailedIssueFoNotification()
    {
        return CronFailure::orderBy('failed_at', 'desc')->where('is_fixed', 0)->take(5)->get();
    }
}
