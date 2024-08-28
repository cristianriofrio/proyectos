import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Ingrediente } from '../Interfaces/ingrediente';
 
@Injectable({
  providedIn: 'root'
})
export class IngredienteService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/ingredientes.controller.php?op=';
 
  constructor(private lector: HttpClient) {}

  todos(): Observable<Ingrediente[]> {
    return this.lector.get<Ingrediente[]>(this.apiurl + 'todos');
  }

  uno(Ingrediente_id: number): Observable<Ingrediente> {
    const formData = new FormData();
    formData.append('Ingrediente_id', Ingrediente_id.toString());
    return this.lector.post<Ingrediente>(this.apiurl + 'uno', formData);
  }

  eliminar(Ingrediente_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('Ingrediente_id', Ingrediente_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(ingrediente: Ingrediente): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', ingrediente.nombre);
    formData.append('Cantidad', ingrediente.cantidad.toString());
    formData.append('Unidad', ingrediente.unidad);
    formData.append('Calorias', ingrediente.calorias.toString());
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(ingrediente: Ingrediente): Observable<string> {
    const formData = new FormData();
    formData.append('Ingrediente_id', ingrediente.ingrediente_id.toString());
    formData.append('Nombre', ingrediente.nombre);
    formData.append('Cantidad', ingrediente.cantidad.toString());
    formData.append('Unidad', ingrediente.unidad);
    formData.append('Calorias', ingrediente.calorias.toString());
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}