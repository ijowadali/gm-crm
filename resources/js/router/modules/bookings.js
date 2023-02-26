/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const bookingsRoutes = {
  path: '/bookings',
  component: Layout,
  redirect: '/bookings/list',
  name: 'Bookings',
  meta: {
    title: 'bookings',
    icon: 'example',
    permissions: ['view menu bookings'],
  },
  children: [
    {
      path: 'list',
      component: () => import('@/views/bookings/index.vue'),
      name: 'bookingsList',
      meta: { title: 'bookingsList', icon: 'list', permissions: ['bookings list'] },
    },
    {
      path: 'add_booking',
      component: () => import('@/views/bookings/addBooking.vue'),
      name: 'addBooking',
      meta: { title: 'addBooking', icon: 'el-icon-plus', permissions: ['add booking'] },
    },
    {
      path: 'print_booking',
      component: () => import('@/views/bookings/printBooking.vue'),
      name: 'printBooking',
      meta: { title: 'printBooking', icon: 'el-icon-plus', permissions: ['print booking'] },
    },
  ],
};

export default bookingsRoutes;
