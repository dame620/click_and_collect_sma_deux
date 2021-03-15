<template>
    <div class="page-4">
        <div class="wrapper">
            <div class="row">
                <div class="col-left background-4">
                <div class="banner-description-container">
                    <h2>OBTENEZ VOTRE QUOTATION EN 6 ETAPES!</h2>
                </div>
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
                        <a href="#">expediteur</a>
                    </li>
                    <li>
                        <a href="#" class="active">envoi</a>
                    </li>
                    <li>
                        <a href="#">destinataire</a>
                    </li>
                    <li>
                        <a href="#">options</a>
                    </li>
                    <li>
                        <a href="#">prix</a>
                    </li>
                    </ul>
                    <a href="javascript:void(0);" class="icon" @click="myFunction()">
                    <i class="fa fa-bars"></i>
                    </a>
                </nav>
                <div class="delivery-type">
                    <div class="delivery-type-container">
                    <div class="envelop">
                        <i class="icn-envelop"></i>
                        <label
                        >Enveloppe
                        <input type="checkbox" v-model="is_envelope"/>
                        <div class="checkbox"></div>
                        </label>
                    </div>
                    <div class="packet">
                        <i class="icn-packet"></i>
                        <label
                        >Paquet

                        <input type="checkbox" v-model="is_package"/>
                        <div class="checkbox"></div>
                        </label>
                    </div>
                    </div>
                </div>
                <div class="delivery-info-form">
                    <div class="delivery-info-form-container">
                    <div class="submit-container">
                        <button class="submit" @click.prevent="ongotoNextPage">
                        suivant <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <!--  <div class="my-last-btn">
                        <a><i class="fas fa-chevron-left "></i>RETOUR</a>
                        </div> -->
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="css" src="../styles/styles4.css"></style>

<script>
export default {
  watch: {
    is_envelope(value) {
      if (value == true) {
        this.is_package = false;
      }
    },

    is_package(value) {
      if (value == true) {
        this.is_envelope = false;
      }
    },
  },

  mounted() {
    console.log("Component mounted.");
    console.log("route for testing", this.$route.matched[0].parent);

  },

  data() {
    return {
      is_envelope: false,
      is_package: false,
    };
  },

  methods: {
    myFunction() {
      var x = document.getElementById("navbar");
      if (x.className === "navbar") {
        x.className += " responsive";
      } else {
        x.className = "navbar";
      }
    },

    ongotoNextPage() {
        if (this.is_package == true) {
            this.$router.push("/packageform");
        } else if (this.is_envelope == true) {
            this.$router.push("/envelopeform");
        }
    },
  },
};
</script>
