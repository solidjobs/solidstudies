import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {map} from "rxjs/operators";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(
    private http: HttpClient
  ) { }

  public attempt(email: string, password: string): Observable<any>
  {
    return this.http.post(environment.apiUrl + '/auth/login', {
      email,
      password
    }).pipe(map(event => this.mapAttempt(event)));
  }

  public mapAttempt(event) {
    return event;
  }
}
