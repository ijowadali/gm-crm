<template>
  <div v-if="bookingData" v-loading="loading" class="voucher_container">
    <table>
      <thead>
        <tr>
          <th colspan="3">Family Head:</th>
          <th colspan="3">UB-100833</th>
          <th colspan="3">Manual No:</th>
        </tr>
        <tr>
          <th colspan="12" class="title">Mutamers</th>
        </tr>
        <tr>
          <th>SNO</th>
          <th>Passport</th>
          <th>Mutamer Name</th>
          <th>PAX</th>
          <th>Bed</th>
          <th>Aitekaf</th>
          <th>Group No.</th>
          <th>Visa #</th>
          <th>PNR</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ bookingData.customer_name }}</td>
          <td>{{ bookingData.customer_name }}</td>
          <td>{{ bookingData.customer_name }}</td>
          <td>{{ bookingData.hotel.adults }}</td>
          <td>{{ bookingData.hotel.adults }}</td>
          <td>{{ bookingData.hotel.adults }}</td>
          <td>{{ bookingData.group_no }}</td>
          <td>{{ bookingData.visa_company }}</td>
          <td>{{ bookingData.visa_status }}</td>
        </tr>
      </tbody>
    </table>
    <table>
      <thead>
        <tr>
          <th colspan="8" class="title">Accommodation</th>
        </tr>
        <tr>
          <th>City</th>
          <th>Hotel Name</th>
          <th>BRN</th>
          <th>Confirm#</th>
          <th>Room Type</th>
          <th>Checkin</th>
          <th>Checkout</th>
          <th>Nights</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.room_type }}</td>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.hotel1_name }}</td>
          <td>{{ bookingData.hotel.nights1 }}</td>
        </tr>
        <tr>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.room_type }}</td>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.hotel2_name }}</td>
          <td>{{ bookingData.hotel.nights2 }}</td>
        </tr>
        <tr>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.room_type }}</td>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.hotel3_name }}</td>
          <td>{{ bookingData.hotel.nights3 }}</td>
        </tr>
      </tbody>
    </table>
    <table>
      <thead>
        <tr>
          <th colspan="4" class="title">Transport/Services</th>
        </tr>
        <tr>
          <th>Transporter</th>
          <th>Type</th>
          <th>Description</th>
          <th>BRN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td />
        </tr>
      </tbody>
    </table>
    <div class="flight_table_wrap">
      <table>
        <thead>
          <tr>
            <th colspan="4" class="title">Departure (Pakistan to KSA)</th>
          </tr>
          <tr>
            <th>Flight</th>
            <th>Sector</th>
            <th>Departure</th>
            <th>Arrival</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td />
          </tr>
        </tbody>
      </table>
      <table>
        <thead>
          <tr>
            <th colspan="4" class="title">Arrival (KSA to PAK)</th>
          </tr>
          <tr>
            <th>Flight</th>
            <th>Sector</th>
            <th>Departure</th>
            <th>Arrival</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td />
          </tr>
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
.voucher_container {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.voucher_container .flight_table_wrap {
  display: flex;
  gap: 10px;
}

.voucher_container .title {
  background-color: #9b9b9b;
}

table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}

</style>
