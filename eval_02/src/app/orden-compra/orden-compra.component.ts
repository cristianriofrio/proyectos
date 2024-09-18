import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { RouterLink } from '@angular/router';

import { IOrdenCompra } from '../Interfaces/IOrdenCompra';
import { OrdenCompraService } from '../Services/ordenes-compra.service';

@Component({
  selector: 'app-orden-compra',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './orden-compra.component.html',
  styleUrl: './orden-compra.component.scss'
})

export class OrdenCompraComponent {

  title = 'Lista de Orden de Compra';

  lista: IOrdenCompra[] = [];

  constructor(private service: OrdenCompraService) {}
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
