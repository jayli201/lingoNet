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
    return this.http.get<any>(this.baseUrl + '/request_pending.php?email=' + data);
  }

  getAllIncoming(data: any): Observable<any[]> {
    return this.http.get<any>(this.baseUrl + '/request_incoming.php?email=' + data);
  }

  getAllAccepted(data: any): Observable<any[]> {
    return this.http.get<any>(this.baseUrl + '/request_accepted.php?email=' + data);
  }

  getMoreInfo(data: any): Observable<any> {
    return this.http.get<any>(this.baseUrl + '/request_more_info.php?cardEmail=' + data);
  }

  acceptFriend(data: any): Observable<any> {
    return this.http.get<any>(this.baseUrl + '/request_accept_friend.php?friendEmail=' + data);
  }

  removeFriend(data: any): Observable<any> {
    return this.http.get<any>(this.baseUrl + '/request_remove_friend.php?friendEmail=' + data);
  }
}
