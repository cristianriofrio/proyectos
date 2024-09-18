import { Component } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { RouterLink } from '@angular/router';

import { IProveedor } from '../Interfaces/IProveedor';
import { ProveedorService } from '../Services/proveedores.service';

@Component({
  selector: 'app-proveedores',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './proveedores.component.html',
  styleUrl: './proveedores.component.scss'
})

export class ProveedoresComponent {

  title = 'Lista de Proveedores';

  lista: IProveedor[] = [];

  constructor(private service: ProveedorService) {}
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
