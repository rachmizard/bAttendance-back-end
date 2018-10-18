<template>
  <div class="section">
    <select name="filter" v-model="input.data" @change="filter()">
      <option v-for="(karyawan, index) in karyawans.data" :value="karyawan.id">{{ karyawan.nama }}</option>
    </select>
   <GChart
      type="ColumnChart"
      :data="chartData"
      :options="chartOptions"
    ></GChart>
  </div>
</template>

<script>
import { GChart } from 'vue-google-charts'
export default {
  components: {
    GChart
  },
  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      karyawans: [],
      hadir: null,
      izin: null,
      sakit: null,
      alfa: null,
      chartData: [
        ['Bulan', 'Hadir', 'Izin', 'Sakit', 'alfa'],
        ['Januari', parseInt(this.hadir), parseInt(this.izin), parseInt(this.sakit), parseInt(this.alfa)],
      ],
      chartOptions: {
        chart: {
          title: 'Company Performance',
          subtitle: 'Sales, Expenses, and Profit: 2014-2017',
        }
      },
      input: {
        data: ''
      }
    }
  },
  mounted(){
      axios.get('karyawan/paginate').then(response => {
        this.karyawans = response.data;
      })
  },
  methods: {
    filter(){
      axios.get('dashboard?filter='+ this.input.data).then(response => {
        let data = response.data;
          this.hadir = parseInt(response.data.total.total_hadir);
          this.izin = parseInt(response.data.total.total_izin);
          this.sakit = parseInt(response.data.total.total_sakit);
          this.alfa = parseInt(response.data.total.total_alfa);
      });
    }
  }
}

</script>
