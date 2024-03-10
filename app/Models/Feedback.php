<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'feedbacks';

    protected $fillable = [
        'name',
        'email',
        'message',
        'customer_id'
    ];
}
