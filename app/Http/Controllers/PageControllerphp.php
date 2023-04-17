<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageControllerphp extends Controller
{
    public function createUser(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'firstName' => 'string',
            'lastName' => 'string',
            'age' => 'string',
            'email' => 'string',
            'password' => 'required|string',

        ]);


        $user = chat_users::create([
            'username' => $fields['username'],
            'firstName' => $fields['firstName']
        ]);

        return response($user, 201);
    }
}