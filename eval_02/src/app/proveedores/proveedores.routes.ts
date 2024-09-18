export default [
  {
    path: '',
    loadComponent: () => import('./proveedores.component').then((m) => m.ProveedoresComponent)
  },
  {
    path: 'nuevo',
    loadComponent: () => import('./nuevoproveedor/nuevoproveedor.component').then((m) => m.NuevoproveedorComponent)
  },
  {
    path: 'editar/:id',
    loadComponent: () => import('./nuevoproveedor/nuevoproveedor.component').then((m) => m.NuevoproveedorComponent)
  }
];
