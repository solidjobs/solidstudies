import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {QuestionService} from "../../_Services/question.service";
import {Question} from "../../_Structures/Question";

@Component({
  selector: 'app-subject-add-question',
  templateUrl: './subject-add-question.component.html',
  styleUrls: ['./subject-add-question.component.scss']
})
export class SubjectAddQuestionComponent implements OnInit {

  @Input() private subjectId: number;

  loading = false;
  error = false;
  questionForm: FormGroup;
  responses: any;

  constructor(
    private formBuilder: FormBuilder,
    private questionService: QuestionService
              ) {}

  ngOnInit() {
    this.initialize();
  }

  initialize() {
    this.responses = [];
    this.questionForm = this.formBuilder.group({
      question: ['', Validators.required],
      correct: ['', Validators.required],
      explanation: ['', Validators.required],
    });
  }

  addResponse() {
    const responseSelector = 'response_' + this.responses.length;
    this.responses.push(responseSelector);
    this.questionForm.controls[responseSelector] = new FormControl();
  }

  saveQuestion() {
    this.loading = true;

    const question = new Question();

    question.subject_id = this.subjectId;
    question.question_text = this.questionForm.controls['question'].value;
    question.question_html = question.question_text;
    question.correct_response = this.questionForm.controls['correct'].value;

    for (let response of this.responses) {
      question.responses.push(this.questionForm.controls[response].value);
    }

    question.explanation_html = this.questionForm.controls['explanation'].value;

    this.questionService.createQuestion(question).subscribe(
      (ok) => {
        this.questionForm.reset();
        this.initialize();
        this.loading = false;
      },
      (ko) => {
        console.log(ko);
        this.loading = false;
      }
    );
  }

}
