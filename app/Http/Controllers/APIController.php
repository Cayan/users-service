<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class APIController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return \Response::json([]);
    }
}
