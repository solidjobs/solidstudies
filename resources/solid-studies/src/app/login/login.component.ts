import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {LoginService} from "../services/login.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginGroup: FormGroup;
  wrongCredentials = false;
  loading = false;
  success = false;
  error = false;

  constructor(
    private formBuilder: FormBuilder,
    private loginService: LoginService
  ) {
    this.loginGroup = this.formBuilder.group({
      mail: ['', Validators.email],
      password: ['', Validators.required]
    });
  }

  ngOnInit() {
  }

  onSubmitEventHandler() {
    this.wrongCredentials = false;
    this.loading = true;
    this.error = false;

    this.loginService.attempt(
      this.loginGroup.controls['mail'].value,
      this.loginGroup.controls['password'].value
      ).subscribe(
      (ok) => {
        console.log('Ok: ', ok);

        if (ok.hasOwnProperty('session')) {
          localStorage.setItem('solidstudies-session', ok.session);
          this.success = true;
        } else {
          this.error = true;
          this.loading = false;
        }
      },
      (ko) => {
        console.log('Error: ', ko)
        this.wrongCredentials = true;
        this.loading = false;
      }
    );
  }
}
