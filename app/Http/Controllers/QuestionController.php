<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'explanation_html' => ['required']
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
        $question->tries = 0;
        $question->success = 0;
        $question->ratio = 0;

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

    public function actionNextQuestion(Request $request, int $subjectId = null)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            throw new UnauthorizedException();
        }

        $questionQuery = Question::query()->select([
            'questions.id as id', 'question_html', 'question_text', 'correct_response',
            'responses', 'subject_id', 'ratio', 'success', 'tries', 'explanation_html',
            'questions.created_at as created_at', 'questions.updated_at as updated_at'
        ])
            ->join('subjects', 'subjects.id', '=', 'questions.subject_id');

        if (!is_null($subjectId)) {
            $questionQuery = $questionQuery->where('questions.subject_id', '=', $subjectId);
        }

        /** @var Question $question */
        $question = $questionQuery
            ->where('subjects.user_id', '=', $user->id)
            ->where('questions.updated_at', '<', Carbon::now('UTC')->subMinutes(30))
            ->orderBy('questions.ratio')
            ->first();

        if (!$question) {
            throw new NotFoundHttpException();
        }

        return $question;
    }

    public function actionAnswerQuestion(Request $request, int $questionId)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            throw new UnauthorizedException();
        }

        $data = $request->validate([
            'index' => ['required', 'integer']
        ]);

        /** @var Question $question */
        $question = Question::query()->where('id', '=', $questionId)->first();

        /** @var Subject $subject */
        $subject = Subject::query()->where('id', '=', $question->subject_id)->first();

        if ($subject->user_id != $user->id) {
            throw new UnauthorizedException();
        }

        /** @var int $responseIndex */
        $responseIndex = $data['index'];
        $responseIsCorrect = $question->correct_response == $responseIndex;

        $question->tries += 1;

        if ($responseIsCorrect) {
            $question->success += 1;
        }

        $question->ratio = (int) (($question->success / $question->tries) * 1000);
        $question->updateTimestamps();

        $question->save();

        return [
            'question' => $question,
            'success' => $responseIsCorrect
        ];
    }
}
