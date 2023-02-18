/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const voucherRoutes = {
  path: '/vouchers',
  component: Layout,
  redirect: '/vouchers/list',
  name: 'Vouchers',
  meta: {
    title: 'vouchers',
    icon: 'example',
    permissions: ['view menu vouchers'],
  },
  children: [
    {
      path: 'list',
      component: () => import('@/views/vouchers/index.vue'),
      name: 'vouchersList',
      meta: { title: 'vouchersList', icon: 'list', permissions: ['manage permission'] },
    },
  ],
};

export default voucherRoutes;
