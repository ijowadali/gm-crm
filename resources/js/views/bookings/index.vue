<template>
  <div class="app-container">

    <router-link :to="'/bookings/add_booking'">
      <el-button
        circle
        class="add-new-button"
        icon="el-icon-plus"
        size="large"
        style="z-index: 10000"
        type="success"
      />
    </router-link>
  </div>
</template>

<script>
// import Pagination from '@/components/Pagination';
import { list } from '@/mixins/list';

export default {
  name: 'BookingsList',
  // components: { Pagination },
  filters: {
    statusFilter(status) {
      const statusMap = {
        published: 'success',
        draft: 'info',
        deleted: 'danger',
      };
      return statusMap[status];
    },
  },
  mixins: { list },
  data() {
    return {
      list: null,
      listUrl: 'bookings/',
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    // async getList() {
    //   this.listLoading = true;
    //   const { data } = await getRequest({ url: this.listUrl, params: { ...this.listQuery }});
    //   this.list = data.items;
    //   this.total = data.total;
    //   this.listLoading = false;
    // },
  },
};
</script>

<style scoped>
.edit-input {
  padding-right: 100px;
}

.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
</style>
