<template>
  <header>
    <div class="language">
      <div class="login_link">
        <div class="follow-container" style="margin-top:15px;">
            <h3>Suivez Nous</h3>
            <div class="social-icon-container" style="display:flex;">
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
      </div>
      <select name="language" id="" class="language-toggle" v-if="false">
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

    <div class="auth-buttons" v-if="!isAuth">
        <router-link to="/login" class="auth-button login">Se connecter</router-link>
        <router-link to="/register" class="auth-button register">Créer un compte</router-link>
    </div>

    <div class="auth-buttons auth-dropdown" v-else>
        <a href="#" v-if="user" class="auth-dropdown-trigger" @click.prevent="dropdownShown = !dropdownShown">{{ user.name }} <i class="fa fa-angle-down"></i></a>

        <ul class="auth-dropdown-menu" :class="{active: dropdownShown == true}">
            <li class="auth-dropdown-item">
                <router-link to="/mon-compte" @click="dropdownShown = false" class="auth-dropdown-link">Mon compte</router-link>
            </li>
            <li class="auth-dropdown-item"><a class="auth-dropdown-link" href="#" @click.prevent="onLogout">Déconnexion</a></li>
        </ul>

        <form ref="logoutForm" method="POST" action="/logout">
            <csrf-field />
        </form>
    </div>
  </header>
</template>

<script>
    export default {
    data() {
        return {
            user: null,
            dropdownShown: false,
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

<style scoped>


.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.auth-buttons {
    align-self: center;
}

.auth-buttons.auth-dropdown {
    position: relative;
}

.auth-dropdown-menu {
    position: absolute;
    top: calc(100% + 5px);
    right: 0;
    width: 100%;
    background-color: #fff;
    list-style: none;
    z-index: 2000;
    border-radius: 5px;

    padding:5px;

    transform: translateY(-16px);
    opacity: 0;

    box-shadow: 0 10px 15px -3px rgba(242,205,165, .5), 0 4px 6px -2px rgba(242,205,165,.5);
    transition:all ease .1s;
}

.auth-dropdown-menu.active {
    transform: translateY(0);
    opacity: 1;
}
.auth-dropdown-trigger {
    text-decoration: none;
    display: inline-block;
    margin-bottom: 10px;
    color:#E29854;
    font-weight: bold;

}

.auth-dropdown-link {
    display: block;
    padding:12px 15px;
    text-decoration: none;
    color:#E29854;
    font-weight: 100;
}
.auth-dropdown-link:hover {
    background-color: #f8F8f8;
    border-radius: 5px;
}

.auth-buttons .auth-button {
    padding:12px 25px;
    border:1px solid #F2CDA5;
    text-decoration:none;
    font-size:13Px;
    border-radius: 9999Px;
    text-transform: uppercase;
    font-weight: 600;
    transition: all ease .3s;
}
.auth-buttons .auth-button:active {
    box-shadow: 0 0 0 .2rem #F2CDA5;
}

.auth-buttons .auth-button.login {
    color: #E29854;
    background-color: #fff;
}

.auth-buttons .auth-button.register {
    background-color: #E29854;
    color:#fff;
    border:none;
}
.auth-buttons .auth-button.logout {
    color:#fff;
    background-color: #F2CDA5;
}
.auth-buttons .auth-button.logout:hover {
    background-color: #E29854;
}

</style>
