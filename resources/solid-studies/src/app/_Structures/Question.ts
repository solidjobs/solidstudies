export class Question {
  public id?: number = null;
  public created_at?: string = null;
  public updated_at?: string = null;
  public subject_id?: number = null;
  public question_text?: string = null;
  public question_html?: string = null;
  public responses = [];
  public correct_response?: number = null;
  public explanation_html?: string = null;
  public tries?: number = null;
  public success?: number = null;
  public ratio?: number = null;
}
