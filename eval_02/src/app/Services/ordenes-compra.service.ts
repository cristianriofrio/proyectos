import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { IOrdenCompra } from '../Interfaces/IOrdenCompra';

@Injectable({
  providedIn: 'root'
})
export class OrdenCompraService {
  apiurl = 'http://localhost/proyectos/eval_01/controllers/ordenes_compra.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<IOrdenCompra[]> {
    return this.http.get<IOrdenCompra[]>(this.apiurl + 'todos');
  }

  uno(idOrden: number): Observable<IOrdenCompra> {
    const formData = new FormData();
    formData.append('idOrden', idOrden.toString());
    return this.http.post<IOrdenCompra>(this.apiurl + 'uno', formData);
  }

  eliminar(idOrden: number): Observable<number> {
    const formData = new FormData();
    formData.append('idOrden', idOrden.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(orden: IOrdenCompra): Observable<string> {
    const formData = new FormData();
    formData.append('idProveedores', orden.idProveedores.toString());
    formData.append('fecha_orden', orden.fecha_orden);
    formData.append('total', orden.total.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(orden: IOrdenCompra): Observable<string> {
    const formData = new FormData();
    formData.append('idOrden', orden.idOrden!.toString());
    formData.append('idProveedores', orden.idProveedores.toString());
    formData.append('fecha_orden', orden.fecha_orden);
    formData.append('total', orden.total.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }
}

