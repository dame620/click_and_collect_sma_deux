<template>
  <div>
    <div class="page-3" v-if="!should_use_default_template && !is_admin_route">
      <div class="wrapper">
        <navbar />

        <transition name="fade">
          <router-view />
        </transition>

        
        <default-footer/>
      </div>
    </div>

    <div v-if="should_use_default_template && !is_admin_route">
      <transition name="fade">
        <router-view />
      </transition>
    </div>

    <div v-if="is_admin_route" style="padding-top: 60px">
      <input type="checkbox" id="nav-toggle" ref="nav_toggle" />
      <DashboardSidebar :is_minimized="is_minimized" />
      <DashboardHeader @onToggleSidenav="onToggleSidenav" />

      <router-view></router-view>
    </div>

  </div>
</template>

<script>
import Navbar from "./components/Navbar";

import { should_use_blank_template } from "./config";

import DefaultFooter from './components/DefaultFooter';
import DashboardSidebar from './components/DashboardSidebar'
import DashboardHeader from './components/DashboardHeader'

export default {
  components: { Navbar, DashboardHeader, DashboardSidebar, DefaultFooter },

  data(){
      return{
          is_minimized:false
      }
  },

  mounted() {
        console.log(this.$route);
        if (!this.is_admin_route) {
      document.head.querySelector('#dashboard_styles').remove();
    }
  },
  computed: {
    should_use_default_template() {
      return should_use_blank_template.includes(this.$route.name);
    },

    is_admin_route() {
      return this.$route.fullPath.startsWith("/admin");
    },
  },

  methods: {
    onToggleSidenav() {
        this.is_minimized = !this.is_minimized;
    }
  },
};
</script>
