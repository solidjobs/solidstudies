<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = new Question();

        $question->subject_id = 1;
        $question->question_text = '2 + 2';
        $question->question_html = '<strong>2</strong> + <strong>2</strong>';
        $question->responses = json_encode([
            '4', '2', '5', '1'
        ], JSON_PRETTY_PRINT);
        $question->correct_response = 0;
        $question->explanation_html = '2 + 2 = 4 because 4 - 2 = 2';
        $question->tries = 0;
        $question->success = 0;
        $question->ratio = 0;

        $question->save();

        $question = new Question();

        $question->subject_id = 1;
        $question->question_text = '3 + 3';
        $question->question_html = '<strong>3</strong> + <strong>3</strong>';
        $question->responses = json_encode([
            '4', '6', '5', '1'
        ], JSON_PRETTY_PRINT);
        $question->correct_response = 1;
        $question->explanation_html = '3 + 3 = 6 because 6 - 3 = 3';
        $question->tries = 0;
        $question->success = 0;
        $question->ratio = 0;

        $question->save();

        $question = new Question();

        $question->subject_id = 2;
        $question->question_text = 'The gravity is a force?';
        $question->question_html = 'Is the gravity a force?';
        $question->responses = json_encode([
            'Yes', 'No'
        ], JSON_PRETTY_PRINT);
        $question->correct_response = 1;
        $question->explanation_html = 'Gravity is a force that causes acceleration.';
        $question->tries = 0;
        $question->success = 0;
        $question->ratio = 0;

        $question->save();
    }
}
