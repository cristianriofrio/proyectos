import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { Ingrediente } from '../Interfaces/IProveedor';
import { IngredienteService } from '../Services/proveedores.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-ingrediente',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './ingrediente.component.html'
})
export class IngredienteComponent {
  title = 'Lista de Ingrediente';

  lista: Ingrediente[] = [];
  constructor(private service: IngredienteService) {}
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
