import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubjectAddQuestionComponent } from './subject-add-question.component';

describe('SubjectAddQuestionComponent', () => {
  let component: SubjectAddQuestionComponent;
  let fixture: ComponentFixture<SubjectAddQuestionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubjectAddQuestionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubjectAddQuestionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
