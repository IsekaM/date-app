<?php

namespace App\Http\Controllers;

use App\Models\Date;
use Illuminate\Http\Request;
use App\Helpers\Classes\Dioxide;
use App\Http\Requests\DateRequest;
use App\Repository\DateRepository;

class DateController extends Controller
{
    /**
     * Service variable
     *
     * @var \App\Repository\DateRepository
     */
    private $service;

    /**
     * Constructor 🤷‍♂️
     *
     * @param DateRepository $service
     */
    public function __construct(DateRepository $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DateRequest $request)
    {
        $result = $this->service->getResult();

        return response()->json($result);
    }
}
