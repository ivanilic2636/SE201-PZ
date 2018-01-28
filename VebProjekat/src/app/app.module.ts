import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { routing } from './app.routes';




import{AddBandComponent} from './band/addband.component';
import{AddSongComponent} from './song/addsong.component';
import{AddGenereComponent} from './genere/addgenere.component';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';
import{AllSongsComponent} from './allsongs/allsongs.component';
import{ViewSongComponent} from './viewSong/viewSong.component';
import{MySongsComponent} from './mySongs/mySongs.component';
import { SearchPipe } from './pipes/search'

@NgModule({
imports: [ BrowserModule, HttpModule, routing, FormsModule, ReactiveFormsModule ],
declarations: [ AppComponent,
  RegisterComponent, LoginComponent,AddBandComponent,AddGenereComponent,AddSongComponent,AllSongsComponent,ViewSongComponent,MySongsComponent,  SearchPipe],
bootstrap: [ AppComponent ]
})
export class AppModule { }
