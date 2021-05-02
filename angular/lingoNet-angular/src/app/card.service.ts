import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

import { Card } from './card';

@Injectable({
  providedIn: 'root'
})
export class CardService {

  baseUrl = 'http://localhost/cs4640/lingonet/angular/data';
  cards: Card[];

  constructor(private http: HttpClient) { this.cards=[]; }

  getAllPending(data: any): Observable<any[]> {
    return this.http.post<any>(this.baseUrl + '/request_pending.php', data);
  }

  getAllIncoming(data: any): Observable<any[]> {
    return this.http.post<any>(this.baseUrl + '/request_incoming.php', data);
  }

  getAllAccepted(data: any): Observable<any[]> {
    return this.http.post<any>(this.baseUrl + '/request_accepted.php', data);
  }

  getMoreInfo(data: any): Observable<any> {
    return this.http.get<any>(this.baseUrl + '/request_more_info.php?cardEmail=' + data);
  }

  acceptFriend(data: any): Observable<any> {
    return this.http.post<any>(this.baseUrl + '/request_accept_friend.php', {email: data.email, friendEmail: data.friendEmail});
  }

  removeFriend(data: any): Observable<any> {
    console.log('data', data);
    return this.http.post<any>(this.baseUrl + '/request_remove_friend.php', {email: data.email, friendEmail: data.friendEmail});
  }
}
