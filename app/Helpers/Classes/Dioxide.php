<?php

namespace App\Helpers\Classes;

use DateTime;

class Dioxide
{
    /**
     * Date to be subtracted
     *
     * @var DateTime
     */
    public $start_date;

    /**
     * Date to be subtracted from the first date
     *
     * @var DateTime
     */
    public $end_date;

    /**
     * Undocumented variable
     *
     * @var DateInterval
     */
    private $diff;

    /**
     * Undocumented function
     *
     * @param string $first_date
     * @param string $second_date
     */
    public function __construct(string $start_date, string $end_date)
    {
        $this->start_date = date_create($start_date);
        $this->end_date = date_create($end_date);
        $this->diff = date_diff($this->start_date, $this->end_date);
    }

    /**
     * Undocumented function
     *
     * @param DateTime $first_date
     * @param DateTime $second_date
     * @return string
     */
    public function differenceInDays()
    {
        return $this->diff->format("%a");
    }
}
