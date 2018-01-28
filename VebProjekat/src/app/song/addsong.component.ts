import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';
@Component({
selector: 'AddSongComponent',
templateUrl: '/addsong.html',
})
export class AddSongComponent{
http: Http;
router: Router;
postResponse: Response;
genere: Object[];
band: Object[];

addSongForm = new FormGroup({
song_name: new FormControl(),
song_runtime: new FormControl(),
song_link: new FormControl(),
song_genere: new FormControl(),
song_band: new FormControl()

});
constructor(http: Http, router: Router) {
this.http = http;
this.router = router;
var headers = new Headers();
this.addSongForm.setValue({song_name: "", song_runtime: "", song_link: "",song_band: "",song_genere: ""});
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
http.get('http://localhost/VebSistemiProjekat/getGenereservice.php', {headers: headers})
.map(res => res.json()).share()
.subscribe(data => {
  this.genere = data.genere;
},
err => {
this.router.navigate(['./']);
}
);
http.get('http://localhost/VebSistemiProjekat/getBandservice.php', {headers: headers})
.map(res => res.json()).share()
.subscribe(data => {

this.band = data.band;


},
err => {
this.router.navigate(['./']);
}
);
}
onAddSong(): void {
var data =
"song_name="+this.addSongForm.value.song_name + "&song_runtime="+this.addSongForm.value.song_runtime+
"&song_link="+this.addSongForm.value.song_link + "&band_id="+this.addSongForm.value.song_band + "&genere_id="+this.addSongForm.value.song_genere;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append("token",localStorage.getItem("token"));
this.http.post('http://localhost/VebSistemiProjekat/addSongservice.php',data,{headers:headers})
.map(res => res)
.subscribe( data => this.postResponse = data,
err => alert(JSON.stringify(err)),
() => {
if(this.postResponse["_body"].indexOf("error") === -1){
this.router.navigate(['./']);
}else{
alert("Unsuccesfull song add");
}
}
);
}
}
