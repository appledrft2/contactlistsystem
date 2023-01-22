<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function index()
    {
        $friendRequests = FriendRequest::where('receiver_id', Auth::user()->id)->where('status', 'Pending')->get();
        return view('friend.request', ['friendRequests' => $friendRequests]);
    }
    public function friendRequestsCount()
    {
        $friendRequestsCount = FriendRequest::where('receiver_id', Auth::user()->id)->where('status', 'Pending')->count();
        return response()->json([
            'friendRequestsCount' => $friendRequestsCount
        ]);
    }
    public function acceptRequest($id)
    {

        $friendRequest = FriendRequest::where('receiver_id', Auth::user()->id)
            ->where('sender_id', $id)->first();

        $friendRequest->update(['status' => 'Accepted']);
        // Make a record for logged in user's 'friend list'
        Friend::Create([
            'user_id' => Auth::user()->id,
            'friend_id' => $id
        ]);
        // Make a record for his friends 'friend list'
        Friend::Create([
            'friend_id' => Auth::user()->id,
            'user_id' => $id
        ]);

        return redirect(route('friendRequests.index'))
            ->with('success', 'Friend Request Successfully Accepted');
    }
    public function denyRequest($id)
    {
        $friendRequest = FriendRequest::findOrFail($id);
        $friendRequest->delete();

        return redirect(route('friendRequests.index'))
            ->with('success', 'Friend Request Was Denied');
    }
}
