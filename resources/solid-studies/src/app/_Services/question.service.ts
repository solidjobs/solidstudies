import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Question} from "../_Structures/Question";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";

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
}
