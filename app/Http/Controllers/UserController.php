<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use \Illuminate\Http;
use App\User;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function options()
    {
        return response(null, Http\Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @param Requests\User\Index $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Requests\User\Index $request)
    {
        return response(User::all());
    }

    /**
     * @param Requests\User\Create $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Requests\User\Create $request)
    {
        User::Create($request->all());

        return response(null, Http\Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Requests\User\Read $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function read(Requests\User\Read $request)
    {
        $user = User::where($request->all())->first();

        return response($user);
    }

    /**
     * @param Requests\User\Update $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Requests\User\Update $request)
    {
        $user = User::find($request->input('id'));
        $user->fill($request->all());
        $user->save();

        return response(null, Http\Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Requests\User\Delete $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Requests\User\Delete $request)
    {
        $user = User::where($request->all())->first();
        $user->delete();

        return response(null, Http\Response::HTTP_NO_CONTENT);
    }
}