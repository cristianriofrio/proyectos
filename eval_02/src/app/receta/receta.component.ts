import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { Receta } from '../Interfaces/receta';
import { RecetaService } from '../Services/receta.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-receta',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './receta.component.html'
})
export class RecetaComponent {
  title = 'Lista de Receta';

  lista: Receta[] = [];
  constructor(private service: RecetaService) {}
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
      console.log(data);
      this.cargatabla();
    });
  }
}
