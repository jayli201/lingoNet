import { Component, OnInit } from '@angular/core';
import { Card } from '../card';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http'

@Component({
  selector: 'app-friends',
  templateUrl: './friends.component.html',
  styleUrls: ['./friends.component.css']
})
export class FriendsComponent implements OnInit {

  // dependency injection
  // constructor(private http: HttpClient) { }
  constructor() { }

  ngOnInit(): void {
  }

  card = new Card('first', 'last', 'test@gmail.com', ['native1, native2, native3'], ['target1, target2']);



}
