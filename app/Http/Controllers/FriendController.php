<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::where('user_id', Auth::user()->id)->get();
        return view('friend.index', ['friends' => $friends]);
    }

    public function findFriend()
    {

        $notfriends = User::whereNotIn('id', function ($query) {
            $query->select('friend_id')
                ->from('friends')
                ->where('user_id', Auth::user()->id);
        })
            ->whereNotIn('id', function ($query) {
                $query->select('sender_id')
                    ->from('friend_requests')
                    ->where('receiver_id', Auth::user()->id);
            })->whereNotIn('id', function ($query) {
                $query->select('receiver_id')
                    ->from('friend_requests')
                    ->where('sender_id', Auth::user()->id);
            })
            ->where('id', '!=', Auth::user()->id)
            ->get();

        $invitedfriends = FriendRequest::where('sender_id', Auth::user()->id)
            ->where('status', 'Pending')->get();

        return view('friend.find', ['notfriends' => $notfriends, 'invitedfriends' => $invitedfriends]);
    }
    public function inviteFriend($id)
    {
        FriendRequest::Create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $id,
            'status' => 'Pending'
        ]);

        return redirect(route('friends.findFriend'))
            ->with('success', 'Friend Successfully Invited');
    }
}
