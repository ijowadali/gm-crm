<template>
  <div v-loading="loading" class="app-container">
    <div class="voucher_container" />
    <table>
      <thead>
        <th>Mutamers</th>
        <th>SNO</th>
        <th>Passport</th>
        <th>Mutamer Name</th>
        <th>PAX</th>
        <th>Bed</th>
        <th>Aitekaf</th>
        <th>Group No.</th>
        <th>Visa #</th>
        <th>PNR</th>
      </thead>
      <tbody>
        <td />
      </tbody>
    </table>
    <table>
      <thead>
        <th>Accommodation</th>
        <th>City</th>
        <th>Hotel Name</th>
        <th>Confirm#</th>
        <th>Room Type</th>
        <th>Checkin</th>
        <th>Checkout</th>
        <th>Nights</th>
      </thead>
      <tbody>
        <td />
      </tbody>
    </table>
    <table>
      <thead>
        <th>Transport/Services</th>
        <th>Transporter</th>
        <th>Type</th>
        <th>Description</th>
        <th>BRN</th>
      </thead>
      <tbody>
        <td />
      </tbody>
    </table>
    <div class="flight_table_wrap">
      <table>
        <thead>
          <th>Departure (Pakistan to KSA)</th>
          <th>Flight</th>
          <th>Sector</th>
          <th>Departure</th>
          <th>Arrival</th>
        </thead>
        <tbody>
          <td />
        </tbody>
      </table>
      <table>
        <thead>
          <th>Arrival (KSA to PAK)</th>
          <th>Flight</th>
          <th>Sector</th>
          <th>Departure</th>
          <th>Arrival</th>
        </thead>
        <tbody>
          <td />
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import { getRequest } from '@/api/custom';

export default {
  name: 'PrintBooking',
  data() {
    return {
      url: 'bookings/',
      loading: false,
      bookingData: {},
    };
  },
  mounted() {
    if (this.$route.query.id) {
      this.getBookingData();
    }
  },
  methods: {
    async getBookingData() {
      const response = await getRequest({ url: this.url + this.$route.query.id }).catch(_ => {
        this.loading = false;
      });
      if (response.status) {
        this.bookingData = response.data;
      }
    },
  },
};
</script>
<style lang="scss" scoped>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
