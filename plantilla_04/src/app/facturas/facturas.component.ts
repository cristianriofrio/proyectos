import { Component, OnInit } from '@angular/core';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IFactura } from '../Interfaces/factura';
import { Router, RouterLink } from '@angular/router';
import { FacturaService } from '../Services/factura.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-facturas',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './facturas.component.html',
  styleUrl: './facturas.component.scss'
})
export class FacturasComponent implements OnInit {
  listafacturas: IFactura[] = [];
  constructor(private facturaServicio: FacturaService) {}
  ngOnInit(): void {
    this.facturaServicio.todos().subscribe((data: IFactura[]) => {
      this.listafacturas = data;
    });
  }

  //eliminar(idFactura) {}//
  
  eliminar(idFacturas) {
    Swal.fire({
      title: 'Fac',
      text: 'Esta seguro que desea eliminar!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.facturaServicio.eliminar(idFacturas).subscribe((data) => {
          Swal.fire('Factura', 'La Factura ha sido eliminado.', 'success');

          this.facturaServicio.todos().subscribe((data: IFactura[]) => {
          this.listafacturas = data;
        });
        });
      }
    });
  }
}