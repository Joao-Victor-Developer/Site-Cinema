
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { MovieCatalogComponent } from './movie-catalog/movie-catalog.component';
import { MovieDetailsComponent } from './movie-details/movie-details.component';
import { NearbyCinemasComponent } from './nearby-cinemas/nearby-cinemas.component';
import { ChatComponent } from './chat/chat.component';
import { MoviesComponent } from './movies/movies.component';

const routes: Routes = [
  { path:'', component:HomeComponent },
  { path:'login', component:LoginComponent },
  { path:'signup', component:SignupComponent },
  { path:'welcome', component:WelcomeComponent },
  { path:'filmes', component:MovieCatalogComponent },
  { path:'movie/:id', component:MovieDetailsComponent },
  { path:'cinemas', component:NearbyCinemasComponent },
  { path:'chat', component:ChatComponent },
  { path:'movies', component:MoviesComponent },
];

@NgModule({
  imports:[RouterModule.forRoot(routes)],
  exports:[RouterModule]
})
export class AppRoutingModule{}
