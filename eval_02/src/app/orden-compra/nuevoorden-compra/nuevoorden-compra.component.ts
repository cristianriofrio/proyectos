import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

import { IOrdenCompra } from 'src/app/Interfaces/IOrdenCompra';
import { OrdenCompraService } from 'src/app/Services/ordenes-compra.service';

@Component({
  selector: 'app-nuevoorden-compra',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './nuevoorden-compra.component.html',
  styleUrl: './nuevoorden-compra.component.scss'
})

export class NuevoordenCompraComponent {

  titulo = 'Insertar Orden de Compra';
  
  ordenCompra: IOrdenCompra = {
    idOrden: null,          
    idProveedores: null,   
    fecha_orden: null,      
    total: null, 
  };

  constructor(
    private servicio: OrdenCompraService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    
    const orden_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (orden_id > 0) {
      this.ordenCompra.idOrden = orden_id;
      this.servicio.uno(this.ordenCompra.idOrden).subscribe((producto: IOrdenCompra) => {
        this.ordenCompra = producto;
      });
      this.titulo = 'Editar Orden de Compra';
    }
  }

  grabar() {
    if (this.ordenCompra.idOrden === null) {
      this.servicio.insertar(this.ordenCompra).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/orden']);
        } else {
          alert('Error al grabar');
        }
      });
    } else {
      
      this.servicio.actualizar(this.ordenCompra).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          alert('Actualizado con exito');
          this.navegacion.navigate(['/orden']);
        } else {
          alert('Error al actualizar');
        }
      });
    }
  }

}
