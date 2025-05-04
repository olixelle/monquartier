<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'owner',
        'neighborhood',
        'category',
        'type',
        'status',
        'price',
        'image',
        'description',

    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function relatedCategory(): HasOne
    {
        return $this->hasOne(OfferCategory::class, 'id', 'category');
    }

}
