import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Iva } from '../Interfaces/iva';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class IvaService {
  apiurl = 'http://localhost/proyectos/mcv_03/controllers/iva.controller.php?op=';

  constructor(private lector: HttpClient) {}

  todos(): Observable<Iva[]> {
    return this.lector.get<Iva[]>(this.apiurl + 'todos');
  }
}
