import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

import { Preparacion } from 'src/app/Interfaces/preparacion';
import { PreparacionService } from 'src/app/Services/preparacion.service';

@Component({
  selector: 'app-nuevo-ingrediente',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevo.component.html'
})
export class NuevoComponent implements OnInit {
  titulo = 'Insertar Preparación';

  Preparacion: Preparacion = {
    consolidado_id: null,
    receta_id: null,
    ingrediente_id: null,
    cantidad: null,
    unidad: null,
  };

  constructor(
    private servicio: PreparacionService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const consolidado_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (consolidado_id > 0) {
      this.Preparacion.ingrediente_id = consolidado_id;
      this.servicio.uno(this.Preparacion.ingrediente_id).subscribe((ingrediente: Preparacion) => {
        this.Preparacion = ingrediente;
      });
    }
  }

  grabar() {
    if (this.Preparacion.consolidado_id === null) {
      this.servicio.insertar(this.Preparacion).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/preparacion']);
        } else {
          alert('Error al grabar');
        }
      });
    }
    else {
      console.log('actualizar--->', this.Preparacion)
      this.servicio.actualizar(this.Preparacion).subscribe((respuesta) => {
        console.log('----2----',respuesta)
        if (parseInt(respuesta) > 0) {
          alert('Actualizado con exito');
          this.navegacion.navigate(['/ingrediente']);
        } else {
          alert('Error al actualizar');
        }
      });
    }
  }
}
