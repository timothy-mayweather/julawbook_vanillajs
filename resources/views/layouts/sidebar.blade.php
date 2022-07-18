<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <script>
    const b$_ = "{{Auth::user()->branch->id}}";
    const user_role = "{{Auth::user()->manager}}"==="Yes"?"manager":"attendant";
  </script>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('interface/admin/dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <span class="d-block" style="color: white">{{ Auth::user()->name }}</span>
        <span class="d-block" style="color: white">{{ Auth::user()->branch->name }} branch</span>
        <form method="POST" action="{{ route('logout') }}" class="d-block">
          @csrf
          <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="fas fa-sign-out"></i>{{ __(' Log Out') }}
          </a>
        </form>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#dashboard" class="nav-link side-main-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview  menu-open">
          <a href="#user_form" class="nav-link side-main-link">
            <i class="nav-icon fas fa-pen-alt"></i>
            <p>
              Records
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#store-files" class="nav-link side-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Files
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#meters" class="nav-link side-link">
                <i class="nav-icon fas fa-list-ol"></i>
                <p>
                  Meters
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#dips" class="nav-link side-link">
                <i class="nav-icon far fa-sort-amount-down-alt"></i>
                <p>
                  Dips
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#sales" class="nav-link side-link">
                <i class="nav-icon fas fa-sack-dollar"></i>
                <p>
                  Sales
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#receivables" class="nav-link side-link">
                <i class="nav-icon fas fa-hand-holding-usd"></i>
                <p>
                  Receivables
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#transactions" class="nav-link side-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                  Transactions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#debts" class="nav-link side-link">
                <i class="nav-icon fas fa-user-minus"></i>
                <p>
                  Debts
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#prepaid" class="nav-link side-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Prepaid
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#expenses" class="nav-link side-link">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Expenses
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#inventory" class="nav-link side-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                  Inventory
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#meters" class="nav-link side-link">
                <i class="nav-icon fas fa-signature"></i>
                <p>
                  Summary
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#report" class="nav-link side-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Report
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#registry" class="nav-link side-main-link">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>
              Registry
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#permissions-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  Permissions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#dispensing-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-gas-pump"></i>
                <p>
                  Gas Details
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#products-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#suppliers-customers-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Suppliers & Customers
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#expense-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Expense Types
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#receivable-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                  Receivable Types
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#transaction-reg" class="nav-link side-link">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  Transaction Types
                </p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
