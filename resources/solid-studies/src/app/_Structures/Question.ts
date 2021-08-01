export class Question {
  public id: number;
  public created_at: string;
  public updated_at: string;
  public subject_id: number;
  public question_text: string;
  public question_html: string;
  public responses = [];
  public correct_response: number;
  public explanation_html: string;
  public tries: number;
  public success: number;
  public ratio: number;
}
