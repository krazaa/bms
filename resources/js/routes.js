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
// vendors
import vendors from './vendors/Vendors.vue';
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
// products
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
    path: '/vendors/',
    component: vendors,
    name: 'vendors'
   
  },
  { 
    path: '*', 
    component: NotFoundComponent,
    name: 'NotFoundComponent' 
    }
  


  ];