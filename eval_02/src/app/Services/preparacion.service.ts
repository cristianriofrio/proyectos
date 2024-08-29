import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Preparacion } from '../Interfaces/preparacion';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PreparacionService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/consolidado.controller.php?op=';
  constructor(private lector: HttpClient) {}
  todos(): Observable<Preparacion[]> {
    return this.lector.get<Preparacion[]>(this.apiurl + 'todos');
  }
  uno(idPreparacion: number): Observable<Preparacion> {
    const formData = new FormData();
    formData.append('consolidado_id', idPreparacion.toString());
    return this.lector.post<Preparacion>(this.apiurl + 'uno', formData);
  }
  eliminar(idPreparacion: number): Observable<number> {
    const formData = new FormData();
    formData.append('consolidado_id', idPreparacion.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(preparacion: Preparacion): Observable<string> {
    const formData = new FormData();
    formData.append('receta_id', preparacion.receta_id.toString());
    formData.append('ingrediente_id', preparacion.ingrediente_id.toString());
    formData.append('cantidad', preparacion.cantidad.toString());
    formData.append('unidad', preparacion.unidad);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(preparacion: Preparacion): Observable<string> {
    const formData = new FormData();
    formData.append('consolidado_id', preparacion.consolidado_id.toString());
    formData.append('Receta Id', preparacion.receta_id.toString());
    formData.append('Ingrediente Id', preparacion.ingrediente_id.toString());
    formData.append('Cantidad', preparacion.cantidad.toString());
    formData.append('Unidad', preparacion.unidad);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}