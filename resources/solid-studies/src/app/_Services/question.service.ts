import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Question} from "../_Structures/Question";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";
import {map} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class QuestionService {

  constructor(private http: HttpClient) { }

  createQuestion(question: Question): Observable<any> {
    let questionObject: any = question;

    questionObject.responses = JSON.stringify(question.responses);
    return this.http.post(environment.apiUrl + '/question', questionObject,
      {
        headers: {token: localStorage.getItem(environment.sessionKey)}
      });
  }

  getNextQuestion(subjectId?: number): Observable<any> {
    let urlEnd = subjectId ? '/' + subjectId : '';
    return this.http.get(environment.apiUrl + '/question/nextQuestion' + urlEnd,
      {
        headers: {token: localStorage.getItem(environment.sessionKey)}
      })
      .pipe(map(question => this.mapQuestion(question)));
  }

  mapQuestion(rawQuestion: any): Question {
    let question = new Question();

    for (let property of Object.keys(rawQuestion)) {
      if (question.hasOwnProperty(property)) {
        question[property] = rawQuestion[property];
      }
    }

    question.responses = JSON.parse(rawQuestion.responses);

    return question;
  }

  answerQuestion(questionId: number, index: number): Observable<any> {
    return this.http.post(
      environment.apiUrl + '/question/answerQuestion/' + questionId,
      {index},
      { headers: {token: localStorage.getItem(environment.sessionKey)} }
      );
  }
}
