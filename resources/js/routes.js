import example from './components/ExampleComponent.vue';
import NotFoundComponent from './components/ExampleComponent.vue';
import e403 from './errors/403.vue';
import companysetting from './manage/settings/settings.vue';
import branches from './manage/branches/branches.vue';
import newbranch from './manage/branches/AddBranch.vue';
import editbranch from './manage/branches/EditBranch.vue';


// COGS Account
import cogList from './cogaccounts/cogaccounts.vue';
import cogCreate from './cogaccounts/Create.vue';
import cogEdit from './cogaccounts/Edit.vue';
import cogShow from './cogaccounts/Show.vue';
 
//Customser
import customers from './customers/Customers.vue';
// Agents
import agents from './agents/Agents.vue';
import agentCreate from './agents/Create.vue';
import agentEdit from './agents/Edit.vue';
// banks
import banks from './banks/Banks.vue';
import bankCreate from './banks/Create.vue';
import bankEdit from './banks/Edit.vue';

// Brands
import brands from './brands/Brands.vue';
import brandCreate from './brands/Create.vue';
import brandEdit from './brands/Edit.vue';

// Excise and Taxation
import excise from './excise/Excise.vue';
import exciseCreate from './excise/Create.vue';
import exciseEdit from './excise/Edit.vue';

// Employees
import employees from './employees/Employees.vue';

// Users
import users from './manage/users/Users.vue';
import userShow from './manage/users/Show.vue';
import userCreate from './manage/users/UserCreate.vue';
//import usercreate from './manage/users/UserCreate.vue';

//Roles
import userRoles from './manage/users/roles/Roles.vue';
import RoleCreate from './manage/users/roles/RoleCreate.vue';
import RoleEdit from './manage/users/roles/RoleEdit.vue';

//Permissions
import userPermissions from './manage/users/permissions/Permissions.vue';

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
import VendorEdit from './vendors/VendorEdit.vue';
// category
import category from './category/Categories.vue';
import CatCreate from './category/CatCreate.vue';
import CatEdit from './category/CatEdit.vue';

// dashboard
import dashboard from './components/dashboard.vue';

export default [
  
  { path: '/dashboard', component: dashboard, name: 'dashboard'},
// cogs Accounts
  { path: '/cogs', component: cogList, name: 'cogs'},
  { path: '/cogs/cogCreate', component: cogCreate, name: 'cogCreate'},
  { path: '/cogs/cogEdit/:id', component: cogEdit, name: 'cogEdit', props: true},
  { path: '/cogs/cogShow/:id', component: cogShow, name: 'cogShow', props: true},
  
// Settings 
  { path: '/settings/branches', component: branches, name: 'branches'},
  { path: '/settings/branches/newbranch', component: newbranch, name: 'newbranch'},
  { path: '/settings/branches/editbranch/:id', component: editbranch, name: 'editbranch', props: true},
  { path: '/settings/company', component: companysetting, name: 'company'},

// Users management
  { path: '/users', component: users, name: 'users'}, 
  { path: '/userShow', component: userShow, name: 'UserShow'}, 
  { path: '/userCreate', component: userCreate, name: 'userCreate'}, 

// Roles
  { path: '/roles', component: userRoles, name: 'userRoles'}, 
  { path: '/roles/RoleCreate', component: RoleCreate, name: 'RoleCreate'}, 
  { path: '/roles/RoleEdit/:id', component: RoleEdit, name: 'RoleEdit', props: true }, 

  // Permissions
  { path: '/permissions', component: userPermissions, name: 'userPermissions'}, 

//customers
  { path: '/customers', component: customers, name: 'customers'}, 

// agents
  { path: '/agents', component: agents, name: 'agents', meta: { requiresAuth: false }},
  { path: '/agents/agentCreate', component: agentCreate, name: 'agentCreate', meta: { requiresAuth: false }},
  { path: '/agents/agentEdit/:id', component: agentEdit, name: 'agentEdit', props: true},

  // Banks
  { path: '/banks', component: banks, name: 'banks'},
  { path: '/banks/bankCreate', component: bankCreate, name: 'bankCreate'},
  { path: '/banks/bankEdit/:id', component: bankEdit, name: 'bankEdit', props: true},

  // Brands
  { path: '/brands', component: brands, name: 'brands'},
  { path: '/brands/brandCreate', component: brandCreate, name: 'brandCreate'},
  { path: '/brands/brandEdit/:id', component: brandEdit, name: 'brandEdit', props: true},

// Excise and Taxation
  { path: '/excisentaxation', component: excise, name: 'excisentaxation'},
  { path: '/excisentaxation/exciseCreate', component: exciseCreate, name: 'excisentaxationCreate'},
  { path: '/excisentaxation/exciseEdit/:id', component: exciseEdit, name: 'excisentaxationEdit', props: true},

//Employees
  { path: '/employees', component: employees, name: 'employees'},

// products autos
  { path: '/autos', component: autos, name: 'autos'},
  { path: '/autos/newproduct', component: NewProduct, name: 'newproduct'},
  { path: '/autos/editproduct/:id', component: EditProduct, name: 'editproduct', props: true},
  { path: '/autos/AutosShow/:id', component: AutosShow, name: 'AutosShow',props: true},

// products Electronic
  { path: '/electronic', component: electronic, name: 'electronic'},
  { path: '/electronic/neweproduct', component: NeweProduct, name: 'neweproduct'},
  { path: '/electronic/editeproduct/:id', component: EditeProduct, name: 'editeproduct', props: true},
  { path: '/electronic/electronicshow/:id', component: ElectronicShow, name: 'electronicshow', props: true},

// vendors
  { path: '/vendors/', component: vendors, name: 'vendors'},
  { path: '/vendors/create', component: vendorCreate, name: 'create'},
  { path: '/vendors/vendorEdit/:id', component: VendorEdit, name: 'vendorEdit', props: true},

// category
  { path: '/category/manage', component: category, name: 'manage'},
  { path: '/category/catcreate', component: CatCreate, name: 'catcreate'},
  { path: '/category/catedit/:id', component: CatEdit, name: 'catedit', props: true},

  { path: '*', component: NotFoundComponent, name: 'NotFoundComponent'},

  { path: 'e403', component: e403, name: 'e403'}

  ];