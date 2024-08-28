export default [
  {
    path: '',
    loadComponent: () => import('./ingrediente.component').then((m) => m.IngredienteComponent)
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
