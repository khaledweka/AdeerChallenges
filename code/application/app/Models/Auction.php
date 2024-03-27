<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    protected $table = 'auctions';

    protected $fillable = [
        'title',
        'description',
        'price',
        'ends_at',
        'user_id',
        'winner_id',
        'won_at',
        'paid_at',
    ];

    protected $casts = [
        'ends_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('price', 'desc');
    }

}
