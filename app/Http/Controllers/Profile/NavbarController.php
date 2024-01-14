<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class NavbarController extends Controller
{
    public function getDaysTogether()
    {
        $startDate = Carbon::create(2022, 3, 19);
        $currentDate = Carbon::now();
        $diff = $currentDate->diff($startDate);

        $daysTogether = $diff->format('%a days, %h hours, %i minutes, %s seconds');

        return "Time together: " . $daysTogether;
    }
}
