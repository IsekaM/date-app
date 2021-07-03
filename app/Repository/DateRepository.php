<?php

namespace App\Repository;

use App\Helpers\Classes\Dioxide;
use App\Models\Date;

class DateRepository
{
    private $start_date;
    private $end_date;
    private $ip_address;

    public function __construct()
    {
        $this->start_date = request()->input("start_date");
        $this->end_date = request()->input("end_date");
        // $this->ip_address = request()->ip();
    }

    public function getResult()
    {
        $days = (new Dioxide(
            $this->start_date,
            $this->end_date,
        ))->differenceInDays();

        return $this->store($days);
    }

    private function store(int $result)
    {
        $DB_entry = $this->entryInDB();

        if (count($DB_entry) >= 1) {
            return $DB_entry->first();
        }

        return Date::create([
            "result" => $result,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "ip_address" => $this->ip_address,
        ]);
    }

    private function entryInDB()
    {
        return Date::where([
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ])->get();
    }
}
