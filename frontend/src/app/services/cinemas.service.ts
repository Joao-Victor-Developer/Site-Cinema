
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({ providedIn:'root' })
export class CinemasService {
  private api='/api/cinemas';
  constructor(private http:HttpClient){}

  nearby(lat:number,lng:number){
    return this.http.get(this.api+`/nearby?lat=${lat}&lng=${lng}`);
  }
}
