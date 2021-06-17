<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Odorant extends Model
{
    use HasFactory;

    protected $table = 'odorant';

    public function subOdors(): BelongsToMany
    {
        return $this->belongsToMany(Receptor::class, 'odorant_sub_odors', 'odorant_id', 'subodor_id');
    }

    public function receptors(): BelongsToMany
    {
        return $this->belongsToMany(Receptor::class, 'receptor_odorants', 'odorant_id', 'receptor_id');
    }

    public function functionalGroups(): BelongsToMany
    {
        return $this->belongsToMany(FunctionalGroup::class, 'functional_group_odorants', 'odorant_id', 'functionalgroup_id');
    }
}
