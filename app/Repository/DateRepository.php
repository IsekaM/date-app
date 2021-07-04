<?php

namespace App\Repository;

use App\Models\Date;
use App\Helpers\Classes\Dioxide;

class DateRepository
{
    /**
     * Start Date
     *
     * @var string
     */
    private $start_date;

    /**
     * End Date
     *
     * @var string
     */
    private $end_date;

    // private $ip_address;

    public function __construct()
    {
        $this->start_date = request()->input("start_date");
        $this->end_date = request()->input("end_date");
        // $this->ip_address = request()->ip();
    }

    /**
     * Calculates days between start and end date
     * provided by user
     *
     * @return void
     */
    public function getResult()
    {
        $days = (new Dioxide(
            $this->start_date,
            $this->end_date,
        ))->differenceInDays();

        return $this->store($days);
    }

    /**
     * Stores and/or return result from database if
     * there is an entry with the same start and 
     * end dates
     *
     * @param integer $result
     * @return void
     */
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
            // "ip_address" => $this->ip_address,
        ]);
    }

    /**
     * Returns database entry with the same start and
     * end date if it exists
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function entryInDB()
    {
        return Date::where([
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ])->get();
    }
}
