<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Log;
use Illuminate\Support\Facades\Input as Input;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // register
        // Log::info('register pochetok');
        // Log::info($request);
        // Log::info($request->get('first_name')); // ti dava samo value
        // Log::info($request->only('first_name')); // ti dava cela niza so key value
        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->skype_id = $request->get('skype_id');
        $user->contact_number = $request->get('contact_number');

        if(Input::hasFile('profile_picture')){
            Log::info('has file');
            $file = Input::file('profile_picture');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = base64_encode($user->email) . "." . $extension;
            $file->move('uploads/profile_pictures', $filename);
            $user->profile_picture = $filename;
        }

        // proverka za email dali vekje ima (verojatno Eloquent sam kje vrati) imame staveno unique :)
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
