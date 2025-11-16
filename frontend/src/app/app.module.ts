
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';

import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { MovieCatalogComponent } from './movie-catalog/movie-catalog.component';
import { MovieDetailsComponent } from './movie-details/movie-details.component';
import { NearbyCinemasComponent } from './nearby-cinemas/nearby-cinemas.component';
import { ChatComponent } from './chat/chat.component';
import { MoviesComponent } from './movies/movies.component';

@NgModule({
  declarations:[
    AppComponent,
    HomeComponent,
    LoginComponent,
    SignupComponent,
    WelcomeComponent,
    MovieCatalogComponent,
    MovieDetailsComponent,
    NearbyCinemasComponent,
    ChatComponent,
    MoviesComponent
  ],
  imports:[
    BrowserModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule,
    AppRoutingModule
  ],
  providers:[],
  bootstrap:[AppComponent]
})
export class AppModule {}
