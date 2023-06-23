import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/admin',
    component: () => import('src/layouts/MainLayout.vue'),
    children: [
      {
        path: '/admin',
        name: 'AdminIndexPage',
        component: () => import('pages/AdminIndexPage.vue'),
        meta: {
          title: 'Dashboard',
          caption: `This section provides a comprehensive overview of settings
            and equipment status, presenting a summary of information. It allows
            seamless control, including the ability to toggle pumps on/off directly.`,
          icon: 'home'
        },
      },
      {
        path: '/admin/equipments',
        name: 'AdminEquipmentsPage',
        meta: {
          title: 'Equipments and Measurements',
          caption: `This section allows you to manage and monitor
            equipment data, including viewing and editing equipment
            details as well as analyzing equipment readings and generating reports.`,
          icon: 'construction'
        },
        children: [
          {
            path: '/admin/equipments/list',
            name: 'AdminEquipmentsListAllPage',
            component: () => import('pages/AdminEquipmentsListAllPage.vue'),
            meta: {
              title: 'All equipments',
            },
          },
          {
            path: '/admin/equipments/readings',
            name: 'AdminEquipmentsReadingsPage',
            component: () => import('pages/AdminEquipmentsReadingsPage.vue'),
            meta: {
              title: 'Readings',
            },
          },
          {
            path: '/admin/equipments/reports',
            name: 'AdminEquipmentsReportsPage',
            component: () => import('pages/AdminEquipmentsReportsPage.vue'),
            meta: {
              title: 'Reports',
            },
          },
        ],
      },
      {
        path: '/admin/settings',
        name: 'AdminSettingsPage',
        meta: {
          title: 'Users and Roles',
          caption: `This section provides control and management over
            user accounts and roles, allowing you to configure
            user settings and define role-based access permissions.`,
          icon: 'settings'
        },
        children: [
          {
            path: '/admin/settings/users',
            name: 'AdminSettingsUserPage',
            component: () => import('pages/AdminSettingsUserPage.vue'),
            meta: {
              title: 'Users',
            },
          },
          {
            path: '/admin/settings/user-roles',
            name: 'AdminSettingsUserRolePage',
            component: () => import('pages/AdminSettingsUserRolePage.vue'),
            meta: {
              title: 'User roles',
            },
          },
        ],
      },
    ],
  },

  // Capture and display an error message
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
