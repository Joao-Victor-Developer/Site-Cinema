
import { Injectable } from '@angular/core';
import { io } from 'socket.io-client';
import { fromEvent } from 'rxjs';

@Injectable({ providedIn:'root' })
export class ChatService {
  private socket = io('/');

  sendMessage(message:any){
    this.socket.emit('message',message);
  }

  listen(){
    return fromEvent(this.socket,'message');
  }
}
