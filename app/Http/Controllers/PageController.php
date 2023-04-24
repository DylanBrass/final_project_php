<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat_user;
use App\Models\Chat_message;


class PageController extends Controller
{
    public function postUser(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'firstName' => 'string',
            'lastName' => 'string',
            'age' => 'string',
            'email' => 'string',
            'password' => 'required|string',
        ]);
        $user = Chat_user::create([
            'username' => $fields['username'],
            'first_name' => $fields['firstName'],
            'last_name' => $fields['lastName'],
            'age' => $fields['age'],
            'email' => $fields['email'],
            'password' => md5($fields['password'])
        ]);
        return response($user, 201);
    }


    public function getUsers()
    {
        $arrUsers = Chat_user::all();
        return response($arrUsers, 200);
    }






    public function postMessage(Request $request)
    {
        $fields = $request->validate([
            'desc' => 'required|string',
            'image' => 'string',
            'sender_id' => 'int',
            'receiver_id' => 'int'
        ]);
        $message = Chat_message::create([
            'description' => $fields['desc'],
            'image' => $fields['image'],
            'sender_id' => $fields['sender_id'],
            'receiver_id' => $fields['receiver_id']
        ]);
        return response($message, 201);
    }


    public function getMessages()
    {
        $arrMessages = Chat_message::all();
        return response($arrMessages, 200);
    }
}