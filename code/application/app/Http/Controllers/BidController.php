<?php

namespace App\Http\Controllers;

use App\Events\BidCreated;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pusher\Pusher;

class BidController extends Controller
{
    public function store(Request $request, $id)
    {

        $auction = Auction::find($id);
        if (!$auction) {
            return Redirect::route('auctions.index');
        }

        $request->validate([
            'price' => 'required',
        ]);

        //price must be bigger than last bidder
        if ($auction->bids->count() > 0) {
            $lastBid = $auction->bids->first();
            if ($request->price <= $lastBid->price) {
                return response()->json([
                    'message' => 'Bid must be higher than the last bid',
                ], 422);
            }
        }

        $auction->bids()->create([
            'price' => $request->price,
            'user_id' => Auth::id(),
            'auction_id' => $auction->id,
            'is_winner' => false,
        ]);

        //debug the event with name bid.created
        $this->sendToPusher('auctions.' . $auction->id, 'bid.created', [
            'amount' => $request->price,
            'user' => Auth::user(),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'user_id' => Auth::id(),
        ]);

        //return json
        return response()->json([
            'message' => 'Bid placed successfully',
        ]);
    }


    function sendToPusher($channel, $event, $data)
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger($channel, $event, $data);
    }
}
