<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Odor extends Model
{
    use HasFactory;

    protected $table = 'odor';

    public function subOdors(): BelongsToMany
    {
        return $this->belongsToMany(SubOdor::class, 'sub_odor_odors', 'odor_id', 'subodor_id');
    }
}
