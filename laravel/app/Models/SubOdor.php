<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubOdor extends Model
{
    use HasFactory;

    protected $table = 'sub_odor';

    public function odors(): BelongsToMany
    {
        return $this->belongsToMany(Odor::class, 'sub_odor_odors', 'sub_odor_id', 'odor_id');
    }
}
