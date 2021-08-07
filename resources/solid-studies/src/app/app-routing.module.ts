import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {LoginComponent} from "./login/login.component";
import {SubjectsComponent} from "./subjects/subjects.component";
import {SubjectComponent} from "./subject/subject.component";
import {StudyComponent} from "./study/study.component";


const routes: Routes = [
  { path: '', redirectTo: '/login', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'subjects', component: SubjectsComponent },
  { path: 'subject/:id', component: SubjectComponent },
  { path: 'study/:subjectId', component: StudyComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
