export default [
  {
    path: '',
    loadComponent: () => import('./receta.component').then((m) => m.RecetaComponent)
  },
  {
    path: 'nuevo',
    loadComponent: () => import('./nuevo/nuevo.component').then((m) => m.NuevoComponent)
  },
  {
    path: 'editar/:id',
    loadComponent: () => import('./nuevo/nuevo.component').then((m) => m.NuevoComponent)
  }
];
