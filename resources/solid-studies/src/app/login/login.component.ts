import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginGroup: FormGroup;

  constructor(private formBuilder: FormBuilder) {
    this.loginGroup = this.formBuilder.group({
      mail: ['', Validators.email],
      password: ['', Validators.required]
    });
  }

  ngOnInit() {
  }

  onSubmitEventHandler() {
    console.log('@todo');
  }
}
