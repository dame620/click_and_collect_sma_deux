<template>
    <div class="container">

        <div class="invoice-title">
            <h2>Liste des Expedions</h2>
        </div>

        <div class="invoice-body">
            <div class="invoice-body-first-section">
                <div class="first-section-title">
                    <h2>Total Expeditions {{ wrapperlength }}</h2>
                </div>
                <div class="first-section-body">
                    <table id="first-table">
                        <tr>
                          <th>Id</th>
                          <th>Date</th>
                          <th>NBRE DE COLIS</th>
                          <th>Prix Facture</th>
                          <th>Expediteur</th>
                          <th>Destinataire</th>
                          <th>Tracking</th>
                          <th>Statu</th>
                          <th>Action</th>
                          
                        </tr>
                        <tr v-for="wrapper in wrappers" :key="wrapper.id">
                          <td>{{ wrapper.id }}</td>
                          <td>{{ wrapper.created_at }}</td>
                          <td>{{ wrapper.packageorenvelops.length }}</td>
                          <td>2585 F CFA</td>
                          <td>{{ wrapper.pickupcountyName }}</td>
                          <td>{{ wrapper.receivercountyName }}</td>
                          <td>{{ wrapper.trackingnumber }}</td>
                          <td>{{ wrapper.statu.libelles }}</td>
                          <td><router-link :to="{name: 'Singleshipmentcomponent', params: {id: wrapper.id}}">Voire</router-link></td>
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
        this.ongetlistshipment();
    },

    data(){
        return{
           wrappers:[],
           loading:false,
           wrapperlength:null

        }
    },
    methods:{
        ongetlistshipment(){
            axios.get("/all-shipments").then((response)=>{
                const wrappers=response.data.data; 
                this.wrappers=wrappers;
                console.log(this.wrappers)
                this.wrapperlength=this.wrappers.length
                this.wrappers.filter(wrapper =>{
                    if(wrapper.statu===null){
                        return wrapper.statu=0;                 
                        }
                });

            })
            .catch(({message})=>{
                this.$toast.error(message);
            })
            .finally((_)=>{
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