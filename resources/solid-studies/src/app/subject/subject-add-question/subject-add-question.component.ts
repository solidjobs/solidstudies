import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-subject-add-question',
  templateUrl: './subject-add-question.component.html',
  styleUrls: ['./subject-add-question.component.scss']
})
export class SubjectAddQuestionComponent implements OnInit {

  @Input() private subjectId: number;

  questionForm: FormGroup;
  responses: any;

  constructor(private formBuilder: FormBuilder) {}

  ngOnInit() {
    this.initialize();
  }

  initialize() {
    this.responses = [];
    this.questionForm = this.formBuilder.group({
      question: ['', Validators.required]
    });
  }

  addResponse() {
    const responseSelector = 'response_' + this.responses.length;
    this.responses.push(responseSelector);
    this.questionForm.controls[responseSelector] = new FormControl();
  }

  saveQuestion() {
    this.questionForm.reset();
    this.initialize()
  }

}
