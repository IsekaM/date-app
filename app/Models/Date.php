<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    /**
     * Columns that can be filled with data from user
     *
     * @var array
     */
    protected $fillable = ["result", "start_date", "end_date"];

    /**
     * Hidden columns
     *
     * @var array
     */
    // protected $hidden = ["ip_address"];

    /**
     * Validation rules for date fields
     */
    public const RULES = [
        "start_date" => "required|date",
        "end_date" => "required|date",
    ];
}
