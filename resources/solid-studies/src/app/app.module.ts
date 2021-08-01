import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatCardModule} from "@angular/material/card";
import {ReactiveFormsModule} from "@angular/forms";
import {MatFormFieldModule} from "@angular/material/form-field";
import {MatInputModule} from "@angular/material/input";
import {MatButtonModule} from "@angular/material/button";
import {HttpClientModule} from "@angular/common/http";
import {LoginService} from "./_Services/login.service";
import {MatProgressSpinnerModule} from "@angular/material/progress-spinner";
import { SubjectsComponent } from './subjects/subjects.component';
import { SubjectComponent } from './subject/subject.component';
import {MatDividerModule} from "@angular/material/divider";
import { SubjectAddQuestionComponent } from './subject/subject-add-question/subject-add-question.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SubjectsComponent,
    SubjectComponent,
    SubjectAddQuestionComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatCardModule,
    ReactiveFormsModule,
    MatFormFieldModule,
    MatInputModule,
    MatButtonModule,
    HttpClientModule,
    MatProgressSpinnerModule,
    MatDividerModule
  ],
  providers: [
    LoginService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
