import example from './components/ExampleComponent.vue';
import NotFoundComponent from './components/ExampleComponent.vue';
import companysetting from './manage/settings/settings.vue';
import branches from './manage/branches/branches.vue';
import newbranch from './manage/branches/AddBranch.vue';
import editbranch from './manage/branches/EditBranch.vue';
//Customser
import customers from './customers/Customers.vue';
// Agents
import agents from './agents/Agents.vue';
// Employees
import employees from './employees/Employees.vue';
//
import usercreate from './manage/users/UserCreate.vue';
// autos products
import autos from './products/AutosProducts.vue';
import NewProduct from './products/AutosNewProduct.vue';
import EditProduct from './products/AutosEditProduct.vue';
import AutosShow from './products/AutosShow.vue';

// electronic
import electronic from './products/ElectronicProducts.vue';
import NeweProduct from './products/ElectronicNewProduct.vue';
import EditeProduct from './products/ElectronicEditProduct.vue';
import ElectronicShow from './products/ElectronicShow.vue';
// vendors
import vendors from './vendors/Vendors.vue';
import vendorCreate from './vendors/VendorCreate.vue';
// category
import category from './category/Categories.vue';
import CatCreate from './category/CatCreate.vue';

// dashboard
import dashboard from './components/dashboard.vue';

export default [
  
  {
    path: '/dashboard',
    component: dashboard,
    name: 'dashboard'
   
  },
  {
    path: '/settings/branches',
    component: branches,
    name: 'branches'
   
  },
  {
    path: '/settings/branches/newbranch',
    component: newbranch,
    name: 'newbranch'
   
  },
    {
    path: '/settings/branches/editbranch/:id',
    component: editbranch,
    name: 'editbranch',
    props: true
   
  },

  {
    path: '/settings/company',
    component: companysetting,
    name: 'company'
   
  },
//customers

    {
    path: '/customers',
    component: customers,
    name: 'customers'
   
  }, 
  // agents
      {
    path: '/agents',
    component: agents,
    name: 'agents'
   
  },
//Employees
      {
    path: '/employees',
    component: employees,
    name: 'employees'
   
  },
// products autos
    {
    path: '/autos',
    component: autos,
    name: 'autos'
   
  },
  {
    path: '/autos/newproduct',
    component: NewProduct,
    name: 'newproduct'
   
  },
  {
    path: '/autos/editproduct/:id',
    component: EditProduct,
    name: 'editproduct',
    props: true
   
  },

  {
    path: '/autos/AutosShow/:id',
    component: AutosShow,
    name: 'AutosShow',
    props: true
   
  },

  // products Electronic
    {
    path: '/electronic',
    component: electronic,
    name: 'electronic'
   
  },
  {
    path: '/electronic/neweproduct',
    component: NeweProduct,
    name: 'neweproduct'
   
  },
  {
    path: '/electronic/editeproduct/:id',
    component: EditeProduct,
    name: 'editeproduct',
    props: true
   
  },

  {
    path: '/electronic/electronicshow/:id',
    component: ElectronicShow,
    name: 'electronicshow',
    props: true
   
  },
  

// vendors
  {
    path: '/vendors/',
    component: vendors,
    name: 'vendors'
   
  },
  {
    path: '/vendors/create',
    component: vendorCreate,
    name: 'create'
   
  },
  // category
  {
    path: '/category/manage',
    component: category,
    name: 'manage'
   
  },
  {
  path: '/category/catcreate',
    component: CatCreate,
    name: 'catcreate'
   
  },

  

  { 
    path: '*', 
    component: NotFoundComponent,
    name: 'NotFoundComponent' 
    }
  


  ];