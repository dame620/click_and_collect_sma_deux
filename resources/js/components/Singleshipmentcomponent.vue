<template>
  <div class="container">
    <div class="invoice-title">
      <h2>Liste des Expedions</h2>
    </div>

    <div class="invoice-body">
      <div class="invoice-body-first-section">
        <div class="first-section-title">
          <!--h2>Total Expeditions {{ wrapperlength }}</h2-->
        </div>
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
              <td>{{ shipmentresponses.trackingnumber }}</td>
              <td>
                <i class="fas fa-eye" @click.prevent="onopenmodal(wrapper.id)"></i>

                <div class="modal_bg" :id="'modal_bg' + wrapper.id">
                  <div class="modal">
                    <table class="child_table">
                      <tr>
                        <th>Nature</th>
                        <th>Quantite</th>
                        <th>Description</th>
                        <th>Prix</th>
                      </tr>
                      <tr v-for="product in wrapper.products" :key="product.id">
                        <td>{{ product.product_type }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.unit_price }} F CFA</td>
                      </tr>
                    </table>
                    <span class="modal-close" @click.prevent="onclosemodal(wrapper.id)"
                      >
                      X
                    </span>
                  </div>
                </div>
              </td>
              <td><router-link to="/">EDITER</router-link><br /></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    var route_id = this.$route.params.id;
    this.ongetshipmentpackages(route_id);
  },
  data() {
    return {
      isLoading: false,
      wrappers: null,
      shipmentresponses: null,
    };
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
          console.log("this is the wrapper", this.wrappers);
        })
        .catch(({ message }) => {
          this.$toast.error(message);
        })
        .finally((_) => {});
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
</style>