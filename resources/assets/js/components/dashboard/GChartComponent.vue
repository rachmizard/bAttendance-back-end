<template>
  <div class="section">
    <form @submit.prevent="filter">
      <select name="filter" v-model="input.filter" @change="filter()">
        <option selected>Pilih Karyawan</option>
        <option v-for="(karyawan, index) in karyawans.data" :value="karyawan.id">{{ karyawan.nama }}</option>
      </select>
      <!-- <select name="bulan" v-model="input.bulan">
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>
      <button class="btn btn-sm">Filter Graph</button> -->
    </form>
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
      bulan: '',
      hadirJanuari: '',
      hadirFebruari: '',
      hadirMaret: '',
      hadirApril: '',
      hadirMei: '',
      hadirJuni: '',
      hadirJuli: '',
      hadirAgustus: '',
      hadirSeptember: '',
      hadirOktober: '',
      hadirNovember: '',
      hadirDesember: '',
      izinJanuari: '',
      izinFebruari: '',
      izinMaret: '',
      izinApril: '',
      izinMei: '',
      izinJuni: '',
      izinJuli: '',
      izinAgustus: '',
      izinSeptember: '',
      izinOktober: '',
      izinNovember: '',
      izinDesember: '',
      sakitJanuari: '',
      sakitFebruari: '',
      sakitMaret: '',
      sakitApril: '',
      sakitMei: '',
      sakitJuni: '',
      sakitJuli: '',
      sakitAgustus: '',
      sakitSeptember: '',
      sakitOktober: '',
      sakitNovember: '',
      sakitDesember: '',
      alfaJanuari: '',
      alfaFebruari: '',
      alfaMaret: '',
      alfaApril: '',
      alfaMei: '',
      alfaJuni: '',
      alfaJuli: '',
      alfaAgustus: '',
      alfaSeptember: '',
      alfaOktober: '',
      alfaNovember: '',
      alfaDesember: '',
      dinasJanuari: '',
      dinasFebruari: '',
      dinasMaret: '',
      dinasApril: '',
      dinasMei: '',
      dinasJuni: '',
      dinasJuli: '',
      dinasAgustus: '',
      dinasSeptember: '',
      dinasOktober: '',
      dinasNovember: '',
      dinasDesember: '',
      chartData: [
            ['Bulan', 'Hadir', 'Izin', 'Sakit', 'Alfa'],
            ['Pilih Karyawan...', parseInt(this.hadir), parseInt(this.izin), parseInt(this.sakit), parseInt(this.alfa)]
      ],
      chartOptions: {
        chart: {
          title: 'Graphic Statistic',
          subtitle: '2018',
        }
      },
      input: {
        filter: '',
        bulan: '',
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
      this.$root.loading = true;
       setInterval(() => {
        this.$root.loading = false
       }, 2000)
      axios.get('dashboard?filter='+ this.input.filter).then(response => {
          let data = response.data;
          this.hadirJanuari = response.data.total.total_hadir_januari;
          this.hadirFebruari = response.data.total.total_hadir_februari;
          this.hadirMaret = response.data.total.total_hadir_maret;
          this.hadirApril = response.data.total.total_hadir_april;
          this.hadirMei = response.data.total.total_hadir_mei;
          this.hadirJuni = response.data.total.total_hadir_juni;
          this.hadirJuli = response.data.total.total_hadir_juli;
          this.hadirAgustus = response.data.total.total_hadir_agustus;
          this.hadirSeptember = response.data.total.total_hadir_september;
          this.hadirOktober = response.data.total.total_hadir_oktober;
          this.hadirNovember = response.data.total.total_hadir_november;
          this.hadirDesember = response.data.total.total_hadir_desember;
          this.izinJanuari = response.data.total.total_izin_januari;
          this.izinFebruari = response.data.total.total_izin_februari;
          this.izinMaret = response.data.total.total_izin_maret;
          this.izinApril = response.data.total.total_izin_april;
          this.izinMei = response.data.total.total_izin_mei;
          this.izinJuni = response.data.total.total_izin_juni;
          this.izinJuli = response.data.total.total_izin_juli;
          this.izinAgustus = response.data.total.total_izin_agustus;
          this.izinSeptember = response.data.total.total_izin_september;
          this.izinOktober = response.data.total.total_izin_oktober;
          this.izinNovember = response.data.total.total_izin_november;
          this.izinDesember = response.data.total.total_izin_desember;
          this.sakitJanuari = response.data.total.total_sakit_januari;
          this.sakitFebruari = response.data.total.total_sakit_februari;
          this.sakitMaret = response.data.total.total_sakit_maret;
          this.sakitApril = response.data.total.total_sakit_april;
          this.sakitMei = response.data.total.total_sakit_mei;
          this.sakitJuni = response.data.total.total_sakit_juni;
          this.sakitJuli = response.data.total.total_sakit_juli;
          this.sakitAgustus = response.data.total.total_sakit_agustus;
          this.sakitSeptember = response.data.total.total_sakit_september;
          this.sakitOktober = response.data.total.total_sakit_oktober;
          this.sakitNovember = response.data.total.total_sakit_november;
          this.sakitDesember = response.data.total.total_sakit_desember;
          this.alfaJanuari = response.data.total.total_alfa_januari;
          this.alfaFebruari = response.data.total.total_alfa_februari;
          this.alfaMaret = response.data.total.total_alfa_maret;
          this.alfaApril = response.data.total.total_alfa_april;
          this.alfaMei = response.data.total.total_alfa_mei;
          this.alfaJuni = response.data.total.total_alfa_juni;
          this.alfaJuli = response.data.total.total_alfa_juli;
          this.alfaAgustus = response.data.total.total_alfa_agustus;
          this.alfaSeptember = response.data.total.total_alfa_september;
          this.alfaOktober = response.data.total.total_alfa_oktober;
          this.alfaNovember = response.data.total.total_alfa_november;
          this.alfaDesember = response.data.total.total_alfa_desember;
          this.dinasJanuari = response.data.total.total_dinas_januari;
          this.dinasFebruari = response.data.total.total_dinas_februari;
          this.dinasMaret = response.data.total.total_dinas_maret;
          this.dinasApril = response.data.total.total_dinas_april;
          this.dinasMei = response.data.total.total_dinas_mei;
          this.dinasJuni = response.data.total.total_dinas_juni;
          this.dinasJuli = response.data.total.total_dinas_juli;
          this.dinasAgustus = response.data.total.total_dinas_agustus;
          this.dinasSeptember = response.data.total.total_dinas_september;
          this.dinasOktober = response.data.total.total_dinas_oktober;
          this.dinasNovember = response.data.total.total_dinas_november;
          this.dinasDesember = response.data.total.total_dinas_desember;
          this.chartData = [
            ['Bulan', 'Hadir', 'Izin', 'Sakit', 'Alfa', 'Dinas'],
            ['Januari', parseInt(this.hadirJanuari), parseInt(this.izinJanuari), parseInt(this.sakitJanuari), parseInt(this.alfaJanuari), parseInt(this.dinasJanuari)],
            ['Februari', parseInt(this.hadirFebruari), parseInt(this.izinFebruari), parseInt(this.sakitFebruari), parseInt(this.alfaFebruari), parseInt(this.dinasFebruari)],
            ['Maret', parseInt(this.hadirMaret), parseInt(this.izinMaret), parseInt(this.sakitMaret), parseInt(this.alfaMaret), parseInt(this.dinasMaret)],
            ['April', parseInt(this.hadirApril), parseInt(this.izinApril), parseInt(this.sakitApril), parseInt(this.alfaApril), parseInt(this.dinasApril)],
            ['Mei', parseInt(this.hadirMei), parseInt(this.izinMei), parseInt(this.sakitMei), parseInt(this.alfaMei), parseInt(this.dinasMei)],
            ['Juni', parseInt(this.hadirJuni), parseInt(this.izinJuni), parseInt(this.sakitJuni), parseInt(this.alfaJuni), parseInt(this.dinasJuni)],
            ['Juli', parseInt(this.hadirJuli), parseInt(this.izinJuli), parseInt(this.sakitJuli), parseInt(this.alfaJuli), parseInt(this.dinasJuli)],
            ['Agustus', parseInt(this.hadirAgustus), parseInt(this.izinAgustus), parseInt(this.sakitAgustus), parseInt(this.alfaAgustus), parseInt(this.dinasAgustus)],
            ['September', parseInt(this.hadirSeptember), parseInt(this.izinSeptember), parseInt(this.sakitSeptember), parseInt(this.alfaSeptember), parseInt(this.dinasSeptember)],
            ['Oktober', parseInt(this.hadirOktober), parseInt(this.izinOktober), parseInt(this.sakitOktober), parseInt(this.alfaOktober), parseInt(this.dinasOktober)],
            ['November', parseInt(this.hadirNovember), parseInt(this.izinNovember), parseInt(this.sakitNovember), parseInt(this.alfaNovember), parseInt(this.dinasNovember)],
            ['Desember', parseInt(this.hadirDesember), parseInt(this.izinDesember), parseInt(this.sakitDesember), parseInt(this.alfaDesember), parseInt(this.dinasDesember)]
          ]
      }).then(resp => {
        this.$root.loading = true;
         setInterval(() => {
          this.$root.loading = false
         }, 2000)
      });
    }
  }
}

</script>
