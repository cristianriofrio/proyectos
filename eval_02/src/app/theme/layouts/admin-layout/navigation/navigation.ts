export interface NavigationItem {
  id: string;
  title: string;
  type: 'item' | 'collapse' | 'group';
  translate?: string;
  icon?: string;
  hidden?: boolean;
  url?: string;
  classes?: string;
  groupClasses?: string;
  exactMatch?: boolean;
  external?: boolean;
  target?: boolean;
  breadcrumbs?: boolean;
  children?: NavigationItem[];
  link?: string;
  description?: string;
  path?: string;
}

export const NavigationItems: NavigationItem[] = [
  {
    id: 'Componentes',
    title: 'Componentes',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'proveedores',
        title: 'Proveedores',
        type: 'item',
        classes: 'nav-item',
        url: '/proveedor',
        icon: 'bi bi-1-circle'
      },
      {
        id: 'productos',
        title: 'Productos',
        type: 'item',
        classes: 'nav-item',
        url: '/producto',
        icon: 'bi bi-2-circle'
      },
      {
        id: 'ordenes',
        title: 'Ordenes',
        type: 'item',
        classes: 'nav-item',
        url: '/orden',
        icon: 'bi bi-3-circle'
      }
    ]
  },
];