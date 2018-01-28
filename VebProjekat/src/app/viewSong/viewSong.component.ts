import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';
@Component({
  selector: 'ViewSongComponent',
  templateUrl: './viewSong.html',
})
export class ViewSongComponent {
  http: Http;
  router: Router;
  route: ActivatedRoute;
  data: Object[];
  postResponse: Response;


  constructor(route: ActivatedRoute, http: Http, router: Router,public sanitizer: DomSanitizer) {
    this.http = http;
    this.router = router;
    this.route = route;
  }
  ngOnInit() {
    this.route.params.subscribe((params: Params) => {
      let id = params['song_id'];
      let headers = new Headers();

      headers.append('Content-Type', 'application/x-www-form-urlencoded');
      headers.append("token",localStorage.getItem("token"));
      this.http.get('http://localhost/VebSistemiProjekat/getOneSong.php?song_id='+id,{headers:headers}).map(res => res.json()).share().subscribe(data => {
        this.data = data.data;
        localStorage.setItem('song_id', id);

      },
      err => {
        this.router.navigate(['./']);
      }
    );
  });
  }

  onAddSong(): void {

    var data = "user_id=" + localStorage.getItem('user_id') + "&song_id=" + localStorage.getItem('song_id');
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append("token", localStorage.getItem("token"));
    this.http.post('http://localhost/VebSistemiProjekat/addMySongs.php', data, { headers: headers }).map(res => res).subscribe( data => this.postResponse = data, err => alert(JSON.stringify(err)),
    () => {
      if(this.postResponse["_body"].indexOf("error") === -1){
        this.router.navigate(['./mySongs']);
      }else{
        let element = <HTMLElement>document.getElementsByClassName("alert")[0];
        element.style.display = "block";
        element.innerHTML = "Vec ste dodali tu pesmu";
      }
    }
  );
  }
}
