<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    use HasFactory;

    //fillable property - declare which props can be mass assigned
    protected $fillable = [
      'message',
    ];

    protected $dispatchesEvents = [
      'created' => ChirpCreated::class,
    ];



}
