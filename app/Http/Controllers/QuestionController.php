<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class QuestionController extends Controller
{

    public function index(Request $request, $id = null)
    {
        /** @var Question $question */
        $question = Question::query()
            ->where('id', '=', $id)
            ->first();

        $subjectId = $question->subject_id;

        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $subjectId)
            ->first();

        if ($subject->user_id !== $request->session()->get('user')->id) {
            throw new UnauthorizedException();
        }

        return $question;
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'subject_id' => ['required'],
            'question_text' => ['required'],
            'question_html' => ['required'],
            'responses' => ['required'],
            'correct_response' => ['required'],
            'explanation_html' => ['required'],
            'tries' => ['required'],
            'success' => ['required'],
            'ratio' => ['required']
        ]);

        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $data['subject_id'])
            ->first();

        if ($subject->user_id !== $request->session()->get('user')->id) {
            throw new UnauthorizedException();
        }

        $question = new Question();

        $question->subject_id = $subject->id;
        $question->question_text = $data['question_text'];
        $question->question_html = $data['question_html'];
        $question->responses = $data['responses'];
        $question->correct_response = $data['correct_response'];
        $question->explanation_html = $data['explanation_html'];
        $question->tries = $data['tries'];
        $question->success = $data['success'];
        $question->ratio = $data['ratio'];

        $question->save();

        return $question;
    }

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'question_text' => ['required'],
            'question_html' => ['required'],
            'responses' => ['required'],
            'correct_response' => ['required'],
            'explanation_html' => ['required'],
            'tries' => ['required'],
            'success' => ['required'],
            'ratio' => ['required']
        ]);

        /** @var Question $question */
        $question = Question::query()
            ->where('id', '=', $id)
            ->first();

        $subjectId = $question->subject_id;

        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $subjectId)
            ->first();

        if ($subject->user_id !== $request->session()->get('user')->id) {
            throw new UnauthorizedException();
        }

        $question->question_text = $data['question_text'];
        $question->question_html = $data['question_html'];
        $question->responses = $data['responses'];
        $question->correct_response = $data['correct_response'];
        $question->explanation_html = $data['explanation_html'];
        $question->tries = $data['tries'];
        $question->success = $data['success'];
        $question->ratio = $data['ratio'];

        $question->save();

        return $question;
    }

    public function delete(Request $request, int $id)
    {
        /** @var Question $question */
        $question = Question::query()
            ->where('id', '=', $id)
            ->first();

        $subjectId = $question->subject_id;

        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $subjectId)
            ->first();

        if ($subject->user_id !== $request->session()->get('user')->id) {
            throw new UnauthorizedException();
        }

        $question->delete();

        return [];
    }

    public function actionGetNextQuestion(Request $request, ?int $subjectId = null)
    {
        $userId = $request->session()->get('user')->id;

        $questionQuery = Question::query()
            ->join('subjects', 'subjects.user_id', '=', $userId);

        if (!is_null($subjectId)) {
            $questionQuery = $questionQuery->where('subject_id', '=', $subjectId);
        }

        /** @var Question $question */
        $question = $questionQuery->where('updated_at', '<', time() - 3600)
        ->orderBy('ratio')->first();

        return $question;
    }
}
