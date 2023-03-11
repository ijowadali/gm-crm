<template>
  <div v-loading="loading" class="app-container">
    <el-form
      ref="newHotel"
      :model="newHotel"
      :rules="rules"
      class="demo-purchaseOrder"
      label-position="top"
      label-width="120px"
      size="mini"
    >
      <el-card shadow="never" style="margin-bottom: 10px">
        <div slot="header" class="clearfix">
          <h4 style="margin: 0px 0px;">Hotels Details</h4>
        </div>
        <div style="padding: 10px">
          <!--          <el-divider content-position="left"><h3>Hotels Details</h3></el-divider>-->
          <el-row :gutter="15">
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Hotel Name" prop="hotel_name" size="mini">
                <el-input v-model="newHotel.hotel_name" placeholder="Please Enter Hotel Name" size="mini" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="City" prop="city" size="mini">
                <el-select
                  v-model="newHotel.city"
                  size="mini"
                  style="width: 100%"
                >
                  <el-option
                    v-for="item in ['Medinah','Makkah']"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Primary Phone Number" prop="primary_phone" size="mini">
                <el-input v-model="newHotel.primary_phone" placeholder="Please Enter Primary Phone Number" size="mini" />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Secondary Phone Number" prop="secondary_phone" size="mini">
                <el-input
                  v-model="newHotel.secondary_phone"
                  placeholder="Please Enter Secondary Phone Number"
                  size="mini"
                />
              </el-form-item>
            </el-col>
            <el-col :lg="8" :md="12" :sm="24" class="card-panel-col">
              <el-form-item label="Address" prop="address" size="mini">
                <el-input
                  v-model="newHotel.address"
                  placeholder="Please Enter Address"
                  size="mini"
                />
              </el-form-item>
            </el-col>
          </el-row>
        </div>
      </el-card>
      <el-form-item>
        <el-button type="primary" @click="submitForm('newHotel')">Create</el-button>
        <el-button @click="resetForm('newHotel')">Reset</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import { getRequest, postRequest } from '@/api/custom';

export default {
  name: 'NewHotel',
  data() {
    return {
      url: 'hotels/',
      loading: false,
      newHotel: {
        hotel_name: '',
        city: '',
        primary_phone: '',
        secondary_phone: '',
        address: '',
      },
      rules: {
        hotel_name: [
          { required: true, message: 'Please Enter Hotel Name', trigger: 'change' },
        ],
        city: [
          { required: true, message: 'Please select a City', trigger: 'change' },
        ],
        primary_phone: [
          { required: true, message: 'Please Enter Primary Phone Number', trigger: 'change' },
        ],
      },
    };
  },
  mounted() {
    if (this.$route.query.id) {
      this.getHotelData();
    }
  },
  methods: {
    async getHotelData() {
      const response = await getRequest({ url: this.url + this.$route.query.id }).catch(_ => {
        this.loading = false;
      });
      if (response.status) {
        this.newHotel = response.data;
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
            postRequest({ url: this.url, data: this.newHotel }).then(async response => {
              this.loading = false;
              if (response.status) {
                this.$message({
                  showClose: true,
                  message: response.message,
                  type: 'success',
                });
                this.$refs[formName].resetFields();
                if (this.$route.query.id) {
                  await this.getHotelData();
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
