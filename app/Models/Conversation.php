<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversation extends Model
{
    protected $table = 'conversations';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'from',
        'to',
        'messages_count'
    ];

    public function fromUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function toUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'to');
    }

}
