<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Receptor extends Model
{
    use HasFactory;

    protected $table = 'receptor';

    public function interactingOdorants(): BelongsToMany
    {
        return $this->belongsToMany(Odorant::class, 'receptor_odorants', 'receptor_id', 'odorant_id');
    }
}
