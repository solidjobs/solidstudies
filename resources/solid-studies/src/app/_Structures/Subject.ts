import {Question} from "./Question";

export class Subject {
  public id: number;
  public name: string;
  public created_at: string;
  public updated_at: string;
  public user_id: number;
  public questions: Question[] = [];
}
