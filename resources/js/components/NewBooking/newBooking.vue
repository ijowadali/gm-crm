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
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Customer" prop="customer" size="mini">
                <el-select
                  v-model="newBooking.customer"
                  :loading="customerLoading"
                  :remote-method="findCustomer"
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
              <el-form-item label="Booking Date" prop="bookingDate" size="mini">
                <el-date-picker
                  v-model="newBooking.bookingDate"
                  placeholder="Pick a day"
                  size="mini"
                  style="width: 100%"
                  type="date"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Status" prop="status" size="mini">
                <el-select
                  v-model="newBooking.status"
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
              <el-form-item label="Group Name" prop="groupName" size="mini">
                <el-input v-model="newBooking.groupName" placeholder="Please Enter Group Name" size="mini" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Group Number" prop="groupNumber" size="mini">
                <el-input-number
                  v-model="newBooking.groupNumber"
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
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="IATA" prop="iata" size="mini">
                <el-select
                  v-model="newBooking.iata"
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
import { postRequest } from '@/api/custom';
import { permissions } from '@/mixins/permissions';
import { picker } from '@/mixins/picker';

export default {
  name: 'NewBooking',
  mixins: [permissions, picker],
  data() {
    return {
      url: 'bookings',
      loading: false,
      newBooking: {
        status: 'Draft',
        bookingDate: '',
        customer: '',
      },
      rules: {
        customer: [
          { required: true, message: 'Please select a customer', trigger: 'change' },
        ],
        bookingDate: [
          { required: true, message: 'Please select a date', trigger: 'change' },
        ],
      },
    };
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.$confirm(`Are you sure you will not be able to modify any information later! `, 'Warning', {
            confirmButtonText: 'I am sure',
            cancelButtonText: 'Let me edit',
            type: 'warning',
          }).then(() => {
            this.loading = true;
            postRequest({ url: this.url, data: this.newSaleOrder }).then(async response => {
              this.loading = false;
              if (response.status) {
                this.$message({
                  showClose: true,
                  message: response.message,
                  type: 'success',
                });
                this.$refs[formName].resetFields();
                await this.$router.push('/orders/sales_orders/edit/' + response.id);
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
