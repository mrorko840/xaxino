  <!-- footer-->
  <div class="footer">
      <div class="row no-gutters justify-content-center">
          <div class="col-auto">
              <a href="{{ route('user.home') }}" class="{{ request()->path() == 'user/dashboard' ? 'active' : '' }}">
                  <i class="material-icons">home</i>
                  <p>Home</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.analytics') }}" class="{{ request()->path() == 'user/analytics' ? 'active' : '' }}">
                  <i class="material-icons">insert_chart_outline</i>
                  <p>Analytics</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.deposit.index') }}" class="{{ request()->path() == 'user/deposit' ? 'active' : '' }}">
                  <i class="material-icons">account_balance_wallet</i>
                  <p>Add Money</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.withdraw') }}" class="{{ request()->path() == 'user/withdraw' ? 'active' : '' }}">
                  <i class="material-icons">shopping_bag</i>
                  <p>Withdraw</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.display_profile') }}" class="{{ request()->path() == 'user/display-profile' ? 'active' : '' }}">
                  <i class="material-icons">account_circle</i>
                  <p>Profile</p>
              </a>
          </div>
      </div>
  </div>
