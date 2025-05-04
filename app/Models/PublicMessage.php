<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PublicMessage extends Model
{
    protected $table = 'public_messages';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'owner',
        'message',
        'created_at',
        'neighborhood',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

}
