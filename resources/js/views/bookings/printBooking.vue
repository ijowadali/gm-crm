<template>
  <div class="app-container">
    <voucher-print />
  </div>
</template>

<script>

import VoucherPrint from '@/components/NewBooking/printBooking.vue';

export default {
  name: 'PrintBooking',
  components: { VoucherPrint },
  data() {
    return {
      booking: {},
    };
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
