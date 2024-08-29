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
        id: 'ingredientes',
        title: 'Ingrediente',
        type: 'item',
        classes: 'nav-item',
        url: '/ingrediente',
        icon: 'bi bi-1-circle'
      },
      {
        id: 'color',
        title: 'Recetas',
        type: 'item',
        classes: 'nav-item',
        url: '/receta',
        icon: 'bi bi-2-circle'
      },
      {
        id: 'tabler',
        title: 'Preparación',
        type: 'item',
        classes: 'nav-item',
        url: '/preparacion',
        icon: 'bi bi-3-circle'
      }
    ]
  },
];