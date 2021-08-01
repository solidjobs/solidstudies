import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";

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
}
