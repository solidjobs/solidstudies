<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject();

        $subject->name = 'Maths';
        $subject->user_id = 1;
        $subject->setCreatedAt(time());

        $subject->save();

        $subject = new Subject();

        $subject->name = 'Physics';
        $subject->user_id = 1;
        $subject->setCreatedAt(time());

        $subject->save();
    }
}
