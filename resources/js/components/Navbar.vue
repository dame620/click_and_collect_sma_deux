<template>
  <header>
    <div class="language">
      <div class="login_link">
        <router-link to="/login" v-if="!isAuth" tag="div">
          <button class="btn btn-primary" style="margin:5px; width:130px; background:#eb954b; border:none; height:30px; cursor:pointer; color:white; border-radius: 25% 25%;">se connecter</button>
        </router-link>
        <router-link to="/register" v-if="!isAuth" tag="div">
          <button class="btn btn-primary" style="margin:5px; width:130px; background:#eb954b; border:none; height:30px; cursor:pointer; color:white; border-radius: 25% 25%;">créer un compte</button>
        </router-link>
        <div v-else>
          <a href="#" @click.prevent="onLogout">Déconnexion</a> 
          <form ref="logoutForm" method="POST" action="/logout">
            <csrf-field />
          </form>
        </div>
      </div> 
      <select name="language" id="" class="language-toggle">
        <option value="none" selected disabled hidden>language</option>
        <option value="">English</option>
        <option value="">Arabic</option>
        <option value="">Sawahili</option>
        <option value="">Russian</option>
        <option value="">Chinese</option>
      </select>
    </div>
    <div class="logo-container">
        <router-link to="/">
            <img class="logo" src="../images/Africa logo.png" alt="" />
        </router-link>
    </div>
    <div class="follow-container" style="margin-top:15px;">
      <h3>Suivez Nous</h3>
      <div class="social-icon-container">
        <a href="#" class="social-icn-fb"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icn-twitter"
          ><i class="fab fa-twitter"></i
        ></a>
        <a href="#" class="social-icn-google"
          ><i class="fab fa-google-plus-g"></i
        ></a>
        <a href="#" class="social-icn-pinterest"
          ><i class="fab fa-pinterest-p"></i
        ></a>
        <a href="#" class="social-icn-linkedin"
          ><i class="fab fa-linkedin-in"></i
        ></a>
      </div>  
    </div>
  </header>
</template>

<script>
export default {
  data() {
    return {
      user: null
    }
  },
  computed: {
    isAuth() {
      return window.isAuthenticated();
    },
    authName() {
      return this.isAuth ? this.user.name : ''
    }
  },
  methods: {
    loadUser() {
      axios.get('/user').then(({data}) => {
        this.user = data;
      }).catch(({message}) => {
        /*this.$router.push({name: 'login'});*/
      });
    },
    onLogout() {
      this.$refs.logoutForm.submit();
    }
  },
  mounted() {
    this.loadUser();
  }
};
</script>
