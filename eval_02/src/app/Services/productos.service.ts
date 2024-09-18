import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProducto } from '../Interfaces/Iproducto';
 
@Injectable({
  providedIn: 'root'
})
export class RecetaService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/productos.controller.php?op=';
 
  constructor(private http: HttpClient) {}

  todos(): Observable<IProducto[]> {
    return this.http.get<IProducto[]>(this.apiurl + 'todos');
  }

  uno(idProductos: number): Observable<IProducto> {
    const formData = new FormData();
    formData.append('idProductos', idProductos.toString());
    return this.http.post<IProducto>(this.apiurl + 'uno', formData);
  }

  eliminar(idProductos: number): Observable<number> {
    const formData = new FormData();
    formData.append('idProductos', idProductos.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(producto: IProducto): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    formData.append('idProveedores', producto.idProveedores.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(producto: IProducto): Observable<string> {
    const formData = new FormData();
    formData.append('idProductos', producto.idProductos!.toString());
    formData.append('nombre', producto.nombre);
    formData.append('descripcion', producto.descripcion);
    formData.append('precio', producto.precio.toString());
    formData.append('stock', producto.stock.toString());
    formData.append('idProveedores', producto.idProveedores.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }
}