<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Question
 * @package App\Models
 *
 * @property Subject $subject
 * @property int $subject_id
 * @property string $question_text
 * @property string $question_html
 * @property string $responses
 * @property int $correct_response
 * @property string $explanation_html
 * @property int $tries
 * @property int $success
 * @property int $ratio
 */
class Question extends Model
{
    use HasFactory;

    /**
     * @return HasOne|Subject
     */
    public function subject()
    {
        return $this->hasOne('App\Subject');
    }
}
