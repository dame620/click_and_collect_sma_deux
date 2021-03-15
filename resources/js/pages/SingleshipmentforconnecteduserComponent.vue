<template>
  <div class="wrapper">
    <div class="row">
      <div class="col-left">
        <img class="logo" src="assets/Africa picture.png" alt="" />
        <h2>BIENVENUE!</h2>
        <h3 style="color: white">SUR VOTRE ESPACE PERSONELLE</h3>
      </div>
      <div class="col-right">
        <div class="heart-icon">
          <i class="fas fa-heart"></i>
        </div>
        <nav class="navbar" id="navbar">
          <div class="express-container">
            <i class="icn-express"></i>
            <p class="express">Express</p>
          </div>
          <ul class="nav">
            <li>
              <button style="background-color: rgb(233, 154, 60); border: none">
                <a href="/check">DEMANDEZ UNE QUOTATION</a>
              </button>
            </li>

            <li>
              <button style="background-color: rgb(233, 154, 60); border: none">
                <a href="/checkforpickup">DEMANDEZ UN PICK UP</a>
              </button>
            </li>
            <li>
              <P>CLICK AND COLLECT</P>
            </li>
          </ul>
          <a href="javascript:void(0);" class="icon" @click="myFunction()">
            <i class="fa fa-bars"></i>
          </a>
        </nav>
        <div>
          <h1 style="margin-bottom: 20px">Liste de mes expéditions</h1>
          <div class="first-section-body">
            <table id="first-table">
              <tr>
                <th>Id</th>
                <th>Longueur</th>
                <th>Largeur</th>
                <th>Hauteur</th>
                <th>Poids</th>
                <th>Statu</th>
                <th>Tracking</th>
                <th>Contenu</th>
                <th>Action</th>
              </tr>
              <tr v-for="wrapper in wrappers" :key="wrapper.id">
                <td>{{ wrapper.id }}</td>
                <td>{{ wrapper.length }}</td>
                <td>{{ wrapper.width }}</td>
                <td>{{ wrapper.height }}</td>
                <td>{{ wrapper.weight }}</td>
                <td>{{ shipmentresponses.statu.libelles }}</td>
                <td>{{ wrapper.trackingnumber }}</td>
                <td>
                  <i
                    class="fas fa-eye"
                    @click.prevent="onopenmodal(wrapper.id)"
                  ></i>

                  <div class="modal_bg" :id="'modal_bg' + wrapper.id">
                    <div class="modal">
                      <table class="child_table">
                        <tr>
                          <th>Nature</th>
                          <th>Quantite</th>
                          <th>Description</th>
                          <th>Prix</th>
                        </tr>
                        <tr
                          v-for="product in wrapper.products"
                          :key="product.id"
                        >
                          <td>{{ product.product_type }}</td>
                          <td>{{ product.quantity }}</td>
                          <td>{{ product.description }}</td>
                          <td>{{ product.unit_price }}</td>
                        </tr>
                      </table>
                      <span
                        class="modal-close"
                        @click.prevent="onclosemodal(wrapper.id)"
                      >
                        X
                      </span>
                    </div>
                  </div>
                </td>
                <td v-if="ongetstatuvalid">
                <a href="#" @click.prevent="onsetlabelbase64(wrapper)">Afficher le label</a> <br>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    var route_id = this.$route.params.id;
    this.route_id = route_id;
    this.ongetshipmentpackages(route_id);
  },
  data() {
    return {
      test: null,
      route_id: null,
      isLoading: false,
      wrappers: null,
      shipmentresponses: null,
    };
  },

  computed:{

    ongetstatuvalid(){
      return this.shipmentresponses.statu.libelles==="EN ATTENTE REGLEMENT"
    }  
    
  },
  methods: {
    ongetshipmentpackages(id) {
      axios
        .get(`/shipment/${id}`)
        .then((response) => {
          //recuperation shipmet
          const shipmentresponses = response.data.data;
          this.shipmentresponses = shipmentresponses;
          console.log("this in the shipment", this.shipmentresponses);
          //recuperation wrappers
          const wrappers = response.data.data.packageorenvelops;
          this.wrappers = wrappers;
          //filtrer pour formater le prix
          /* this.wrappers.forEach(wrapper => {
              wrapper.products.forEach(product => {
               // product.unit_price=product.unit_price.toLocaleString('it-IT', {style: 'currency', currency: 'XOF'})
                this.test=product.unit_price.toLocaleString('it-IT', {style: 'currency', currency: 'XOF'})
                console.log("test price",this.test)
              });
          });*/
          //fin filtrer pour formater le prix
          console.log("this is the wrapper", this.wrappers);
        })
        .catch(({ message }) => {
          this.$toast.error(message);
        })
        .finally((_) => {});
    },

    onsetlabelbase64(wrapper) {
      const base64 = wrapper.labelbase64;
     // const base64 = wrapper.labelbase64;
      if (base64 === undefined || base64 === null) {
        return;
      }

      sessionStorage.setItem("labelbase64", base64);

      this.$router.push("/dhllabel");
    },

    onopenmodal(wrapper_id) {
      var modalbg = document.querySelector(`#modal_bg${wrapper_id}`);
      return modalbg.classList.add("bg-active");
    },

    onclosemodal(wrapper_id) {
      var modalbg = document.querySelector(`#modal_bg${wrapper_id}`);
      return modalbg.classList.remove("bg-active");
    },
  },
};
</script>


<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600;700;800;900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

table {
  border-collapse: collapse;
}

.container {
  font-family: "Poppins", sans-serif;
}

.invoice-title {
  display: flex;
  justify-content: center;
}

.invoice-title h2 {
  border: 1px solid;
  margin-bottom: 25px;
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
/*Css modal*/
.modal_bg {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s, opacity 0.5s;
}

.bg-active {
  visibility: visible;
  opacity: 1;
}

.modal {
  position: relative;
  width: 40%;
  height: 40%;
  background-color: white;
  display: flex;
  align-items: center;
  justify-content: center; /*space-around*/
  flex-direction: column;
}

.modal button {
  padding: 10px 20px;
  background-color: blue;
  color: white;
  cursor: pointer;
  border: none;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}

.modal-close:hover {
  color: red;
}

/*style coming from myaccount*/
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    background-color:#fff;
}
.table td,
.table th {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}
.table-sm td,
.table-sm th {
    padding: 0.3rem;
}
.table-bordered {
    border: 1px solid #dee2e6;
}
.table-bordered td,
.table-bordered th {
    border: 1px solid #dee2e6;
}
.table-bordered thead td,
.table-bordered thead th {
    border-bottom-width: 2px;
}
.table-borderless tbody + tbody,
.table-borderless td,
.table-borderless th,
.table-borderless thead th {
    border: 0;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}
.table-hover tbody tr:hover {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
}
.table-primary,
.table-primary > td,
.table-primary > th {
    background-color: #b8daff;
}
.table-primary tbody + tbody,
.table-primary td,
.table-primary th,
.table-primary thead th {
    border-color: #7abaff;
}
.table-hover .table-primary:hover {
    background-color: #9fcdff;
}
.table-hover .table-primary:hover > td,
.table-hover .table-primary:hover > th {
    background-color: #9fcdff;
}
.table-secondary,
.table-secondary > td,
.table-secondary > th {
    background-color: #d6d8db;
}
.table-secondary tbody + tbody,
.table-secondary td,
.table-secondary th,
.table-secondary thead th {
    border-color: #b3b7bb;
}
.table-hover .table-secondary:hover {
    background-color: #c8cbcf;
}
.table-hover .table-secondary:hover > td,
.table-hover .table-secondary:hover > th {
    background-color: #c8cbcf;
}
.table-success,
.table-success > td,
.table-success > th {
    background-color: #c3e6cb;
}
.table-success tbody + tbody,
.table-success td,
.table-success th,
.table-success thead th {
    border-color: #8fd19e;
}
.table-hover .table-success:hover {
    background-color: #b1dfbb;
}
.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
    background-color: #b1dfbb;
}
.table-info,
.table-info > td,
.table-info > th {
    background-color: #bee5eb;
}
.table-info tbody + tbody,
.table-info td,
.table-info th,
.table-info thead th {
    border-color: #86cfda;
}
.table-hover .table-info:hover {
    background-color: #abdde5;
}
.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
    background-color: #abdde5;
}
.table-warning,
.table-warning > td,
.table-warning > th {
    background-color: #ffeeba;
}
.table-warning tbody + tbody,
.table-warning td,
.table-warning th,
.table-warning thead th {
    border-color: #ffdf7e;
}
.table-hover .table-warning:hover {
    background-color: #ffe8a1;
}
.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
    background-color: #ffe8a1;
}
.table-danger,
.table-danger > td,
.table-danger > th {
    background-color: #f5c6cb;
}
.table-danger tbody + tbody,
.table-danger td,
.table-danger th,
.table-danger thead th {
    border-color: #ed969e;
}
.table-hover .table-danger:hover {
    background-color: #f1b0b7;
}
.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
    background-color: #f1b0b7;
}
.table-light,
.table-light > td,
.table-light > th {
    background-color: #fdfdfe;
}
.table-light tbody + tbody,
.table-light td,
.table-light th,
.table-light thead th {
    border-color: #fbfcfc;
}
.table-hover .table-light:hover {
    background-color: #ececf6;
}
.table-hover .table-light:hover > td,
.table-hover .table-light:hover > th {
    background-color: #ececf6;
}
.table-dark,
.table-dark > td,
.table-dark > th {
    background-color: #c6c8ca;
}
.table-dark tbody + tbody,
.table-dark td,
.table-dark th,
.table-dark thead th {
    border-color: #95999c;
}
.table-hover .table-dark:hover {
    background-color: #b9bbbe;
}
.table-hover .table-dark:hover > td,
.table-hover .table-dark:hover > th {
    background-color: #b9bbbe;
}
.table-active,
.table-active > td,
.table-active > th {
    background-color: rgba(0, 0, 0, 0.075);
}
.table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
}
.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
}
.table .thead-dark th {
    color: #fff;
    background-color: #343a40;
    border-color: #454d55;
}
.table .thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
.table-dark {
    color: #fff;
    background-color: #343a40;
}
.table-dark td,
.table-dark th,
.table-dark thead th {
    border-color: #454d55;
}
.table-dark.table-bordered {
    border: 0;
}
.table-dark.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(255, 255, 255, 0.05);
}
.table-dark.table-hover tbody tr:hover {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.075);
}
@media (max-width: 575.98px) {
    .table-responsive-sm {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-responsive-sm > .table-bordered {
        border: 0;
    }
}
@media (max-width: 767.98px) {
    .table-responsive-md {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-responsive-md > .table-bordered {
        border: 0;
    }
}
@media (max-width: 991.98px) {
    .table-responsive-lg {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-responsive-lg > .table-bordered {
        border: 0;
    }
}
@media (max-width: 1199.98px) {
    .table-responsive-xl {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-responsive-xl > .table-bordered {
        border: 0;
    }
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.table-responsive > .table-bordered {
    border: 0;
}

.btn.btn-success {
  background-color: rgb(189, 37, 151);
  color: blanchedalmond;
  width: 170px;
}

.btn.btn-success a:hover {
  cursor: pointer;
  text-decoration: underline;
  color: red;
}
</style>