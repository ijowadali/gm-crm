<template>
  <div class="app-container">
    <new-booking />
  </div>
</template>

<script>

import NewBooking from '@/components/NewBooking/newBooking.vue';

export default {
  name: 'AddBooking',
  components: { NewBooking },
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
