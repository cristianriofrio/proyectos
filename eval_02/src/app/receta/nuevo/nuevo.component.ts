import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Receta } from 'src/app/Interfaces/receta';
import { RecetaService } from 'src/app/Services/receta.service';

@Component({
  selector: 'app-nuevo-receta',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevo.component.html'
})
export class NuevoComponent implements OnInit {
  titulo = 'Insertar Receta';

  receta: Receta = {
    receta_id: null,
    nombre: null,
    descripcion: null,
    tiempo_preparacion: null,
    dificultad: null
  };

  constructor(
    private servicio: RecetaService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const receta_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (receta_id > 0) {
      this.receta.receta_id = receta_id;
      this.servicio.uno(this.receta.receta_id).subscribe((receta: Receta) => {

        console.log(receta);
        this.receta = receta;
      });
    }
  }

  grabar() {
    if (this.receta.receta_id === null) {
      this.servicio.insertar(this.receta).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/receta']);
        } else {
          alert('Error al grabar');
        }
      });
    } else {
      this.servicio.actualizar(this.receta).subscribe((respuesta) => {
        if (parseInt(respuesta) > 0) {
          alert('Actualizado con exito');
          this.navegacion.navigate(['/receta']);
        } else {
          alert('Error al actualizar');
        }
      });
    }
  }
}
