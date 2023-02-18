import { deleteRequest, getRequest } from '@/api/custom';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination

export const list = {
  components: { Pagination },
  data() {
    return {
      listUrl: '',
      list: [],
      listLoading: false,
      pageSizes: [10, 15, 20, 30, 50, 100],
      listQuery: {
        total: 0,
        page: 1,
        limit: 10,
        sortDirection: '',
        sortColumn: '',
      },
      pageFilters: {},
      selectedRows: [],
    };
  },
  methods: {
    async deleteRecord(data) {
      const response = await deleteRequest(this.listUrl + '/' + data.id);
      if (response.status) {
        this.$message({
          showClose: true,
          message: response.message,
          type: 'success',
        });
        await this.getList();
      } else {
        this.$message({
          showClose: true,
          message: response.message,
          type: 'error',
        });
      }
    },
    editRecord(data) {
      this.$router.push('/warehouse/locations/' + data.id);
    },
    async handleFilter() {
      this.listQuery.page = 1;
      await this.getList();
    },
    sortChange(data) {
      const { prop, order } = data;
      this.listQuery.sortColumn = prop;
      this.listQuery.sortDirection = order === 'ascending' ? 'asc' : 'desc';
      this.handleFilter().then();
    },
    async getList(start = false) { // fixed
      if (start) {
        this.listQuery.page = 1;
      }
      this.listLoading = true;
      const res = await getRequest({ url: this.listUrl, params: { ...this.listQuery, ...this.pageFilters }});
      this.list = res.data;
      this.listQuery.total = res.total;
      this.listLoading = false;
    },
    handleSelectionChange(val) {
      this.selectedRows = val;
    },
  },
};
