import CheckPhyto from './components/CheckPhyto.vue'
import CheckComponent from './components/CheckComponent'
import checkforpickup from './components/CheckforPickup.vue'
import PackageComponent from './components/PackageComponent.vue'
import pick_up_package_dataComponent from './components/pick_up_package_dataComponent.vue'
import pick_package_after_quote from './components/pick_package_after_quote.vue'
import pick_envelope_after_quote from './components/pick_envelope_after_quote.vue'
import InvoicePackagequote from './components/InvoicePackagequote.vue'
import checkdataquoteforpackageComponent from './components/checkdataquoteforpackageComponent.vue'
import infoforshipmentdhlComponent from './components/infoforshipmentdhlComponent.vue'
import InvoiceProformaComponent from './components/InvoiceProformaComponent.vue'
import FillemailComponent from './components/FillemailComponent.vue'
import EnvelopComponent from './components/EnvelopComponent.vue'
import InvoiceenvlopeProforma from './components/InvoiceenvelopeProforma.vue'
import checkdataquoteforenvelopeComponent from './components/checkdataquoteforenvelopeComponent.vue'
import Fillemailforenvelope from './components/Fillemailforenvelope.vue'
import infoforshipmentdhlenvelopeComponent from './components/infoforshipmentdhlenvelopeComponent.vue'
import envelop_package_data from './components/envelop_package_data.vue'
import dhllabelcomponent from './components/dhllabelcomponent.vue'
import Invoiceproformaafterfilldata from './components/Invoiceproformaafterfilldata.vue'
import Dashboardcomponent from './components/Dashboardcomponent.vue'
import Basefordashboardcomponent from './components/Basefordashboardcomponent.vue'
import Allpackagecomponent from './components/Allpackagecomponent.vue'
import Packagewithdefaultstatucomponent from './components/Packagewithdefaultstatucomponent.vue'
import Allshipmentcomponent from './components/Allshipmentcomponent.vue'
import Singleshipmentcomponent from './components/Singleshipmentcomponent.vue'
import App from './App.vue'

import PageA from './components/PageA.vue'
import Testpages from './pages/Testpages.vue'
import Home from './pages/Home'
import Login from './pages/Login'
import Register from './pages/Register'
import MyAccount from './pages/MyAccount'
import DashboardHome from './pages/DashboardHome.vue'
import Allshipmentchildcomponent from './pages/Allshipmentchildcomponent'
import Singleshipmentchildcomponent from './pages/Singleshipmentchildcomponent'
import SinglewrapperconnectedComponent from './pages/SinglewrapperconnectedComponent.vue'
import SingleshipmentforconnecteduserComponent from './pages/SingleshipmentforconnecteduserComponent.vue'
import AlluserComponent from './pages/AlluserComponent.vue'



const routes = [
    {
      path: '/',
      component: Home,
      name: 'home'
    },

    {
      path: '/login',
      component: Login,
      name: 'login',
      meta: {
        requireGuest: true 
      }
    },

    {
      path: '/register',
      component: Register,
      name: 'register',
      meta: {
        requireGuest: true 
      }
    },

    {
      path: '/check',
      component: CheckComponent,
      name: 'check'
    },

    {
      path: '/mon-compte',
      component: MyAccount,
      name: 'account',
      meta: {
        requireAuth: true
      }
    },

    {
      path: '/checkphyto',
      name:'checkphyto',
      component:CheckPhyto

    },
    {
      path: '/checkforpickup',
      name:'checkforpickup',
      component:checkforpickup,
      meta: {
        requireAuth: true
      }
    },

    {
      path:'/packageform',
      name:'PackageComponent',
      component: PackageComponent
    },
    {
      path:'/pick_up_package_data',
      name:'pick_up_package_dataComponent',
      component:pick_up_package_dataComponent,
      /*beforeEnter: (to, from, next) => {
        if (to.name !== 'login' && !this.is_logged) next({ name: 'login' })
        else next()
      }*/
    },
    {
      path:'/package/create',
      name:'pick_package_after_quote',
      component:pick_package_after_quote
    },
    {
      path:'/envelope/create',
      name:pick_envelope_after_quote,
      component:pick_envelope_after_quote
    },
    {
      path:'/invoicequotepackage',
      name:'InvoicePackagequote',
      component:InvoicePackagequote
    },
    {
      path:'/checkquoteforpackage',
      name:'checkdataquoteforpackageComponent',
      component:checkdataquoteforpackageComponent
    },
    {
      path:'/checkquoteforenvelope',
      name:'checkdataquoteforenvelopeComponent',
      component:checkdataquoteforenvelopeComponent
    },
    {
      path:'/invoiceproforma',
      name:'InvoiceProformaComponent',
      component:InvoiceProformaComponent
    },
    {
      path:'/infofor_shipmentdhl',
      name:'infoforshipmentdhlComponent',
      component:infoforshipmentdhlComponent,
      meta: {
        requireAuth: true
      }
     /* beforeEnter: (to, from, next) => {
        if (to.name !== 'login' && !this.is_logged) next({ name: 'login' })
        else next()
      }*/
    },
    {
      path:'/fillemail',
      name:'FillemailComponent',
      component:FillemailComponent
    },
    {
      path:'/envelopeform',
      name:'EnvelopComponent',
      component:EnvelopComponent

    },
    {
      path:'/invoiceenvelope',
      name:'InvoiceenvelopeProforma',
      component:InvoiceenvlopeProforma

    },
    {
      path:'/fillemailforenvelope',
      name:'Fillemailforenvelope',
      component:Fillemailforenvelope
    },
    {
      path:'/infofor_shipmentdhlenvelope',
      name:'infoforshipmentdhlenvelopeComponent',
      component:infoforshipmentdhlenvelopeComponent
    },
    {
      path:'/testpages',
      name:'Testpages',
      component:Testpages
    },

    //this route is for getting single shipment for connected user
    {
      path:'/singleshipforconnected/:id',
      name:'Singleshipmentforconnecteduser',
      component:SingleshipmentforconnecteduserComponent

    },

    {
      path:'/pageatest',
      name:'PageA',
      component:PageA
    },
    {
      path:'/envelop_package_data',
      name:'envelop_package_data',
      component:envelop_package_data
    },
    {
      path:'/dhllabel',
      name:'dhllabelcomponent',
      component:dhllabelcomponent
    },

    {
      path:'single_wrapper_connected/:id',
      component:SinglewrapperconnectedComponent,
      name:'singlewrapperconnectedComponent'
    },

    {
      path: '/invoiceproformaafterfilldata/:id',
      name: 'Invoiceproformaafterfilldata',
      component:Invoiceproformaafterfilldata,
      meta: {
        requireAuth: true
      }
    },

    {
      path:'/dashboard',
      component:Dashboardcomponent,
      name:'Dashboardcomponent',
    },

    {
      path:'/basefordashboard',
      component:Basefordashboardcomponent,
      name:'Basefordashboardcomponent',
    },
    {
      path:'/allpackages',
      component:Allpackagecomponent,
      name:'Allpackagecomponent',
    },
    {
      path:'/packagewithdefaultstatu',
      component:Packagewithdefaultstatucomponent,
      name:'Packagewithdefaultstatucomponent'
    },

    {
      path: '/allshipment',
      component:Allshipmentcomponent,
      name:'Allshipmentcomponent'
    },
    {
      path:'/singleshipment/:id',
      component: Singleshipmentcomponent,
      name:'Singleshipmentcomponent'
    },
    
   

    {
      path:'/admin',
      name:'admin',
      component: App,
      children:[{
        path: 'accueil',
        component: DashboardHome
      },
      {
        path:'allshipment',
        component:Allshipmentchildcomponent
      },
      {
        path:'singleshipment/:id',
        component:Singleshipmentchildcomponent,
        name:'Singleshipmentchild'
      },
      {
        path:'alluser',
        component:AlluserComponent,
        name:'Alluser'
      },

    ]

    }
      

]


export default routes;

