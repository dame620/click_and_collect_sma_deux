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
        <p>Nom: {{ first_name }}</p>
        <p>Nom: {{ last_name }}</p>
        <p>Email: {{ email }}</p>
        <p>Email: {{ telephone }}</p>
        <p>Entreprise: {{ company_name }}</p>
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
          <h4>PRIX TOTAL DE L'EXPEDITION: {{ sum_for_total_price }} CFA</h4>
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

    this.wrappers.forEach((wrapper) => {
      wrapper.width = wrapper.width.replace(/,/g, ".");
      wrapper.height = wrapper.height.replace(/,/g, ".");
      wrapper.weight = wrapper.weight.replace(/,/g, ".");
      wrapper.length = wrapper.length.replace(/,/g, ".");
    });

    const formattedWrappers = wrappers.map(function (wrapper) {
      return {
        width: Number(wrapper.width),
        height: Number(wrapper.height),
        weight: Number(wrapper.weight),
        length: Number(wrapper.length),
        origincountry: wrapper.origincountry,
        destinationcountry: wrapper.destinationcountry,
        originregion: wrapper.originregion,
        destinationregion: wrapper.destinationregion,
        pickupdate: wrapper.pickupdates,
      };
    });
    console.log(formattedWrappers);

    /*formattedWrappers.push({
            width: 19,
            height:11,
            weight: 6,
            length: 17,
        });*/

    const headers = new Headers();
    headers.append("Content-Type", "application/json");
    headers.append("X-CSRF-TOKEN", window.csrfContent);

    const options = {
      method: "POST",
      headers: headers,
      body: JSON.stringify({
        packages: formattedWrappers,
      }),
    };

    const request = new Request("/get-rates", options);

    fetch(request, options)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        let responses = data.responses;
        //data.responses[0].products[0].totalPrice[0].price
        this.responses = responses;
        var table_for_price = [];
        responses.forEach((response) => {
          /*products.forEach(product=>{
                    const prix=product.totalPrice[0].price;
                    console.log("test produit", prix);
                    table_for_price.push(prix);
               })*/

          const product = response.products[0];
          const prix = product.totalPrice[0].price;
          console.log("prix hors taxe sma", prix);
          table_for_price.push(prix);
        });
        console.log(table_for_price);
        var sum_for_total_price = table_for_price.reduce(function (
          acc,
          number
        ) {
          return acc + number;
        },
        0);
        console.log(
          (sum_for_total_price = Math.round(sum_for_total_price * 1.416))
        );
        this.sum_for_total_price = sum_for_total_price.toLocaleString("it-IT");
      });

    /*fetch('/rates'){}
        .then(response => response.json())
        .then(data => {
            const response = data.response
            let product_detail = (JSON.parse(response))
            console.log(product_detail);
            let productPrice=(product_detail.products[0].totalPrice[0].price);
            this.productPrice = productPrice;
            
        });*/

    //get the name
    var first_name = null;
    first_name = JSON.parse(sessionStorage.getItem("first_name"));
    if (first_name != null && first_name != undefined) {
      this.first_name = first_name;
    }

    //get the name
    var last_name = null;
    last_name = JSON.parse(sessionStorage.getItem("last_name"));
    if (last_name != null && last_name != undefined) {
      this.last_name = last_name;
    }
    //get the telephone number
    var telephone = null;
    telephone = JSON.parse(sessionStorage.getItem("telephone"));
    if (telephone != null && telephone != undefined) {
      this.telephone = telephone;
    }

    //get the email
    var email = null;
    email = JSON.parse(sessionStorage.getItem("email"));
    if (email != null && email != undefined) {
      this.email = email;
    }

    //get the companie name
    var company_name = null;
    company_name = JSON.parse(sessionStorage.getItem("company_name"));
    if (company_name != null && company_name != undefined) {
      this.company_name = company_name;
    }

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
      company_name: null,
      first_name: null,
      last_name: null,
      email: null,
      telephone: null,
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
        filename: "facture_SMA12129_A_2TuT.pdf",
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