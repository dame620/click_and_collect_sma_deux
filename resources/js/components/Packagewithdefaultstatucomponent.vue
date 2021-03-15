<template>
    <div>
        <!--Basefordashboardcomponent/-->
        <h1>nombre de paquet{{ wrapperlength }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Statu</th>
                    <th>user</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="wrapper in wrappers" :key="wrapper.id">
                    <td>{{ wrapper.id }}</td>
                    <td>{{ wrapper.shipment.statu.libelles }}</td>
                    <td>{{ wrapper.user.name }}</td>
                    <td>
                    <button style="width:10px;"></button><br>
                    <button></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</template>
<script>
import Basefordashboardcomponent from './Basefordashboardcomponent'
export default {
    components:{ Basefordashboardcomponent },

        data() {
        return {
        wrappers: [],
        loading: false,
        wrapperlength:null
        };
     },

     mounted(){
        console.log(this.$toast);
        this.ongetlistpackages();
    },

    methods:{
        ongetlistpackages(){
            axios.get('default-wrappers')
            .then((response)=>{
                console.log(response.data.data)
                this.wrappers=response.data.data;
                this.wrapperlength=this.wrappers.length
            })
            .catch(({message})=>{
                this.$toast.error(message)
            })
            .finally((_)=>{
                this.loading=true;
            })
        }
    }

   
}
    
</script>

<style scoped>
    table{
        margin: 100px;
    }
    
</style>