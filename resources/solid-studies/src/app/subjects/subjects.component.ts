import { Component, OnInit } from '@angular/core';
import {SubjectService} from "../_Services/subject.service";
import {Router} from "@angular/router";

interface SubjectElement {
  id: number,
  name: string,
  created_at: string,
  updated_at: string,
  user_id: number
}

@Component({
  selector: 'app-subjects',
  templateUrl: './subjects.component.html',
  styleUrls: ['./subjects.component.scss']
})
export class SubjectsComponent implements OnInit {

  loading = false;
  subjects: SubjectElement[] = [];

  constructor(
    private subjectService: SubjectService,
    private route: Router
  ) { }

  ngOnInit() {
    this.loadSubjectList();
  }

  navigateToSubject(id: number) {
    this.route.navigate(['/subject/' + id]);
  }

  loadSubjectList() {
    this.loading = true;
    this.subjectService.getSubjectList().subscribe(
      (ok) => {
        this.subjects = ok;
        this.loading = false;
      },
      (ko) => {
        console.log('An error happened loading the subjects', ko);
        this.loading = false;
      }
    );
  }
}
