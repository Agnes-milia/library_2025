<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lending extends Model
{
    /** @use HasFactory<\Database\Factories\LendingFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'copy_id',
        'start',
        "end",
        "extension",
        "notice"
    ];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('copy_id', '=', $this->getAttribute('copy_id'))
            ->where('start', '=', $this->getAttribute('start'));
        return $query;
    }

    public function toCopies(){
        return $this->belongsTo(Copy::class, "copy_id", "id");
    }
}
