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
  href: string = "";
  email: string = "";

  constructor(private cardService: CardService) {
  }
        
  ngOnInit() {
    this.getAllCards();

    // https://stackoverflow.com/questions/45184969/get-current-url-in-angular
    this.href = window.location.href;
    this.email = this.href.slice(29,);
    console.log(this.email);
  }

  getAllCards(): void {
    this.cardService.getAllPending(this.email).subscribe(
      (res: Card[]) => {
        console.log("pending", res);
        this.pendingCards = res;
      }
    );
    this.cardService.getAllIncoming(this.email).subscribe(
      (res: Card[]) => {
        console.log("incoming", res);
        this.incomingCards = res;
      }
    );
    this.cardService.getAllAccepted(this.email).subscribe(
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

  onAcceptFriend(form: any): void {
    console.log('You submitted:', form);

    this.cardService.acceptFriend(form)
    .subscribe((response) => {
      console.log('Response:', response);
    }, (error_in_comm) => {
      console.log('Error:', error_in_comm);
    });
  }

  onRemoveFriend(form: any): void {
    console.log('You submitted:', form);

    this.cardService.removeFriend(form)
    .subscribe((response) => {
      console.log('Response:', response);
    }, (error_in_comm) => {
      console.log('Error:', error_in_comm);
    });
  }

  reloadPage() {
    console.log("reload");
    window.location.reload();
  }
}
