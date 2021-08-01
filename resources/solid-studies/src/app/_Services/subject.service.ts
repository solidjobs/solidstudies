import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";
import {Subject} from "../_Structures/Subject";
import {map} from "rxjs/operators";
import {Question} from "../_Structures/Question";

@Injectable({
  providedIn: 'root'
})
export class SubjectService {

  constructor(private http: HttpClient) { }

  getSubjectList(): Observable<any> {
    return this.http.get(environment.apiUrl + '/subject', {
      headers: {token: localStorage.getItem(environment.sessionKey)}
    });
  }

  getSubjectDetail(id: number): Observable<Subject> {
    return this.http.get(environment.apiUrl + '/subject/' + id, {
      headers: {token: localStorage.getItem(environment.sessionKey)}
    }).pipe(map( (value: any) => {
      const subject = new Subject();

      subject.id = value.id;
      subject.name = value.name;
      subject.created_at = value.created_at;
      subject.user_id = value.user_id;

      for (let question of value.questions) {
        const questionObject = new Question();

        questionObject.id = question.id;
        questionObject.created_at = question.created_at;
        questionObject.updated_at = question.updated_at;
        questionObject.subject_id = question.subject_id;
        questionObject.question_text = question.question_text;
        questionObject.question_html = question.question_html;
        questionObject.responses = JSON.parse(question.responses);
        questionObject.correct_response = question.correct_response;
        questionObject.explanation_html = question.explanation_html;
        questionObject.tries = question.tries;
        questionObject.success = question.success;
        questionObject.ratio = question.ratio;

        subject.questions.push(questionObject);
      }

      return subject;
    }));
  }
}
