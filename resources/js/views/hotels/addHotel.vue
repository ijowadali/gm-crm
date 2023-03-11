<template>
  <div class="app-container">
    <new-hotel />
  </div>
</template>

<script>

import NewHotel from '@/components/NewHotel/newHotel.vue';

export default {
  name: 'AddHotel',
  components: { NewHotel },
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
