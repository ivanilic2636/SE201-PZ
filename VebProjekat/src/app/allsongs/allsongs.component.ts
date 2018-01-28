import { Component, Directive } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import { DomSanitizer } from '@angular/platform-browser';
import { FormGroup, FormControl } from '@angular/forms';
import { Router, ActivatedRoute, Params } from '@angular/router';
import 'rxjs/Rx';

@Component({
selector: 'AllSongsComponent',
templateUrl: '/allsongs.html'
})
export class AllSongsComponent {
 data : Object[];
 router: Router;
  http: Http;
postResponse: Response;
route: ActivatedRoute;
data2: String;


constructor(route: ActivatedRoute, http: Http, router: Router,public sanitizer: DomSanitizer) {
  this.router = router;
  this.http = http;
      this.route = route;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
http.get('http://localhost/VebSistemiProjekat/getSongsservice.php',  {headers: headers}).map(res => res.json()).share().subscribe(data => {
this.data = data.songs;

},
err => {
this.router.navigate(['./']);
}
);
}

public viewSong(item: Number){
this.router.navigate(['/viewSong', item]);
}

ngOnInit() {
  this.route.params.subscribe((params: Params) => {
    let id = localStorage.getItem('user');
    let headers = new Headers();

    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append("token",localStorage.getItem("token"));
    this.http.get('http://localhost/VebSistemiProjekat/getUserID.php?user_username='+id,{headers:headers}).map(res => res.json()).share().subscribe(data => {
      this.data2 = data.data2;
      let l1 = JSON.stringify(this.data2);
      let l2 = JSON.parse(l1);
      localStorage.setItem('user_id', l2);

    },
    err => {
      this.router.navigate(['./']);
    }
  );
  });
}


}
