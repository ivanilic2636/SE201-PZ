import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';
@Component({
selector: 'AddGenereComponent',
templateUrl: '/addgenere.html',
})
export class AddGenereComponent {
  private data1 : Object[];
  private router1: Router;
http: Http;
router: Router;
postResponse: Response;
addGenereTypeForm = new FormGroup({
genere_name: new FormControl()
});
constructor(http: Http, router: Router) {
this.http = http;
this.router = router;
this.router1 = router;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
http.get('http://localhost/VebSistemiProjekat/getGenereservice.php', {headers: headers})
.map(res => res.json()).share()
.subscribe(data => {
this.data1 = data.genere;
},
err => {
this.router1.navigate(['./']);
}
);
}
onAddGenere(): void {
  var data = "genere_name="+this.addGenereTypeForm.value.genere_name;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append("token",localStorage.getItem("token"));
this.http.post('http://localhost/VebSistemiProjekat/addgenereservice.php',data,
{headers:headers})
.map(res => res)
.subscribe( data => this.postResponse = data,
err => alert(JSON.stringify(err)),
() => {
if(this.postResponse["_body"].indexOf("error") === -1){
this.router.navigate(['./']);
}else{
alert("Unsuccesfull genere add");
}
}
);
}
}
