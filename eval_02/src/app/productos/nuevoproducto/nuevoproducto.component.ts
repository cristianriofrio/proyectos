import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

import { IProducto } from 'src/app/Interfaces/IProducto';
import { ProductoService } from '../../Services/productos.service';
import { ProveedorService } from '../../Services/proveedores.service';
import { IProveedor } from 'src/app/Interfaces/IProveedor';


@Component({
  selector: 'app-nuevoproducto',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './nuevoproducto.component.html',
  styleUrl: './nuevoproducto.component.scss'
})

export class NuevoproductoComponent {

  titulo = 'Insertar Producto';
  proveedores: IProveedor[] = [];
  
  producto: IProducto = {
    idProductos: null,
    nombre: null,
    descripcion: null,
    precio: null,
    stock: null,
    idProveedores: null
  };

  constructor(
    private servicio: ProductoService,
    private service_proveedor: ProveedorService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    // Cargar proveedores
    this.service_proveedor.todos().subscribe((proveedores: IProveedor[]) => {
      this.proveedores = proveedores;
    });
    
    const producto_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (producto_id > 0) {
      this.producto.idProductos = producto_id;
      this.servicio.uno(this.producto.idProductos).subscribe((producto: IProducto) => {
        this.producto = producto;
      });
      this.titulo = 'Editar Producto';
    }
  }

  grabar() {
    if (this.producto.idProductos === null) {
      this.servicio.insertar(this.producto).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/producto']);
        } else {
          alert('Error al grabar');
        }
      });
    } else {
      
      this.servicio.actualizar(this.producto).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          alert('Actualizado con exito');
          this.navegacion.navigate(['/producto']);
        } else {
          alert('Error al actualizar');
        }
      });
    }
  }
  
}
