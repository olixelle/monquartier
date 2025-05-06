<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'image',
        'owner',
        'neighborhood',
        'starts_at',
        'ends_at',
        'duration',
        'requires_reservation',
        'seats_total',
        'seats_available',
        'duration_unit',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasOne(Event\Subscription::class, 'id', 'event');
    }

}
