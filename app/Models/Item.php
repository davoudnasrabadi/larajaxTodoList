<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id'
    ];
    public function user(){
        return $this->belogsTo(User::class);
    }
}
