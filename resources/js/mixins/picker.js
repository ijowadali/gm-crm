import moment from 'moment';

export const picker = {
  data() {
    return {
      moment: moment(),
      pickerOptions: {
        shortcuts: [{
          text: 'Today',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().startOf('day').format()), new Date(moment().endOf('day').format())]);
          },
        }, {
          text: 'Yesterday',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().subtract(1, 'day').startOf('day').format()), new Date(moment().subtract(1, 'day').endOf('day').format())]);
          },
        }, {
          text: 'This Week',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().startOf('week').startOf('day').format()), new Date(moment().format()),
            ]);
          },
        }, {
          text: 'Last Week',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().subtract(1, 'week').startOf('week').format()), new Date(moment().subtract(1, 'week').endOf('week').format())]);
          },
        }, {
          text: 'This Month',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().startOf('month').format()), new Date(moment().format())]);
          },
        }, {
          text: 'Last Month',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().subtract(1, 'month').startOf('month').format()), new Date(moment().subtract(1, 'month').endOf('month').format())]);
          },
        }, {
          text: 'Past 30 Days',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().subtract(30, 'day').startOf('day').format()), new Date(moment().format())]);
          },
        }, {
          text: 'This Year',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().startOf('year').format()), new Date(moment().format())]);
          },
        }, {
          text: 'Last Year',
          onClick(picker) {
            picker.$emit('pick', [new Date(moment().subtract(1, 'year').startOf('year').format()), new Date(moment().subtract(1, 'year').endOf('year').format())]);
          },
        }],
      },
      date: [],
    };
  },
};
