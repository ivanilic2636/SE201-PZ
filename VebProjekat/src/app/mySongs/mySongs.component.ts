import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'MySongsComponent',
  templateUrl: './mySongs.html'
})

export class MySongsComponent{
    http: Http;
    router: Router;
    route: ActivatedRoute;
    data: Object[];


    constructor(route: ActivatedRoute, http: Http, router: Router,public sanitizer: DomSanitizer) {
      this.router = router;
      this.http = http;
      this.route = route;

      var headers = new Headers();
      this.route.params.subscribe((params: Params) => {

        let headers = new Headers();

        headers.append('Content-Type', 'application/x-www-form-urlencoded');
        headers.append("token",localStorage.getItem("token"));



        this.http.get('http://localhost/VebSistemiProjekat/getMySongs.php?user_id='+localStorage.getItem('user_id'),{headers:headers}).map(res => res.json()).share().subscribe(data => {
          this.data = data.data;

        },
        err => {
          this.router.navigate(['./']);
        }
      );
    });
}

public deleteSong(event: Event, item: Number) {
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
this.http.get('http://localhost/VebSistemiProjekat/deleteSong.php?song_id='+item,{headers:headers}) .subscribe( data => {
event.srcElement.parentElement.parentElement.remove();
});
}


  }
