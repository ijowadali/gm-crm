/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const bookingsRoutes = {
  path: '/hotels',
  component: Layout,
  redirect: '/hotels/list',
  name: 'Hotels',
  meta: {
    title: 'Hotels',
    icon: 'example',
    permissions: ['view menu Hotels'],
  },
  children: [
    {
      path: 'list',
      component: () => import('@/views/hotels/index.vue'),
      name: 'bookingsList',
      meta: { title: 'hotelsList', icon: 'list', permissions: ['hotels list'] },
    },
    {
      path: 'add_hotel',
      component: () => import('@/views/hotels/addHotel.vue'),
      name: 'addHotels',
      meta: { title: 'addHotels', icon: 'el-icon-plus', permissions: ['add Hotel'] },
    },
  ],
};

export default bookingsRoutes;
