export default [
  {
    path: '',
    loadComponent: () => import('./reporte.component').then((m) => m.ReporteComponent)
  }
];
