<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Returns index view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("index");
    }
}
