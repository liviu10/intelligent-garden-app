function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  // The route to the dashboard page will redirect the user to the login form
  { path: '/', name: 'dashboard', component: page('dashboard.vue') },

  // The routes to the login and registration system
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  // The routes to the "List of Equipments" page
  { path: '/equipment-list/index', name: 'equipment-list.index', component: page('equipment-list/index.vue') },

  // The routes to the "Equipment Records" page
  { path: '/equipment-records/ph-sensor/index', name: 'equipment-records.ph-sensor.index', component: page('equipment-records/ph-sensor/index.vue') },
  { path: '/equipment-records/ec-sensor/index', name: 'equipment-records.ec-sensor.index', component: page('equipment-records/ec-sensor/index.vue') },
  { path: '/equipment-records/level-sensor/index', name: 'equipment-records.level-sensor.index', component: page('equipment-records/level-sensor/index.vue') },
  { path: '/equipment-records/pump1/index', name: 'equipment-records.pump1.index', component: page('equipment-records/pump1/index.vue') },
  { path: '/equipment-records/pump2/index', name: 'equipment-records.pump2.index', component: page('equipment-records/pump2/index.vue') },
  { path: '/equipment-records/pump3/index', name: 'equipment-records.pump3.index', component: page('equipment-records/pump3/index.vue') },

  // The routes to the "About us" page
  { path: '/about-us', name: 'about-us', component: page('about-us/about-us.vue') },

  // The route to the documents section
  { path: '/documents/how-to-use-this-app', name: 'documents.documentation', component: page('documents/documentation.vue') },

  // The routes to the settings section: profile and password
  { path: '/update-profile', name: 'settings.update-profile', component: page('user-settings/update-profile.vue') },

  // The route to the application settings
  { path: '/application-settings', name: 'application-settings', component: page('application-settings/index.vue') },

  // The route to display error message if the user is requesting for a resource that do not exist
  { path: '*', component: page('errors/404.vue') }
]
