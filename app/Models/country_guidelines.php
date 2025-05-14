<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\country;

class country_guidelines extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Get the user that owns the country_guidelines
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guidelines_to_country()
    {
        return $this->belongsTo(country::class, 'country_id');
    }
}
