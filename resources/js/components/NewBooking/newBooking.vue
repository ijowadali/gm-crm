<template>
  <div v-loading="loading" class="app-container">
    <el-form
      ref="newBooking"
      :model="newBooking"
      :rules="rules"
      class="demo-purchaseOrder"
      label-position="top"
      label-width="120px"
      size="mini"
    >
      <el-card shadow="never" style="margin-bottom: 10px">
        <div slot="header" class="clearfix">
          <h4 style="margin: 0px 0px;">Booking Details</h4>
        </div>
        <div style="padding: 10px">
          <el-divider content-position="left"><h3>Booking Details</h3></el-divider>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Customer" prop="customer_name" size="mini">
                <el-select
                  v-model="newBooking.customer_name"
                  allow-create
                  clearable
                  filterable
                  placeholder="Search Customer"
                  remote
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="items in []"
                    :key="items.phone"
                    :label="items.first_name+' '+items.last_name"
                    :value="items.user_id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Booking Date" prop="booking_date" size="mini">
                <el-date-picker
                  v-model="newBooking.booking_date"
                  placeholder="Pick a day"
                  size="mini"
                  style="width: 100%"
                  type="date"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Status" prop="booking_status" size="mini">
                <el-select
                  v-model="newBooking.booking_status"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Group Name" prop="group_name" size="mini">
                <el-input v-model="newBooking.group_name" placeholder="Please Enter Group Name" size="mini" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Group Number" prop="group_no" size="mini">
                <el-input-number
                  v-model="newBooking.group_no"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Category" prop="category" size="mini">
                <el-select
                  v-model="newBooking.category"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>
          <el-divider content-position="left"><h3>Visa Details</h3></el-divider>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="IATA" prop="iata" size="mini">
                <el-select
                  v-model="newBooking.visa.iata"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Visa Company" prop="visaCompany" size="mini">
                <el-input v-model="newBooking.visa.visa_company" placeholder="Please Enter Visa Company" size="mini" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Visa Status" prop="visaStatus" size="mini">
                <el-select
                  v-model="newBooking.visa.visa_status"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>
          <el-divider content-position="left"><h3>Hotel Details</h3></el-divider>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Room Type" prop="roomType" size="mini">
                <el-select
                  v-model="newBooking.hotel.room_type"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Package" prop="package" size="mini">
                <el-select
                  v-model="newBooking.hotel.package"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Short Booking" prop="short_booking" size="mini">
                <el-switch
                  v-model="newBooking.hotel.short_booking"
                  :active-value="1"
                  :inactive-value="0"
                  active-color="#13ce66"
                  inactive-color="#ff4949"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Hotel 1" prop="hotel1_name" size="mini">
                <el-select
                  v-model="newBooking.hotel.hotel1_name"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Nights 1" prop="nigths1" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.nights1"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Hotel 2" prop="hotel2_name" size="mini">
                <el-select
                  v-model="newBooking.hotel.hotel2_name"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Nights 2" prop="nigths2" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.nights2"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Hotel 3" prop="hotel3_name" size="mini">
                <el-select
                  v-model="newBooking.hotel.hotel3_name"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Draft','Final']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Nights 3" prop="nigths3" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.nights3"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="15">
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Adults" prop="adults" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.adults"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Childs" prop="childs" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.childs"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="4" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Infants" prop="infants" size="mini">
                <el-input-number
                  v-model="newBooking.hotel.infants"
                  :max="10"
                  :min="1"
                  controls-position="right"
                  style="width: 100%"
                />
              </el-form-item>
            </el-col>
          </el-row>
          <el-divider content-position="left"><h3>Confirmation Details</h3></el-divider>
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Approval Date" prop="approval_date" size="mini">
                <el-date-picker
                  v-model="newBooking.approval_date"
                  placeholder="Pick a day"
                  size="mini"
                  style="width: 100%"
                  type="date"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Expected Departure" prop="expected_departure" size="mini">
                <el-date-picker
                  v-model="newBooking.expected_departure"
                  placeholder="Pick a day"
                  size="mini"
                  style="width: 100%"
                  type="date"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Confirmed Ticket" prop="confirmed_ticket" size="mini">
                <el-switch
                  v-model="newBooking.confirmed_ticket"
                  :active-value="1"
                  :inactive-value="0"
                  active-color="#13ce66"
                  inactive-color="#ff4949"
                />
              </el-form-item>
            </el-col>
          </el-row>
        </div>
      </el-card>
      <el-form-item>
        <el-button type="primary" @click="submitForm('newBooking')">Create</el-button>
        <el-button @click="resetForm('newBooking')">Reset</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import { getRequest, postRequest } from '@/api/custom';
import { permissions } from '@/mixins/permissions';
import { picker } from '@/mixins/picker';

export default {
  name: 'NewBooking',
  mixins: [permissions, picker],
  data() {
    return {
      url: 'bookings/',
      loading: false,
      newBooking: {
        status: 'Draft',
        bookingDate: '',
        customer: '',
        visa: {},
        hotel: {},
      },
      rules: {
        customer_name: [
          { required: true, message: 'Please select a customer', trigger: 'change' },
        ],
        booking_date: [
          { required: true, message: 'Please select a date', trigger: 'change' },
        ],
      },
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
        this.newBooking = response.data;
      }
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.$confirm(`Are you sure you will not be able to modify any information later! `, 'Warning', {
            confirmButtonText: 'I am sure',
            cancelButtonText: 'Let me edit',
            type: 'warning',
          }).then(() => {
            this.loading = true;
            postRequest({ url: this.url, data: this.newBooking }).then(async response => {
              this.loading = false;
              if (response.status) {
                this.$message({
                  showClose: true,
                  message: response.message,
                  type: 'success',
                });
                this.$refs[formName].resetFields();
                if (this.$route.query.id) {
                  await this.getBookingData();
                }
                // await this.$router.push('/orders/sales_orders/edit/' + response.id);
              } else {
                this.$message({
                  showClose: true,
                  message: response.message,
                  type: 'error',
                });
              }
            }).catch(error => {
              this.loading = false;
              console.log(error);
            });
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
  },
};
</script>
<style lang="scss" scoped>

</style>
