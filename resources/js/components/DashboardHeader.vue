<template>
  <header>
    <h2>
      <label for="nav-toggle" @click.prevent="onToggleSidenav">
        <span class="las la-bars"></span>
      </label>
      Dashboard
      <img
        class="logocac_header"
        src="./assets/Africa logo.png"
        width="60px"
        height="60px"
        alt=""
        srcset=""
      />
    </h2>
    <div class="search-wrapper">
      <span class="las la-search"></span>
      <input type="search" placeholder="search here" />
    </div>

    <div class="user-wrapper">
      <img
        src="./assets/Africa logo.png"
        width="90px"
        height="50px"
        alt=""
        srcset=""
      />
      <div>
        <h4>CLICK AND COLLECT</h4>
        <span>AFRICA</span>
      </div>
    </div>
  </header>
</template>

<script>
    export default {
        name: 'DashboardHeader',

        methods: {
            onToggleSidenav() {
                this.$emit('onToggleSidenav');
            }
        }
    }
</script>


<style>
header {
    padding-top:20px!important;
    padding-bottom:20px!important;
}
</style>
