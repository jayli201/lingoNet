import { Component } from '@angular/core';
import { Card } from './card';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'LingoNet';

  card = new Card('first', 'last', 'test@gmail.com', ['native1, native2, native3'], ['target1, target2']);
}

