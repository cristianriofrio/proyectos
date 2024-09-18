import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProveedor } from '../Interfaces/IProveedor';
 
@Injectable({
  providedIn: 'root'
})
export class IngredienteService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/proveedores.controller.php?op=';
 
   constructor(private http: HttpClient) {}

  todos(): Observable<IProveedor[]> {
    return this.http.get<IProveedor[]>(this.apiurl + 'todos');
  }


  uno(idProveedores: number): Observable<IProveedor> {
    const formData = new FormData();
    formData.append('idProveedores', idProveedores.toString());
    return this.http.post<IProveedor>(this.apiurl + 'uno', formData);
  }

  eliminar(idProveedores: number): Observable<number> {
    const formData = new FormData();
    formData.append('idProveedores', idProveedores.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(proveedor: IProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', proveedor.nombre);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono', proveedor.telefono);
    formData.append('email', proveedor.email);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(proveedor: IProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('idProveedores', proveedor.idProveedores!.toString());
    formData.append('nombre', proveedor.nombre);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono', proveedor.telefono);
    formData.append('email', proveedor.email);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }
}