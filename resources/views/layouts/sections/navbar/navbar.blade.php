@php
  $containerNav = $containerNav ?? 'container-fluid';
  $navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav
    class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme"
    id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
  @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
      <a href="{{url('/')}}" class="app-brand-link gap-2">
        <span class="app-brand-logo demo">
        @include('_partials.macros', ["height" => 20])
        </span>
        <span class="app-brand-text demo menu-text fw-semibold ms-1">{{config('variables.templateName')}}</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
      </a>
      </div>
    @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div
      class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="mdi mdi-menu mdi-24px"></i>
      </a>
      </div>
    @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="mdi mdi-magnify mdi-24px lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none bg-body" placeholder="Search..."
              aria-label="Search...">
          </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">



          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-3 py-2" data-bs-auto-close="outside">
              <li>
                <a class="dropdown-item pb-2 mb-1" href="javascript:void(0);">
                  <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                      <span id="user-name" class="fw-semibold"></span>
                      <small id="roleId" class="text-muted"></small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"> </div>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" id="changepass-btn">
                  <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                      <i class='mdi mdi-key me-1 mdi-20px'></i>
                      <span>Change Password</span>
                    </div>
                  </div>
                </a>
              </li>

              <li>
                <a class="dropdown-item" href="javascript:void(0);" id="logout-btn">
                  <i class='mdi mdi-power me-1 mdi-20px'></i>
                  <span class="align-middle" id="logout-text">Log Out</span>
                  <span id="logout-spinner" class="spinner-border spinner-border-sm ms-2 d-none text-primary"
                    role="status" aria-hidden="true"></span>
                </a>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
  @endif
  </nav>

  <script>
    $(document).ready(function () {
      let token = JSON.parse(localStorage.getItem('token'));

      if (token) {
        $.ajax({
          url: '/api/me',
          type: 'GET',
          headers: {
            'Authorization': 'Bearer ' + token.access_token,
            'Content-Type': 'application/json'
          },
          success: function (data) {
            console.log(data, 'kkkkkkkk');
            localStorage.setItem('userData', JSON.stringify(data));
            if (data) {
              $('#user-name').text(data.FirstName);
              let roleName = data.RoleId === 1 ? 'Admin' : data.RoleId === 2 ? 'Recruiter' : 'Unknown';
              $('#roleId').text(roleName);
            }
          },
          error: function (xhr, status, error) {
            console.error('Error fetching user details:', error);
          }
        });
      }
      $('#logout-btn').click(function (event) {
        event.stopPropagation();
        $('#logout-text').text('Logging out...');
        $('#logout-spinner').removeClass('d-none'); // Show spinner
        $('#logout-btn').addClass('disabled'); // Disable button

        $.ajax({
          url: '/api/logout',
          type: 'GET',
          headers: {
            'Authorization': 'Bearer ' + token.access_token,
            'Content-Type': 'application/json'
          },
          success: function (response) {
            console.log(response.message);

            localStorage.removeItem('token');

            // Redirect to sign-in page
            window.location.href = '/'; // Change to your actual sign-in page URL
          },
          error: function (xhr, status, error) {
            console.error('Error logging out:', error);
            $('#logout-text').text('Log Out');
            $('#logout-spinner').addClass('d-none'); // Hide spinner
            $('#logout-btn').removeClass('disabled'); // Enable button
          }
        });
      });

      $('#changepass-btn').click(function () {
        window.location.href = '/changepassword'; // Update with the actual Change Password URL
      });

    });
  </script>

  <!-- / Navbar -->