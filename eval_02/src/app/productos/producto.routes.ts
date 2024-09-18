export default [
  {
    path: '',
    loadComponent: () => import('./productos.component').then((m) => m.ProductosComponent)
  },
  {
    path: 'nuevo',
    loadComponent: () => import('./nuevoproducto/nuevoproducto.component').then((m) => m.NuevoproductoComponent)
  },
  {
    path: 'editar/:id',
    loadComponent: () => import('./nuevoproducto/nuevoproducto.component').then((m) => m.NuevoproductoComponent)
  }
];
