<template>
  <div class="app-container">
    <el-row :gutter="10" class="panel-group" style="margin-top:0;margin-bottom: 5px">
      <el-col :lg="3" :sm="12" :xs="24" class="card-panel-col">
        <el-input
          v-model="pageFilters.bookingNo"
          clearable
          placeholder="Order No"
          size="mini"
          style="width: 100%"
        />
      </el-col>
      <el-col :lg="3" :sm="12" :xs="24" class="card-panel-col">
        <el-select
          v-model="pageFilters.status"
          clearable
          multiple
          placeholder="Status"
          size="mini"
          style="width: 100%"
        >
          <el-option
            v-for="item in [{name:'Draft',value:'Draft'},{name:'Requested',value:'Requested'},{name:'Approved',value:'Approved'},{name:'Business Approval',value:'Business Approval'},{name:'Place Order',value:'Place Order'},{name:'Dispatched',value:'Dispatched'},{name:'Delivered',value:'Delivered'}]"
            :key="item.name"
            :label="item.name"
            :value="item.value"
          />
        </el-select>
      </el-col>
      <el-col :lg="9" :sm="12" :xs="24" class="card-panel-col">
        <el-date-picker
          v-model="pageFilters.date"
          end-placeholder="End date"
          range-separator="To"
          size="mini"
          start-placeholder="Start date"
          type="daterange"
        />
      </el-col>
      <el-col :lg="2" :sm="12" :xs="24" class="card-panel-col">
        <el-button icon="el-icon-search" size="mini" type="primary" @click="getList(true)">Get</el-button>
      </el-col>
    </el-row>
    <el-table
      v-loading="listLoading"
      :data="list"
      :default-sort="{prop: 'created_at', order: 'descending'}"
      border
      style="width: 100%"
      @sort-change="sortChange"
      @selection-change="handleSelectionChange"
    >
      <el-table-column
        align="center"
        label="Booking No"
        prop="booking_no"
        show-overflow-tooltip
        sortable="custom"
        width="300"
      >
        <template v-slot="{row}">
          <router-link :to="'/bookings/add_booking?id='+row.id" target="_blank">
            <el-link type="success">
              {{ row.booking_no }}
            </el-link>
          </router-link>
        </template>
      </el-table-column>
      <el-table-column
        align="center"
        label="Customer"
        prop="quantity"
        sortable="custom"
        width="200"
      >
        <template v-slot="{row}">
          <el-tag type="primary">{{ row.customer_name }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column
        align="center"
        label="Group"
        prop="group"
        sortable="custom"
        width="200"
      >
        <template v-slot="{row}">
          <el-tag type="primary">{{ row.group_name }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column
        align="center"
        label="Action"
        prop="status"
        sortable="custom"
        width="140"
      >
        <template v-slot="{row}">
          <el-dropdown v-if="(row.status !== 'Completed')" trigger="click">
            <span class="el-dropdown-link">
              Actions<i class="el-icon-arrow-down el-icon--right" />
            </span>
            <el-dropdown-menu v-slot="dropdown">
              <router-link :to="'/bookings/print_booking?id='+row.id" target="_blank">
                <el-link type="success">
                  <el-dropdown-item icon="el-icon-tickets">Print Voucher</el-dropdown-item>
                  <el-dropdown-item icon="el-icon-tickets">Edit</el-dropdown-item>
                </el-link>
              </router-link>
              <span @click="deleteBooking(row.id)">
                <el-dropdown-item icon="el-icon-tickets">Delete</el-dropdown-item>
              </span>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
    </el-table>
    <pagination
      v-show="listQuery.total>0"
      :auto-scroll="false"
      :limit.sync="listQuery.limit"
      :page-sizes="pageSizes"
      :page.sync="listQuery.page"
      :total="listQuery.total"
      @pagination="getList(false)"
    />
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

import { list } from '@/mixins/list';
import { deleteRequest } from '@/api/custom';

export default {
  name: 'BookingsList',
  // components: { Pagination },
  mixins: [list],
  data() {
    return {
      listUrl: 'bookings/',
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
      },
    };
  },
  async mounted() {
    await this.getList(true);
  },
  methods: {
    async deleteBooking(id) {
      const response = await deleteRequest(this.listUrl + id);
      if (response.status) {
        this.$message({
          showClose: true,
          message: response.message,
          type: 'success',
        });
        await this.getList(true);
      } else {
        this.$message({
          showClose: true,
          message: response.message,
          type: 'error',
        });
      }
    },
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
