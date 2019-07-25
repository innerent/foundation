<?php

namespace Innerent\Foundation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description', 'number', 'dispatcher', 'state', 'country', 'entity_type', 'entity_id'
    ];

    public function hasLegalDocument()
    {
        return $this->morphTo();
    }
}
