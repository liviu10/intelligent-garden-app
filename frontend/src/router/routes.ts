import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('src/layouts/MainLayout.vue'),
    children: [
      {
        path: 'admin',
        name: 'HomePage',
        component: () => import('pages/IndexPage.vue'),
        meta: {
          title: 'Home',
          caption: 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
          icon: 'home'
        },
      },
      {
        path: '/',
        name: 'HomePage',
        component: () => import('pages/IndexPage.vue'),
        meta: {
          title: 'Home',
          caption: 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
          icon: 'home'
        },
      }
    ],
  },

  // Capture and display an error message
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
