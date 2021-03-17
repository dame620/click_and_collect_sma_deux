<template>
    <div class="container" style="padding-top:0; margin-left:347px;">

        <div class="invoice-title">
            <h2>Liste Users</h2>
        </div>

        <div class="invoice-body">
            <div class="invoice-body-first-section">
                <div class="first-section-title">
                    <h2>Total Users {{ wrapperlength+1 }}</h2>
                </div>
                <div class="first-section-body">
                    <table id="first-table">
                        <tr>
                          <th>Id</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th>Adresse</th>
                          <th>Telephone</th>
                          <th>Action</th>
                        </tr>
                        <tr v-for="wrapper in wrappers" :key="wrapper.id">
                          <td>{{ wrapper.id }}</td>
                          <td>{{ wrapper.name }}</td>
                          <td>{{ wrapper.email }}</td>
                          <td>{{ wrapper.adresse }}</td>
                          <td>{{ wrapper.telephone }}</td>
                          <td><router-link :to="{name: 'Singleshipmentchild', params: {id: wrapper.id}}">Voir</router-link></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    mounted(){
        this.ongetlistuser();
    },

    data(){
        return{
           wrappers:[],
           loading:false,
           wrapperlength:null

        }
    },
    methods:{
        ongetlistuser(){
            axios.get('/list-user').then(response=>{
                   this.wrappers=response.data.data
                   console.log("list des users", this.wrappers)
                   this.wrapperlength=response.data.data.length
            })
            .catch(({message})=>{
                this.$toast.error(message)
            }).finally((_)=>{
                this.loading=true;
            })
        }
    }
}
  
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600;700;800;900&display=swap');


*{
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



.invoice-title{
    display: flex;
    justify-content: center;
}

.invoice-title h2{
    border: 1px solid;
    margin-bottom: 25px;
}



.invoice-body-first-section{
    margin-bottom: 20px;
}

.first-section-title{
    display: flex;
    justify-content: center;
    width: 100%;
    background-color: gray;
}



.first-section-body{
    width: 100%;
   
}

#first-table{
    width: 100%;
    margin-top: 2px;
    }

tr th{
        border: 2px solid;
    }

tr td{
    border: 1px solid;
}    

</style>