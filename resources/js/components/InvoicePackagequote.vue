<template>
  <div class="container" ref="container">
    <div ref="downloador_btn">
      <button @click.prevent="onDownloadInvoice($event)">telecharger</button>
    </div>
    <div class="invoice-header">
      <div class="invoice-header-left">
        <img
          src="./assets/Africa logo.png"
          width="100px"
          height="90px"
          alt="logo click and collect"
          srcset=""
        />
      </div>
      <div class="invoice-header-right">
        <span class="invoice-header-right-head">De</span>
        <span>
          <h1>SHOPMEAWAY SAS</h1>
          <p>SICAP MERMOZ VILLA 76666</p>
          <p>RCS: SN DKR 2019B 22025</p>
          <P>TEL:33 868 39 18</P>
        </span>
      </div>
    </div>

    <div class="invoice-title">
      <h2>FACTURE PROFORMA</h2>
    </div>

    <div class="invoice-info">
      <div class="invoice-info-left">
        <h4>POUR</h4>
        <p>Nom: {{ data_for_invoice.full_name }}</p>
        <p>Email: {{ data_for_invoice.email }}</p>
        <p>Telephone: {{ data_for_invoice.telephone }}</p>
        <p>Entreprise: {{ data_for_invoice.company_name }}</p>
      </div>
      <div class="info-info-right">
        <h3>Facture EMISE</h3>
        <h6>le: {{ currentDate }}</h6>
      </div>
    </div>

    <div class="invoice-body">
      <div class="invoice-body-first-section">
        <div class="first-section-title">
          <h2>Colis Facturé</h2>
        </div>
        <div class="first-section-body">
          <table
            id="first-table"
            v-for="(wrapper, wrapper_index) in wrappers"
            :key="wrapper_index"
          >
            <tr>
              <th>NUMERO PAQUET</th>
              <th>poids</th>
              <th>largeur</th>
              <th>hauteur</th>
              <th>longueur</th>
            </tr>
            <tr>
              <td>{{ wrapper_index + 1 }}</td>
              <td>{{ wrapper.weight }}</td>
              <td>{{ wrapper.width }}</td>
              <td>{{ wrapper.height }}</td>
              <td>{{ wrapper.length }}</td>
              <!--td>{{ responses[wrapper_index].products[0].totalPrice[0].price }}CFA</td-->
            </tr>
          </table>
        </div>
      </div>
      <div class="invoice-body-second-section">
        <div class="second-section-title">
          <h4>PRIX TOTAL DE L'EXPEDITION: {{ sum_for_total_price }}</h4>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    //recuperation des infos du paquet
    const jsonWrappers = sessionStorage.getItem("wrappers");
    let wrappers = null;

    if (jsonWrappers != null && jsonWrappers != undefined) {
      wrappers = JSON.parse(jsonWrappers);
    }

    this.wrappers = wrappers;
    if (wrappers != null) {
      console.log(wrappers);
    }
this.wrappers.forEach(wrapper=>{
  this.sum_for_total_price=(wrapper.sum_for_total_price_for_invoice.toLocaleString('it-IT', {style: 'currency', currency: 'XOF'}))

})

    //get the name
    var data_for_invoice = null;
    data_for_invoice = JSON.parse(sessionStorage.getItem("data_for_invoice"));
    if (data_for_invoice != null && data_for_invoice != undefined) {
      this.data_for_invoice = data_for_invoice;
    }
    //get the telephone number
   

    function addScript(url) {
      var script = document.createElement("script");
      script.type = "application/javascript";
      script.src = url;
      document.head.appendChild(script);
    }
    addScript(
      "https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"
    );
  },

  data() {
    return {
      wrappers: null,
      data_for_invoice:{},
      responses: null,
      table_for_price: null,
      sum_for_total_price: null,
      //  data:null
    };
  },

  computed: {
    currentDate() {
      const date = new Date();
      return Intl.DateTimeFormat("fr-FR", { dateStyle: "full" }).format(date);
    },
  },

  methods: {
    onDownloadInvoice(event) {
      const opt = {
        margin: 1,
        filename: "facture_CAC121_A_2TuT.pdf",
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
      };

      event.target.style.display = 'none';
	  html2pdf(this.$refs.container, opt);
    },

  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600;700;800;900&display=swap");

* {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.invoice-header {
  display: flex;
  justify-content: space-around;
  margin-bottom: 50px;
}

/*.invoice-header .invoice-header-right-head{
    border-right: 1px solid;
}*/

.invoice-title {
  display: flex;
  justify-content: center;
}

.invoice-title h2 {
  border: 1px solid;
  margin-bottom: 90px;
}

.invoice-info {
  display: flex;
  justify-content: space-around;
  margin-bottom: 50px;
}

.invoice-body-first-section {
  margin-bottom: 20px;
}

.first-section-title {
  display: flex;
  justify-content: center;
  width: 100%;
  background-color: gray;
}

.first-section-body {
  width: 100%;
}

#first-table {
  width: 100%;
  margin-top: 2px;
}

tr th {
  border: 2px solid;
}

tr td {
  border: 1px solid;
}

.invoice-body-second-section {
  margin-bottom: 25px;
}
.second-section-title {
  display: flex;
  justify-content: center;
  width: 100%;
  background-color: black;
}

.second-section-title h4 {
  color: white;
  padding: 15px;
}

#second-table {
  width: 100%;
  margin-bottom: 5px;
  margin-top: 1px;
}
</style>