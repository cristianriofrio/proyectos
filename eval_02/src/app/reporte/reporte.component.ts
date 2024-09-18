import { Component } from '@angular/core';

@Component({
  selector: 'app-reporte',
  standalone: true,
  imports: [],
  templateUrl: './reporte.component.html',
  styleUrl: './reporte.component.scss'
})
export class ReporteComponent {
  verReporteProveedores() {
    // Redirige a la URL del reporte en una nueva pestaña
    window.open('http://localhost/proyectos/eval_01/reports/proveedores.report.php', '_blank');
  }

  verReporteProductos() {
    // Redirige a la URL del reporte en una nueva pestaña
    window.open('http://localhost/proyectos/eval_01/reports/productos.report.php', '_blank');
  }
}
