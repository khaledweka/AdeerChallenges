<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuctionController extends Controller
{

    //index
    public function index()
    {
        $auctions = Auction::paginate(25);
        return view('auctions.index', compact('auctions'));
    }

    //create
    public function create()
    {
        return view('auctions.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'ends_at' => 'required',
        ]);

        $auction = Auction::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'ends_at' => $request->ends_at,
            'user_id' => Auth::id(),
        ]);

        return Redirect::route('auctions.index');
    }

    //show
    public function show($id)
    {
        $auction = Auction::with('bids.user')->find($id);
        return view('auctions.show', compact('auction'));
    }



}
