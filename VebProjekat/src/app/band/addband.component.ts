import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';
@Component({
selector: 'AddBandComponent',
templateUrl: '/addband.html',
})
export class AddBandComponent {
data1 : Object[];
router1: Router;
http: Http;
router: Router;
postResponse: Response;
addBandTypeForm = new FormGroup({
band_name: new FormControl()
});
constructor(http: Http, router: Router) {
this.http = http;
this.router = router;
this.router1 = router;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
http.get('http://localhost/VebSistemiProjekat/getBandservice.php', {headers: headers}).map(res => res.json()).share().subscribe(data => {
this.data1 = data.band;
},
err => {
this.router1.navigate(['./']);
}
);
}
onAddBand(): void {
  var data = "band_name="+this.addBandTypeForm.value.band_name;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append("token",localStorage.getItem("token"));
this.http.post('http://localhost/VebSistemiProjekat/addbandservice.php',data,
{headers:headers})
.map(res => res)
.subscribe( data => this.postResponse = data,
err => alert(JSON.stringify(err)),
() => {
if(this.postResponse["_body"].indexOf("error") === -1){
this.router.navigate(['./']);
}else{
alert("Unsuccesfull band add");
}
}
);
}
}
