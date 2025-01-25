<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <img class="app-brand-logo demo me-1" src="assets/img/Glansa Solutions.png" height="20" />
      <span class="app-brand-text demo menu-text fw-semibold ms-2">HealthCare</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1" id="menuContainer">
    <!-- Menu will be dynamically populated by JavaScript -->
  </ul>
</aside>

<script>
  // Wait for the document to be fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    // Fetch user data from localStorage
    let userData = JSON.parse(localStorage.getItem('userData'));

    // Ensure userData exists before proceeding
    if (!userData || !userData.RoleId) {
      console.log('No valid user data found');
      return;
    }

    // console.log('User Data:', userData);

    // Fetch menu data (replace this with your Blade-provided menu JSON if needed)
    const menuData = @json($menuData[0]->menu);

    // console.log('Menu Data:', menuData);

    // Filter and render menu
    const menuContainer = document.getElementById('menuContainer');
    menuData.forEach((menu) => {
      if (!menu.role || menu.role === userData.RoleId) {
        // Create menu item
        if (menu.menuHeader) {
          // Render menu header
          const menuHeader = document.createElement('li');
          menuHeader.className = 'menu-header fw-medium mt-4';
          menuHeader.innerHTML = `<span class="menu-header-text">${menu.menuHeader}</span>`;
          menuContainer.appendChild(menuHeader);
        } else {
          // Render menu item
          const activeClass = "{{ Route::currentRouteName() }}" === menu.slug ? 'active' : '';
          const menuItem = document.createElement('li');
          menuItem.className = `menu-item ${activeClass}`;
          menuItem.innerHTML = `
            <a href="${menu.url ? '{{ url("/") }}' + menu.url : 'javascript:void(0);'}"
               class="${menu.submenu ? 'menu-link menu-toggle' : 'menu-link'}">
              ${menu.icon ? `<i class="${menu.icon}"></i>` : ''}
              <div>${menu.name}</div>
            </a>
          `;

          // Append to container
          menuContainer.appendChild(menuItem);
        }
      }
    });
  });
</script>