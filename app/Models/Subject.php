<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

/**
 * Class Subject
 * @package App\Models
 *
 * @property string $name
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * @return HasMany|Collection|Question[]
     */
    public function questions()
    {
        return $this->hasMany('App\Question', 'subject_id');
    }
}
