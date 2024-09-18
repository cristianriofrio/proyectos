import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

import { ProveedorService } from 'src/app/Services/proveedores.service';
import { IProveedor } from 'src/app/Interfaces/IProveedor';

@Component({
  selector: 'app-nuevoproveedor',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './nuevoproveedor.component.html',
  styleUrl: './nuevoproveedor.component.scss'
})

export class NuevoproveedorComponent {

  titulo = 'Insertar Proveedor';
  
  proveedor: IProveedor = {
    idProveedores: null,
    nombre: null,          
    direccion: null,       
    telefono: null,       
    email: null,
  };

  constructor(
    private servicio: ProveedorService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    
    const proveedor_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (proveedor_id > 0) {
      this.proveedor.idProveedores = proveedor_id;
      this.servicio.uno(this.proveedor.idProveedores).subscribe((producto: IProveedor) => {
        this.proveedor = producto;
      });
      this.titulo = 'Editar Proveedor';
    }
  }

  grabar() {
    if (this.proveedor.idProveedores === null) {
      this.servicio.insertar(this.proveedor).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/proveedor']);
        } else {
          alert('Error al grabar');
        }
      });
    } else {
      
      this.servicio.actualizar(this.proveedor).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          alert('Actualizado con exito');
          this.navegacion.navigate(['/proveedor']);
        } else {
          alert('Error al actualizar');
        }
      });
    }
  }

}
