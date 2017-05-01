<?php


namespace App;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BelongsToOrNull extends BelongsTo
{
    public function getResults()
    {
        return $this->query->firstOrNew([]);
    }
}