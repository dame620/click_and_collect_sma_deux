<template>
   
  <div @click.stop class="container" v-if="connected_user!=null" ref="container">

        <div ref="downloador_btn">
            <button  @click.prevent="onDownloadInvoice($event)">telecharger</button>
        </div>
        <div class="invoice-header">
            <div class="invoice-header-left">
                <img src="./assets/Africa logo.png" width="100px" height="90px" alt="logo click and collect" srcset="">
            </div>
            <div class="invoice-header-right">
                <span class="invoice-header-right-head">De</span>
                <span>
                     <h1>SHOPMEAWAY SAS</h1>
                    <p>SICAP MERMOZ VILLA 76666</p>
                    <p>RCS: SN DKR 2019B 22025</p>
                    <P>TEL:33 868 39 18</P>
                </span>
            </div>
        </div>

        <div class="invoice-title">
            <h2>FACTURE PROFORMA</h2>
        </div>

        <div class="invoice-info">
            <div class="invoice-info-left">
                <h4>POUR</h4>
                <P>Nom : {{ connected_user.name }} </P>
                <P>Adresse: {{ connected_user.adresse }}</P>
            </div>
            <div class="info-info-right">
                <h3>Facture Num: {{ shipmentresponses.id }}</h3>
                <h6>Emise le: {{ currentDate }}</h6>   
            </div>
        </div>

        <div class="invoice-body">
            <div class="invoice-body-first-section">
                <div class="first-section-title">
                    <h2>Colis Facturé</h2>
                </div>
                <div class="first-section-body">
                    <table id="first-table">
                        <tr>
                          <th>POIDS</th>
                          <th>LONGUEUR</th>
                          <th>LARGEUR</th>
                           <th>Hauteur</th>
                        </tr>
                        <tr v-for="wrapper in wrappers" :key="wrapper.id">
                          <td>{{ wrapper.weight }}</td>
                          <td>{{ wrapper.length }}</td>
                          <td>{{ wrapper.width }}</td>
                          <td>{{ wrapper.height }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="invoice-body-second-section">
                <div class="second-section-title">
                    <h2>Somme Total: {{shipmentresponses.tatalprice.toLocaleString('it-IT') }} CFA</h2>
                </div>
                <div class="second-section-body">
                    <table id="second-table">
                     
                    </table>
                </div>

            </div>
        </div>
    </div>     
   
</template>

<script>
    export default {

        data() {
            return {
                wrapper: null,
                isLoading: false,
                wrappers:null,
                shipmentresponses:null,
                connected_user:null
            }
        },
        computed: {
            currentDate() {
                const date = new Date;
                return Intl.DateTimeFormat('fr-FR', { dateStyle: 'full' }).format(date);
                 },
             },

        methods: {
            loadWrapper(id) {
                this.isLoading = true;
                axios.get(`/shipment/${id}`).then(({data}) => {
                    this.shipmentresponses = data.data;
                    this.wrappers=data.data.packageorenvelops
                    console.log(this.wrappers)
                }).catch(({message}) => {
                    this.$toast.error(message);
                }).finally(_ => {
                    this.isLoading = false;
                });
            },
                //button for download invoice
            onDownloadInvoice(event) {
                const opt = {
                    margin:       1,
                    filename:     this.shipmentresponses.id + 'Facture_CAC_'+this.shipmentresponses.id+'_PAQ.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                };


                event.target.style.display = 'none';

                html2pdf(this.$refs.container, opt);
            },
                //button for download invoice
            getconnecteduser(){

                axios.get('/user').then(response => {
             // console.log(response.data);
              const connected_user=response.data;
              this.connected_user=connected_user;
              console.log(this.connected_user)
              }).catch(({message}) => {
                    this.$toast.error(message);
                }).finally(_ => {
                    this.isLoading = false;
                });

            }
        },

        mounted() {
            const wrapper_id = this.$route.params.id; 
            this.loadWrapper(wrapper_id);

            this.getconnecteduser();

            function addScript(url) {
                var script = document.createElement('script');
                script.type = 'application/javascript';
                script.src = url;
                document.head.appendChild(script);
            }
            addScript('https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js');
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

.invoice-header{
    display: flex;
    justify-content: space-around;
    margin-bottom: 50px;
}

/*.invoice-header .invoice-header-right-head{
    border-right: 1px solid;
}*/

.invoice-title{
    display: flex;
    justify-content: center;
}

.invoice-title h2{
    border: 1px solid;
    margin-bottom: 90px;
}

.invoice-info{
    display: flex;
    justify-content: space-around;
    margin-bottom: 50px;
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

.second-section-title{
    display: flex;
    justify-content: center;
    width: 100%;
    background-color: black;
}

.second-section-title h2{
    color:white;
}

#second-table{
    width: 100%;
    margin-bottom: 5px;
    margin-top: 1px;

}
</style>
