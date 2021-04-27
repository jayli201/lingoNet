import { Component, OnInit } from '@angular/core';
import { Card } from '../card';
import { CardService } from '../card.service';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-friends',
  templateUrl: './friends.component.html',
  styleUrls: ['./friends.component.css']
})
export class FriendsComponent implements OnInit {

  pendingCards: Array<Card> = [];
  incomingCards: Array<Card> = [];
  acceptedCards: Array<Card> = [];

  constructor(private cardService: CardService) {
  }
        
  ngOnInit() {
    this.getAllCards();
  }

  getAllCards(): void {
    this.cardService.getAllPending().subscribe(
      (res: Card[]) => {
        console.log(res);
        this.pendingCards = res;
      }
    );
    this.cardService.getAllIncoming().subscribe(
      (res: Card[]) => {
        console.log(res);
        this.incomingCards = res;
      }
    );
    this.cardService.getAllAccepted().subscribe(
      (res: Card[]) => {
        console.log(res);
        this.acceptedCards = res;
      }
    );
  }
}
