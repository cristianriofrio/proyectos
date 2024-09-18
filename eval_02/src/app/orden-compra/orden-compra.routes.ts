export default [
  {
    path: '',
    loadComponent: () => import('./orden-compra.component').then((m) => m.OrdenCompraComponent)
  },
  {
    path: 'nuevo',
    loadComponent: () => import('./nuevoorden-compra/nuevoorden-compra.component').then((m) => m.NuevoordenCompraComponent)
  },
  {
    path: 'editar/:id',
    loadComponent: () => import('./nuevoorden-compra/nuevoorden-compra.component').then((m) => m.NuevoordenCompraComponent)
  }
];
