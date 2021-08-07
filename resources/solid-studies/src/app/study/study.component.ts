import { Component, OnInit } from '@angular/core';
import {QuestionService} from "../_Services/question.service";
import {Question} from "../_Structures/Question";

@Component({
  selector: 'app-study',
  templateUrl: './study.component.html',
  styleUrls: ['./study.component.scss']
})
export class StudyComponent implements OnInit {

  loading = true;
  answer = null;
  correctAnswer = null;
  currentQuestion: Question;
  notFound = false;

  constructor(private questionService: QuestionService) { }

  ngOnInit() {
    this.loadQuestion();
  }

  loadQuestion() {
    this.loading = true;
    this.answer = null;
    this.correctAnswer = null;
    this.notFound = false;

    this.questionService.getNextQuestion(1).subscribe(
      (question: Question) => {
        this.currentQuestion = question;
        console.log(this.currentQuestion);
        this.loading = false;
      },
      (error: any) => {
        console.log('error', error);
        this.notFound = true;
      }
    )
  }

  getColorByAnswerIndex(index: number): string {
    let color = 'inherit';

    if (index === this.answer) {
      color = 'orange';

      if (this.correctAnswer !== null) {
        color = 'red';
      }
    }

    if (index === this.correctAnswer) {
      color = 'green';
    }

    return color;
  }

  onClickResponse(index: number) {
    if (this.answer === null) {
      this.answer = index;
      this.correctAnswer = this.currentQuestion.correct_response;

      /**
       * @todo http request
       */
      this.questionService.answerQuestion(this.currentQuestion.id, index).subscribe(
        (response: any) => {
          // saved
        },
        (error) => {
          alert('La pregunta no pudo guardarse');
        }
      )
    }
  }

  onClickNext() {
    this.loadQuestion();
  }
}
