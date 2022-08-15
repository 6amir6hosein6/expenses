<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Morilog\Jalali\Jalalian;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getToday()
    {

        $date = Jalalian::now();
        $month = ($date->getMonth() < 10) ? 0 . $date->getMonth() : $date->getMonth();
        $day = ($date->getDay() < 10) ? 0 . $date->getDay() : $date->getDay();
        $date = $date->getYear() . '/' . $month . '/' . $day;

        return $date;
    }

    public function getNow(): string
    {
        $date = Jalalian::now();
        $hour = $date->getHour();
        $minute = $date->getMinute();

        return $hour . ':' . $minute;
    }

    public function subToday(int $days)
    {
        $date = Jalalian::now()->subDays($days);
        $month = ($date->getMonth() < 10) ? 0 . $date->getMonth() : $date->getMonth();
        $day = ($date->getDay() < 10) ? 0 . $date->getDay() : $date->getDay();
        $date = $date->getYear() . '/' . $month . '/' . $day;
        return $date;
    }
}
