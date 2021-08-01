import { Component, OnInit } from '@angular/core';
import {SubjectService} from "../_Services/subject.service";
import {Subject} from "../_Structures/Subject";
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-subject',
  templateUrl: './subject.component.html',
  styleUrls: ['./subject.component.scss']
})
export class SubjectComponent implements OnInit {

  subject: Subject;
  error = false;

  constructor(
    private route: ActivatedRoute,
    private subjectService: SubjectService
              ) { }

  ngOnInit() {
    this.loadSubject();
  }

  loadSubject() {
    const id = Number(this.route.snapshot.paramMap.get('id'));

    this.subjectService.getSubjectDetail(id).subscribe(
      (ok) => {
        this.subject = ok;
      },
      (ko) => {
        console.log(ko);
        this.error = true;
      }
    );
  }

}
