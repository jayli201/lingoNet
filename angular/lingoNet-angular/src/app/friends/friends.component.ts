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
  constructor(private http: HttpClient) { }
  // constructor() { }

  ngOnInit(): void {
  }

  card = new Card('first', 'last', 'test@gmail.com', ['native1, native2, native3'], ['target1, target2']);

  data_submitted = '';
  confirm_msg = '';

  responsedata = new Card('', '', '', null, null);


  confirmOrder(data: any): void {
    console.log(data);
    
  }
  
  // passing in a form variable of type any, no return result
  onSubmit(form: any): void {
     console.log('You submitted value: ', form);
     this.data_submitted = form;

     // console.log(this.data_submitted, this.data_submitted.name.length);
    console.log('form submitted ', form);
    
    // prepare to send a request to the backend PHP
    // 1. convert the form data to JSON format
    let params = JSON.stringify(form);

    // 2. send an HTPP request to the backend
    // get request or post request

    // send a POST request
    // post<return_type>('url', data);
    // observable --> subscribe 
      // the observable doesn't execute the function until subscribed
    this.http.post<Card>('http://localhost/cs4640/angular/data/request-handler.php', params)
      .subscribe((response_from_php) => {
        // successful, use response in some way
        this.responsedata = response_from_php;
        console.log('response data', this.responsedata);
      }, (error_in_comm) => {
        // error occurs, handle it in some way
        console.log('Error occurs', error_in_comm);  
    })
  }

}
