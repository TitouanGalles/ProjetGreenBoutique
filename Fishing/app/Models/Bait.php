<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bait extends Model
{
    use HasFactory;

    protected $table = 'Leurre';

    protected $fillable = [
        'Id',
        'nom',
        'descriptif',
        'prix',
        'nomImg'
    ];

    protected $primaryKey = 'Id';

    public $incrementing = false;

    protected $keyType = 'int';
}
