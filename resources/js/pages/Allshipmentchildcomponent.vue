<template>
    <div class="container" style="padding-top:0; margin-left:347px;">

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
                          <td>{{ wrapper.date }}</td>
                          <td>{{ wrapper.packageorenvelops.length }}</td>
                          <td>{{ wrapper.tatalprice }}</td>
                          <td>{{ wrapper.pickupcountyName }}</td>
                          <td>{{ wrapper.receivercountyName }}</td>
                          <td>{{ wrapper.trackingnumber }}</td>
                          <td>{{ wrapper.statu.libelles }}</td>
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
                    var moment = require('moment');
                   
                    const format1 = "DD-MM-YYYYTHH:mm:ss";
                    // 2021-02-26T14:00:31GMT+00:00

                    //passing the creating date to the right format
                    //wrapper.created_at=
                    console.log("date formated",moment(wrapper.created_at).format(format1));
                    wrapper.date=moment(wrapper.created_at).format(format1);


                    if(wrapper.statu===null){
                        return wrapper.statu=0;                 
                        }
                    if(wrapper.tatalprice===null){
                        return wrapper.tatalprice=0;
                    }
                    wrapper.tatalprice=(wrapper.tatalprice.toLocaleString('it-IT', {style: 'currency', currency: 'XOF'})) 

                    
    
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