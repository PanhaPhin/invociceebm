<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotations';

    protected $fillable = [
        'client_id',
        'description',
        'rate',
        'date',
    ];

    // Optional: If you have a Client model and relationship
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
