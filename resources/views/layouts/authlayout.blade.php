<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="app">
    
</nav>
      <nav class="navbar has-shadow navbar-top is-spaced">
        <div class="navbar-brand">
          <a href="{{ route('dashboard') }}" class="navbar-item"> 
            <i class="mdi mdi-motorbike mdi-36px"></i>
            {{-- <img src="/public/logo/{{ $logo}}"  height="60"> --}}
        {{--       <router-view></router-view> --}}
        
          </a>
          <a class="navbar-item is-hidden-desktop" href="#" target="_blank">
            <span class="icon" style="color: #333;">
              <i class="fa fa-github"></i>
            </span>
          </a>
          <a class="navbar-item is-hidden-desktop" href="#" target="_blank">
            <span class="icon" style="color: #55acee;">
              <i class="fa fa-twitter"></i>
            </span>
          </a>
          <div class="navbar-burger burger" data-target="navMenubd-example">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div id="navMenubd-example" class="navbar-menu">
          <div class="navbar-start">
            <div class="navbar-item has-dropdown is-hoverable">
              
              <a class="navbar-link" href="#">Accounts</a>
               
              <div class="navbar-dropdown ">
                <router-link class="navbar-item" :to="{ name: 'vendors'}">Vendors</router-link>
                <router-link class="navbar-item" :to="{ name: 'customers'}">Customers</router-link>
                <router-link class="navbar-item" :to="{ name: 'agents'}">Agents</router-link>
                <router-link class="navbar-item" :to="{ name: 'employees'}">Employees</router-link>
                <router-link class="navbar-item" :to="{ name: 'users'}">Manage Users</router-link>
               
                
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">Purchases</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Vehicles PO & CN</a>
                <a class="navbar-item" href="#">Product PO & CN</a>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">Sales</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Vehicles Cash & Whole Sale</a>
                <a class="navbar-item" href="#">Vehicle Lease Sale</a>
                <a class="navbar-item" href="#">Product Cash & Whole Sale</a>
                <a class="navbar-item" href="#">Product Lease Sale</a>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">Cash/Bank</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Cash Receipt</a>
                <a class="navbar-item" href="#">Cash Payments</a>
                <a class="navbar-item" href="#">Bank Receipt</a>
                <a class="navbar-item" href="#">Bank Payments</a>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <div class="navbar-link">
                Recovery
              </div>
              <div id="moreDropdown" class="navbar-dropdown ">
                <a class="navbar-item" href="#">Bike Repossession</a>
                <a class="navbar-item" href="#">Default Cases</a>
                <a class="navbar-item" href="#">Calls & Collections</a>
                <a class="navbar-item" href="#">Recovery Assignment</a>
              </div>
            </div>        
            <div class="navbar-item has-dropdown is-hoverable">
              <div class="navbar-link">
                Setup
              </div>
              <div id="moreDropdown" class="navbar-dropdown ">
                <router-link class="navbar-item" :to="{ name: 'company'}">Company Setup</router-link>
                <router-link class="navbar-item" :to="{ name: 'branches'}">Company Branches</router-link>
                <router-link class="navbar-item" :to="{ name: 'cogs'}">COA Openings</router-link>
                <router-link class="navbar-item" :to="{ name: 'banks'}">Bank Setup</router-link>
                <router-link class="navbar-item" :to="{ name: 'brands'}">Brands Setup</router-link>
                 <router-link class="navbar-item" :to="{ name: 'autos'}">Vehicle Setup</router-link>
                <router-link class="navbar-item" :to="{ name: 'electronic'}">Electronic Setup</router-link>
                <router-link class="navbar-item" :to="{ name: 'manage'}">Product Category Setup</router-link>
                <router-link class="navbar-item" :to="{ name: 'excisentaxation'}">Excise & Taxation Setup</router-link>
                
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">HRM</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Employee Management</a>
                <a class="navbar-item" href="#">Salary Management</a>
                <a class="navbar-item" href="#">Commission Management</a>
                <a class="navbar-item" href="#">Incentive Management</a>
              </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">Reports</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Financial Reports</a>
                <a class="navbar-item" href="#">Management Reports</a>
                <a class="navbar-item" href="#">Analysis Reports</a>
                <a class="navbar-item" href="#">Branch Reports</a>
                <a class="navbar-item" href="#">Category Based Reports</a>
              </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">Transfers</a>
              <div class="navbar-dropdown ">
                <a class="navbar-item" href="#">Cash Transfer</a>
                <a class="navbar-item" href="#">Stock Transfer</a>
                <a class="navbar-item" href="#">Documents Transfer</a>
              </div>
            </div>
          </div>
          <div class="navbar-end">
            @if (Auth::guest())
            @else
            @if(Auth()->user()->unreadnotifications->count())
            <div class="navbar-item  is-hoverable">
              <div class="navbar-link">
                <span class="badge is-badge-small" data-badge="{{Auth()->user()->unreadnotifications->count()}}"> --}}
                <i class="mdi mdi-bell-ring mdi-24px" data-active-icon="mdi-bell-ring"></i>
                </span>
                @endif
                @endif
              </div>
              <div id="moreDropdown" class="navbar-dropdown ">
               @foreach ( Auth::user()->unreadNotifications as $notification)
                <a class="navbar-item " href="{{ route('notifications.show', $notification->id) }}">
                  {{ $notification->data['subject'] }} <small><i class="fa fa-clock-o"></i> {{ $notification->created_at->diffForHumans()}}</small>
                </a>
                @endforeach
              </div>
            </div>
            <div class="navbar-dropdown">
              <div class="navbar-item">
                <div class="field is-grouped">
                </div>
              </div>
            </div>
            <div class="navbar-menu" id="navMenu">
              <div class="navbar-start"></div>
              <div class="navbar-end">
                @if (Auth::guest())
                <a class="navbar-item " href="{{ route('login') }}">Login</a>
                <a class="navbar-item " href="{{ route('register') }}">Register</a>
                @else
                <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>
                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </nav>
          @yield('content')
        </div>
        <footer class="footer">
          <hr>
          <div class="content has-text-centered has-shadow">
            <p>
              <strong>BMS</strong> by <a href="https://teamxperts.net">Team Xperts</a>. The source code is licensed
              <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
            is licensed  </a>. 
          </p>
        </div>
      </footer>
      <script src="{{ asset('js/app.js') }}"></script>
      @yield('scripts')
    </body>
  </html>