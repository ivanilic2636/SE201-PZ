import { Component } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import {Router} from '@angular/router';

import 'rxjs/Rx';

@Component({
  selector: 'app-root',
  templateUrl: './template.html',

})
export class AppComponent {

  router: Router;
isAuth: String;
currentUrl : String;
 isAdmin: String;
 user: String;
constructor(router: Router) {
this.router = router;
this.currentUrl = '';
}
ngOnInit() {
this.router.events.subscribe(event => {
if(localStorage.getItem('token') !== null){
this.isAuth = "yes";
this.user = localStorage.getItem('user');
}else {
this.isAuth = "no";
}





});
}
onLogout(): void {
localStorage.removeItem("token");

this.router.navigate(['./']);
if(localStorage.getItem('token') !== null){
this.isAuth = "yes";
}else{
this.isAuth = "no";
}
}


}
