import { Component, OnInit } from '@angular/core';
import { Card } from '../card';
import { Info } from '../info';
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
        console.log("pending", res);
        this.pendingCards = res;
      }
    );
    this.cardService.getAllIncoming().subscribe(
      (res: Card[]) => {
        console.log("incoming", res);
        this.incomingCards = res;
      }
    );
    this.cardService.getAllAccepted().subscribe(
      (res: Card[]) => {
        console.log("accepted", res);
        this.acceptedCards = res;
      }
    );
  }

  moreInfo = new Info("", "", "", "");

  onSubmit(form: any): void {
    console.log('You submitted:', form);

    this.cardService.getMoreInfo(form)
    .subscribe((response) => {
      console.log('Response:', response);
      if (response.length  == 0) {
        this.moreInfo = new Info("", "", "", "");
      } else {
        this.moreInfo = new Info(response[0].email, response[0].introduction, response[0].whyYou, response[0].lookingFor);
      }
      console.log('More info:', this.moreInfo);
    }, (error_in_comm) => {
      console.log('Error:', error_in_comm);
    });
  }

  card = new Card("", "", "", "", "", "", null, null);

  onAcceptFriend(form: any): void {
    console.log('You submitted:', form);

    this.cardService.acceptFriend(form)
    .subscribe((response) => {
      console.log('Response:', response);
      console.log("here");
      if (response.length  == 0) {
        this.card = this.card;
      } else {
        this.card = new Card(response[0].firstName, response[0].lastName, response[0].email, response[0].friendEmail, response[0].cardEmail, response[0].phone, response[0].natives, response[0].targets);
      }
      console.log('Card:', this.card);
    }, (error_in_comm) => {
      console.log('Error:', error_in_comm);
    });
  }

  onRemoveFriend(form: any): void {
    console.log('You submitted:', form);

    this.cardService.removeFriend(form)
    .subscribe((response) => {
      console.log('Response:', response);
      console.log("here");
    }, (error_in_comm) => {
      console.log('Error:', error_in_comm);
    });
  }

  reloadPage() {
    console.log("reload");
    window.location.reload();
  }
}
