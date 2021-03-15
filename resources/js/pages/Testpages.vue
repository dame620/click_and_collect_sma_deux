<template>
  <div>
    <div class="wrapper">
      <ul>
        <li v-for="wrapper in wrappers" :key="wrapper.id">{{ wrapper.name }}</li>
      </ul>

        <pagination :data="wrappersData" @pagination-change-page="getResults" style="">
            
        </pagination>
    </div>
    
  </div>
</template>

</style>

<script>
export default {
    data() {
        return {
            wrappers: [],
            wrapperlength: null,
            loading: false,
            wrappersData: {},
        };
    },
    computed: {
        csrf_token() {
            return window.csrfContent;
        },
    },

    methods: {
        getResults(page = 1) {
        axios
            .get(`/list-user?page=${page}`)
            .then((res) => {
                this.wrappersData = res.data;

                this.wrappers = res.data.data 
            })
            .catch(({ message }) => {
                this.$toast.error(message);
            });
        },
        loadUsers() {
            axios.get('/list-user').then(res => {
                this.wrappers = res.data.data;
            });
        }
    },

    mounted() {
        this.loadUsers();
        this.getResults();
    },
};
</script>
<style>
   
  
</style>
