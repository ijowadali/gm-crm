<template>
  <div class="app-container">
    <new-booking />
  </div>
</template>

<script>
// import Pagination from '@/components/Pagination';
// import { list } from '@/mixins/list';

import NewBooking from '@/components/NewBooking/newBooking.vue';

export default {
  name: 'AddBooking',
  components: { NewBooking },
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
  data() {
    return {
      booking: {},
    };
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
