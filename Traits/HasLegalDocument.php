<?php

namespace Innerent\Foundation\Traits;

use Innerent\Foundation\Entities\LegalDocument;

trait HasLegalDocument
{
    public function legalDocuments()
    {
        return $this->morphMany(LegalDocument::class, 'hasLegalDocuments', 'entity_type', 'entity_id');
    }
}
