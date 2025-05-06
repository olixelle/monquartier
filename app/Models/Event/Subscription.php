<?php

namespace App\Models\Event;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    protected $table = 'event_subscriptions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'event',
        'user'
    ];


    public function subscriber(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

}
