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
          caption: 'This section provides detailed settings and equipment status for convenient pump control.',
          icon: 'home'
        },
      },
      {
        path: '/admin/equipments',
        name: 'AdminEquipmentsPage',
        meta: {
          title: 'Equipments and Measurements',
          caption: 'This section manages equipment data, including viewing/editing, analyzing, and generating reports.',
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
          caption: 'This section controls user accounts and roles, configuring settings and permissions.',
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
