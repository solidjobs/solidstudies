<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Collection\Collection;

/**
 * Class Subject
 * @package App\Models
 *
 * @property string $name
 * @property User $user
 * @property int $user_id
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * @return HasMany|Collection|Question[]
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'subject_id');
    }

    /**
     * @return HasOne|User
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function(Subject $subject) {
            $subject->questions()->delete();
        });
    }
}
