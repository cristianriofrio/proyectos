import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Receta } from '../Interfaces/receta';
 
@Injectable({
  providedIn: 'root'
})
export class RecetaService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/recetas.controller.php?op=';
 
  constructor(private lector: HttpClient) {}

  todos(): Observable<Receta[]> {
    return this.lector.get<Receta[]>(this.apiurl + 'todos');
  }

  uno(Receta_id: number): Observable<Receta> {
    const formData = new FormData();
    formData.append('Receta_id', Receta_id.toString());
    return this.lector.post<Receta>(this.apiurl + 'uno', formData);
  }

  eliminar(Receta_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('Receta_id', Receta_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(receta: Receta): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', receta.nombre);
    formData.append('Descripcion', receta.descripcion);
    formData.append('Tiempo_preparacion', receta.tiempo_preparacion.toString());
    formData.append('Dificultad', receta.dificultad);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(receta: Receta): Observable<string> {
    const formData = new FormData();
    formData.append('Receta_id', receta.receta_id.toString());
    formData.append('Nombre', receta.nombre);
    formData.append('Descripcion', receta.descripcion);
    formData.append('Tiempo_preparacion', receta.tiempo_preparacion.toString());
    formData.append('Dificultad', receta.dificultad);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}