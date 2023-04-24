<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Chat_user;
use App\Models\Chat_message;
use App\Models\users_messages;


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
            'last_name' => empty($fields['lastName']) ? null : $fields['lastName'],
            'age' => empty($fields['age']) ? null : $fields['age'],
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


    public function getUsersById($id)
    {
        $user = Chat_user::where('id', $id)
            ->get();
        return response($user, 200);
    }


    public function postMessage(Request $request)
    {
        $fields = $request->validate([
            'description' => 'required|string',
            'image' => 'string',
            'sender_id' => 'required|int',
            'receiver_id' => 'required|int'
        ]);
        $message = Chat_message::create([
            'description' => $fields['description'],
            'image' => empty($fields['image']) ? null : $fields['image']
        ]);

        $user_message = users_messages::create([
            'message_id' => $message['id'],
            'sender_id' => $fields['sender_id'],
            'receiver_id' => $fields['receiver_id']
        ]);
        return response($user_message, 201);
    }

    public function getRecentMessages($user_one_id, $user_two_id)
    {
        $messages = users_messages::
            where(function ($query) use ($user_one_id, $user_two_id) {

                $query->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())
                    ->where('sender_id', $user_one_id)
                    ->where('receiver_id', $user_two_id);
            })
            ->orWhere(function ($query) use ($user_one_id, $user_two_id) {
                $query->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())
                    ->where('sender_id', $user_two_id)
                    ->where('receiver_id', $user_one_id);
            })
            ->orderBy('created_at')
            ->get();


        return response($messages, 200);
    }

    public function getMessages()
    {
        $arrMessages = Chat_message::all();
        return response($arrMessages, 200);
    }
}