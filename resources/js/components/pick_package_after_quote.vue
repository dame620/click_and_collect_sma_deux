<template>
    <form @submit.prevent="onSubmitPackageForm" ref="packageForm">  
        <div class="page-5">
    <div class="wrapper">
      

      <div class="row">
        <div class="col-left background-2">
          <div class="banner-description-container">
            <p>BRAVO VS ETES À UN PAS DE TERMINER VOTRE DEMANDE DE PICK UP!</p>
            <h2>ETAPE 3/3 </h2>
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
            <a href="javascript:void(0);" class="icon" v-on:click="myFunction()">
              <i class="fa fa-bars"></i>
            </a>
          </nav>
          <div class="option-container">
            <label class="styled-checkbox">
              <span>Si la valeur à assurer est supérieure à 200€ un  Coût supplémentaire d'assurance de (1%) s'applique</span><br>
              <input type="checkbox" v-model="datachecker" name="" id="" />
              <div class="checkbox"></div>
            </label>
            <label class="styled-checkbox">
              <span>Les droits de douane et la TVA ne sont pas inclus dans les coûts de transport</span>
              <input type="checkbox" v-model="datachecker" name="" id="" />
              <div class="checkbox"></div>
            </label>
            <label class="styled-checkbox">
                <i class="fas fa-hand-point-down"></i>

                <span>Cliquez ici en bas pour enregistrer</span>
                <i class="fas fa-hand-point-down"></i>
            </label>
            <button type="submit" class="btn-retour">
               ENREGISTRER
            </button>
          </div>
        </div>
      </div>
  
    </div>
    
  </div>
    </form>
</template>

<script>
    export default {

             mounted() {
            
            const jsonWrappers = sessionStorage.getItem('wrappers');
            let wrappers = null

            if (jsonWrappers != null && jsonWrappers != undefined) {
                wrappers = JSON.parse(jsonWrappers);
            }
            if(wrappers!=null){
                this.wrappers = wrappers;
            }
               console.log('wrapers test', this.wrappers);

               //Start GO the get quote api dhl for getting price
                     //fin de recupération des données
        //fetch request

               //End go to the get quote dhl api for getting price


        },
       

        props: ['path'],
        data() {
            return {
                datachecker:true,
                wrappers:null,
                loading: false,
                responses:null,
                sum_for_total_price:null,
                sum_for_total_price_all_taxe:null,
            }
        },
       /* computed: {
            wrappers_count() {
                return this.wrappers.length;
            },
        },*/
        methods: {
           
            resetForm() {
                this.wrappers = this.wrappers
            },
           
           myFunction() {
            var x = document.getElementById("navbar");
            if (x.className === "navbar") {
            x.className += " responsive";
            } else {
            x.className = "navbar";
            }
             },
           
            
            onSubmitPackageForm() {
                
                this.loading = true;
                console.log('wrappers est', this.wrappers)
                axios.post('/package', {
                    data: this.wrappers
                }).then(({data}) => {
                   
                   if(data.products.length<1){
                     alert("veuillez renseigner au moins un produit")  
                   };
                    if (data.success && data.wrappers.length > 0 && data.products.length > 0) {
                        this.resetForm();
                         alert('VOTRE DEMANDE DE PICK UP A ÉTÉ ENREGISTRÉE AVEC SUCCES');
                       // sessionStorage.removeItem('wrappers');
                        
                        this.$router.push('/mon-compte');

                    }
                }).catch(response => {
                    alert('oups echec de l\'ajout');
                    console.error(response);
                }).finally(_ => {
                   this.loading = false; 
                });
                
            },
        },
       
    }
</script>


<style scoped>
/*
* Prefixed by https://autoprefixer.github.io
* PostCSS: v7.0.29,
* Autoprefixer: v9.7.6
* Browsers: last 4 version
*/


/*
* Prefixed by https://autoprefixer.github.io
* PostCSS: v7.0.29,
* Autoprefixer: v9.7.6
* Browsers: last 4 version
*/

* {
    padding: 0;
    margin: 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  
  .active {
    font-weight: bold;
  }
  .show {
    display: block !important;
  }
  body {
    font-family: "Work Sans", sans-serif;
    font-size: 16px;
    color: #3a3635;
  }
  
  .styled-checkbox {
    font-weight: 500;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    cursor: pointer;
  }
  .styled-checkbox input[type="checkbox"] {
    font-size: 15px;
    margin-top: 5px;
    display: none;
  }
  .styled-checkbox .checkbox {
    min-height: 20px;
    min-width: 20px;
    height: 20px;
    width: 20px;
    -webkit-box-shadow: 0 0 5px 1px #ddd;
            box-shadow: 0 0 5px 1px #ddd;
    display: inline-block;
    position: relative;
    margin: 0;
  }
  .styled-checkbox input[type="checkbox"]:checked + .checkbox {
    background-color: #000;
  }
  .styled-checkbox input[type="checkbox"]:checked + .checkbox::after {
    content: "\2714";
    color: #fff;
    font-size: 18px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
  }
  
  .wrapper {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
  }
  
  header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding: 0 50px;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    background-color: #fff;
  }
  
  header .language {
    max-width: 180px;
    text-align: right;
    position: relative;
  
    margin: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-pack: end;
        -ms-flex-pack: end;
            justify-content: flex-end;
    padding-bottom: 10px;
  }
  header .language .language-toggle {
    padding: unset;
  }
  header .logo {
    max-width: 130px;
  }
  @media screen and (max-width: 600px) {
  header .logo {
    max-width: 110px;
  }
}
  
  header .follow-container {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-pack: end;
        -ms-flex-pack: end;
            justify-content: flex-end;
    padding-bottom: 10px;
  }
  
  header .follow-container h3 {
    text-align: center;
    padding: 10px;
  }
  
  header .follow-container .social-icon-container a {
    height: 25px;
    width: 25px;
    line-height: 25px;
  }
  
  header .follow-container .social-icon-container a i {
    font-size: 15px;
  }
  
  .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    -webkit-box-flex: 2;
    -ms-flex-positive: 2;
    flex-grow: 2;
  }
  
  .col-left {
    background-image: url("./assets/Picture.png");
    background-position: right center;
    background-repeat: no-repeat;
    background-size: cover;
  
    display: -webkit-box;
  
    display: -ms-flexbox;
  
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 30px;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  

  .col-left .logo {
    max-width: 260px;
  }
  .col-left h2 {
    color: #fff;
    font-size: 48px;
    position: relative;
    margin: 15px 0;
    padding-bottom: 20px;
  }
  .col-left h2::after {
    content: "";
    display: block;
    position: absolute;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    bottom: 0;
    height: 5px;
    width: 90px;
    background-color: #fff;
  }
  
  .col-right {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
    overflow: auto;
    padding: 20px;
  }
  .background-2 {
    background-image: url("./assets/Picture-2.png");
    background-size: 100% 100%;
  }
  
  .language {
    margin: 0 30px 30px auto;
    max-width: 180px;
    text-align: right;
    position: relative;
  }
  .language-toggle {
    border: none;
    text-transform: uppercase;
  
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    background: url("./assets/drop-down-arrow.png") right center no-repeat;
    background-size: 15px;
    padding: 10px 20px;
  }
  
  .connection-container {
    width: 260px;
    margin: 40px auto;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    max-height: 100%;
  }
  
  .connection-container-fluid {
    width: 100%;
    max-width: 460px;
    /* width: 460px; */
  }
  
  .connection-container form h3 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 30px;
  }
  .form-group-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    /* margin: 0 -10px; */
  }
  .form-group {
    margin-bottom: 20px;
    padding: 0 10px;
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
  }
  
  .address-field {
    width: 100%;
  }
  .form-group label {
    font-weight: 600;
    color: #3a3635;
    margin-bottom: 5px;
    display: block;
  }
  .form-group input {
    height: auto;
    padding: 15px;
    border: 2px solid #cdcdcb;
    border-radius: 2px;
    width: 100%;
  }
  
  .btn-connection {
    padding: 15px;
    width: calc(100% + 100px);
    margin-left: -50px;
    background-color: #eb954b;
    margin-top: 15px;
    margin-bottom: 20px;
    border: none;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 15px;
    cursor: pointer;
  }
  
  .forgot-password,
  .forgot-password a {
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    color: #3a3635;
  }
  
  .line-heading {
    position: relative;
    text-align: center;
    margin: 30px 0;
  }
  .line-heading span {
    display: inline-block;
    background-color: #fff;
    padding: 10px 25px;
    font-size: 18px;
    font-weight: 600;
    color: #4b4748;
    position: relative;
    z-index: 1;
  }
  .line-heading::after {
    content: "";
    display: block;
    border-top: 1px solid #3a3635;
    position: absolute;
    left: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    width: 100%;
  }
  .social-connection-container {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 80%;
    margin: 0 auto;
    text-align: center;
  }
  
  .btn-connection-google {
    padding: 15px 0px;
    width: calc(100% + 80px);
    margin-left: -40px;
    background-color: #806e6c;
    border: none;
    color: white;
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
  }
  
  .btn-connection-fb {
    padding: 15px 0px;
    width: calc(100% + 80px);
    margin-left: -40px;
    background-color: #daaa85;
    border: none;
    color: white;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
  }
  .registration {
    display: inline-block;
    text-decoration: none;
    font-weight: 700;
    font-size: 16px;
    color: #4a4444;
    margin: 30px;
  }
  
  .social-container .line-heading {
    width: calc(100% + 180px);
    margin-left: -90px;
  }
  .social-icon-container {
    text-align: center;
  }
  
  .social-icon-container a {
    border-radius: 50%;
    height: 36px;
    width: 36px;
    line-height: 40px;
    margin: 1px;
    text-decoration: none;
    display: inline-block;
  }
  .social-icn-fb {
    background: #f2cda5;
  }
  .social-icn-twitter {
    background: #e29854;
  }
  .social-icn-google {
    background: #443838;
  }
  .social-icn-pinterest {
    background: #d6ad8c;
  }
  .social-icn-linkedin {
    background: #8a7272;
  }
  .social-icon-container a i {
    color: white;
    font-size: 18px;
  }
  
  footer {
    background-color: #3b3132;
    color: #ccc;
    padding: 20px 10px 20px 40px;
  }
  
  footer span {
    margin-right: 20px;
    font-size: 14px;
    font-weight: 600;
  }
  
  
  
  /* ############ SCreen 5 CSS ############# */
.page-5 .col-left{
  position: relative;
  z-index: 2;
}
.banner-description-container {
    padding: 0px 80px;
    text-align: center;
  }
  .banner-description-container h2::after {
    display: none;
  }
  .banner-description-container p {
    color: white;
    font-style: italic;
    font-size: 20px;
  }
  
  .banner-description-container button {
    background: #eb954b;
    border: none;
    padding: 5px 20px;
    color: white;
    font-size: 16px;
  } 
.page-5 .col-right{
  position: relative;
  z-index: 1;
  left: -110px;
  max-width: calc(50% + 110px);
  -webkit-box-flex: 0;
      -ms-flex: 0 0 calc(50% + 110px);
          flex: 0 0 calc(50% + 110px);
  padding: 0;
}
  .heart-icon {
    text-align: center;
    background: #f2cda5;
    padding: 15px;
    color: white;
  }
  
  .navbar {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    background: #443838;
    color: white;
    padding-left: 70px;
  }
  
  .navbar .icon {
    display: none;
  }
  .express-container {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }
  .express-container .icn-express {
    background-image: url("./assets/Airplane simbol.png");
    background-size: cover;
    height: 30px;
    width: 30px;
    margin-top: 4px;
  }
  
  .express {
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    text-transform: uppercase;
  }
  ul.nav {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding: 0;
    margin: 0;
  }
  ul.nav li {
    list-style-type: none;
    padding: 8px 10px;
  }
  ul.nav li a {
    text-decoration: none;
    color: white;
    text-transform: uppercase;
  }
  


  .page-5 .navbar {
    padding-left: 110px;
  }
  
  
  .page-5 .col-left {
    background-position: top center;
   padding: 40% 0 100px; 
  }
  
  
  .page-5 .option-container {
    padding: 70px 0;
    max-width: 350px;
    margin: 0 auto;
  }
  .page-5 .styled-checkbox {
    -webkit-box-orient: horizontal;
    -webkit-box-direction: reverse;
        -ms-flex-direction: row-reverse;
            flex-direction: row-reverse;
    -webkit-box-pack: end;
        -ms-flex-pack: end;
            justify-content: flex-end;
    margin-bottom: 60px;
    text-transform: uppercase;
    font-size: 14px;
  }
  .page-5 .styled-checkbox .checkbox {
    margin-right: 20px;
    border:1px solid #ddd;
  }
  
  .option-container .btn-retour {
    padding: 12px;
    width: calc(100%);
    background-color: #443838;
    margin-top: 15px;
    margin-bottom: 20px;
    border: none;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 15px;
    cursor: pointer;
  }
  
  .option-container .btn-retour i {
    float: left;
    font-size: 28px;
  }
  
  /* ############ SCreen 5 CSS ############# */
  
  
  @media screen and (max-width: 1200px) {
    
    ul.nav li {
      padding: 9px 5px;
    }
  }
  @media screen and (max-width: 991px) {
   
    /* mobile menu css */
    .navbar {
      padding-left: 15px;
      position: relative;
    }
  
    .navbar .icon {
      display: block;
      float: right;
    }
  
    .navbar ul {
      display: none;
    }
  
    .responsive {
      position: relative;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
    }
    .navbar .icon {
      position: absolute;
      right: 10px;
      top: 10px;
      color: white;
    }
    .responsive ul {
      display: block;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
      padding-left: 35px;
    }
  
    /* mobile menu css */
    
    .page-5 .option-container {
      padding: 70px 20px;
    }
    .page-5 .banner-description-container {
        padding: 0 5%;
    }
  }
  @media screen and (max-width: 768px) {
    .row {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      -ms-flex-direction: column;
      flex-direction: column;
    }
    .col-left,
    .col-right {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 100%;
      flex: 0 0 100%;
      max-width: 100%;
    }
  
    .page-5 .col-left  h2 {
        font-size: 25px;
    }
  
    .page-5 .col-right{
      left: 0;
      min-width: 100%;
      margin-left: 0;
    }
    
    .page-5 .navbar {
        padding-left: 0;
    }
  
  
    footer span {
      font-size: 11px;
    }
  
  }
  
  @media screen and (max-width: 600px) {
    header {
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
          -ms-flex-direction: row;
              flex-direction: row;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      padding: 20px;
      -ms-flex-wrap: wrap;
          flex-wrap: wrap;
    }
  
    .follow-container {
      -webkit-box-flex: 0;
          -ms-flex: 0 0 50%;
              flex: 0 0 50%;
      -webkit-box-ordinal-group: 3;
          -ms-flex-order: 2;
              order: 2;
      max-width: 50%;
    }
  
    header .follow-container .social-icon-container a {
      height: 18px;
      width: 18px;
      line-height: 18px;
    }
    header .follow-container .social-icon-container a i {
      font-size: 10px;
    }
  
    header .language {
      -webkit-box-flex: 0;
          -ms-flex: 0 0 35%;
              flex: 0 0 35%;
      -webkit-box-ordinal-group: 3;
          -ms-flex-order: 2;
              order: 2;
      max-width: 35%;
      margin-right: 35px;
    }
    header .logo-container {
      -webkit-box-flex: 0;
          -ms-flex: 0 0 100%;
              flex: 0 0 100%;
      -webkit-box-ordinal-group: 2;
          -ms-flex-order: 1;
              order: 1;
      max-width: 100%;
      text-align: center;
    }
  
   
    .banner {
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
    }
    .banner .banner-description {
      padding-right: 0;
    }
  
    .banner .banner-description button {
      background: #e29854;
      border: none;
      color: white;
      padding: 10px 15px;
      margin-top: 30px;
    }
    .page-5  .banner-description-container{
      padding: 0px;
    }
    .page-5 .banner-description-container h2 {
      font-size: 20px;
    }
   
    .page-5 .navbar {
      padding-left: 0;
    }
   
  }
  
</style>
