import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { RouterLink } from '@angular/router';

import { Preparacion } from '../Interfaces/preparacion';
import { PreparacionService } from '../Services/preparacion.service';

@Component({
  selector: 'app-ingrediente',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './preparacion.component.html'
})
export class IngredienteComponent {
  title = 'Lista de Ingrediente';

  lista: Preparacion[] = [];
  constructor(private service: PreparacionService) {}
  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.service.todos().subscribe((data) => {
      this.lista = data;
    });
  }

  eliminar(id: number) {
    this.service.eliminar(id).subscribe((data) => {
      this.cargatabla();
    });
  }
}
