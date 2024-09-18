import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { RouterLink } from '@angular/router';

import { IProducto } from '../Interfaces/IProducto';
import { ProductoService } from '../Services/productos.service';

@Component({
  selector: 'app-productos',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './productos.component.html',
  styleUrl: './productos.component.scss'
})

export class ProductosComponent {

  title = 'Lista de Productos';

  lista: IProducto[] = [];

  constructor(private service: ProductoService) {}
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
