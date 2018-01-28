import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


import { RegisterComponent } from './register/register.component';

import { LoginComponent } from './login/login.component';
import{AddBandComponent} from './band/addband.component';
import{AllSongsComponent} from './allsongs/allsongs.component';
import{AddGenereComponent} from './genere/addgenere.component';
import{AddSongComponent} from './song/addsong.component';
import{ViewSongComponent} from './viewSong/viewSong.component';
import{MySongsComponent} from './mySongs/mySongs.component';

const appRoutes: Routes = [


{ path: 'register', component: RegisterComponent},
{ path: 'login', component: LoginComponent},
{ path: 'band', component: AddBandComponent},
{ path: 'allsongs', component: AllSongsComponent},
{ path: 'song', component: AddSongComponent},
{ path: 'viewSong/:song_id', component: ViewSongComponent},
{ path: 'mySongs', component: MySongsComponent},
{ path: 'genere', component: AddGenereComponent}




];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
