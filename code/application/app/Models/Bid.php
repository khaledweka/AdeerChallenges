<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bid extends Model
{

    protected $table = 'auctions_bids';

    protected $fillable = [
        'price',
        'user_id',
        'auction_id',
        'is_winner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
