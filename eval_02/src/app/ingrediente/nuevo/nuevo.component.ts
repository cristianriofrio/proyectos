import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Ingrediente } from 'src/app/Interfaces/ingrediente';
import { IngredienteService } from 'src/app/Services/ingrediente.service';

@Component({
  selector: 'app-nuevo-ingrediente',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevo.component.html'
})
export class NuevoComponent implements OnInit {
  titulo = 'Insertar Ingrediente';

  ingrediente: Ingrediente = {
    nombre: null,
    ingrediente_id: null,
    calorias: null,
    cantidad: null,
    unidad: null
  };

  constructor(
    private servicio: IngredienteService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const ingrediente_id = parseInt(this.ruta.snapshot.paramMap.get('id'));
    if (ingrediente_id > 0) {
      this.ingrediente.ingrediente_id = ingrediente_id;
      this.servicio.uno(this.ingrediente.ingrediente_id).subscribe((ingrediente: Ingrediente) => {
        this.ingrediente = ingrediente;
      });
    }
  }

  grabar() {
    if (this.ingrediente.ingrediente_id === null) {
      this.servicio.insertar(this.ingrediente).subscribe((respuesta) => {
        if (parseInt(respuesta) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/ingrediente']);
        } else {
          alert('Error al grabar');
        }
      });
    } else {
      this.servicio.actualizar(this.ingrediente).subscribe((respuesta) => {
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
