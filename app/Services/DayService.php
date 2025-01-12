<?php

namespace App\Services;

use App\Models\Day;
use Illuminate\Support\Collection;

class DayService
{
    public function getDays(): Collection {
        return Day::all();
    }
}
