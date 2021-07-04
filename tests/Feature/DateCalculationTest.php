<?php

namespace Tests\Feature;

use App\Models\Date;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateCalculation extends TestCase
{
    use RefreshDatabase;

    private const START_DATE = "2021-07-04";

    private const END_DATE = "2021-07-11";

    /**
     * Test if start date is missing
     *
     * @test
     */
    public function throwErrorIfStartDateFieldIsEmpty()
    {
        $data = [
            "end_date" => self::END_DATE,
        ];

        $this->postJson("api/days", $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(["start_date"]);
    }

    /**
     * Test if start date is missing
     *
     * @test
     */
    public function throwErrorIfEndDateFieldIsEmpty()
    {
        $data = [
            "start_date" => self::START_DATE,
        ];

        $this->postJson("api/days", $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(["end_date"]);
    }

    /**
     * Test if start date is not a valid date string
     *
     * @test
     */
    public function throwErrorIfStartDateFieldIsNotADateString()
    {
        $data = [
            "start_date" => "some random string",
            "end_date" => self::END_DATE,
        ];

        $this->postJson("api/days", $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                "start_date" => "The start date is not a valid date.",
            ]);
    }

    /**
     * Test if start date is not a valid date string
     *
     * @test
     */
    public function throwErrorIfEndDateFieldIsNotADateString()
    {
        $data = [
            "start_date" => self::START_DATE,
            "end_date" => "some random string",
        ];

        $this->postJson("api/days", $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                "end_date" => "The end date is not a valid date.",
            ]);
    }

    /**
     * Test if a user can post to endpoint, store result in database
     * and return valid json
     *
     * @test
     */
    public function canCreateAndStoreADateResultAndReturnJson()
    {
        $data = [
            "start_date" => self::START_DATE,
            "end_date" => self::END_DATE,
        ];

        $response = $this->postJson("api/days", $data);

        $response->assertStatus(201)->assertJsonFragment([
            "id" => 1,
            "result" => 7,
            "start_date" => self::START_DATE,
            "end_date" => self::END_DATE,
        ]);

        $this->assertDatabaseCount(Date::class, 1);
    }
}
