<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param null $id
     * @return array
     */
    public function index(Request $request, $id = null)
    {
        if (is_null($id)) {
            $out = Subject::query()
                ->where('user_id', $request->session()->get('user')->id)
                ->get()->toArray();
        } else {
            $out = Subject::query()
                ->where('id', $id)
                ->with('questions')
            ->first()->toArray();
        }

        return $out;
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);

        $subject = new Subject();

        $subject->name = $data['name'];
        $subject->setCreatedAt(time());
        $subject->user_id = $request->session()->get('user')->id;

        $subject->save();

        return $subject;
    }

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);

        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', $request->session()->get('user')->id)
            ->first();

        $subject->name = $data['name'];

        $subject->save();

        return $subject;
    }

    public function delete(Request $request, int $id)
    {
        /** @var Subject $subject */
        $subject = Subject::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', $request->session()->get('user')->id)
            ->first();

        $subject->delete();

        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
