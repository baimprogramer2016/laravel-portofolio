<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item todashboard">
          <a class="nav-link active fw-bold" aria-current="page" href="/home">
            <span data-feather="home"></span>
            <i class="bi bi-door-closed"></i> to Home
          </a>
        </li>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>{{ $job_name }}</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
        <li class="nav-item">
          <a class="nav-link {{ Request()->is('dashboard/invite-user*')?'active':'' }}" aria-current="page" href="/dashboard/invite-user">
            <i class='bi bi-people'></i>
            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('dashboard/urs*')) ? 'active' : '' }}" href="/dashboard/urs-list">
            <i class='bi bi-bounding-box'></i>
            User Req. Specification
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('dashboard/task*')) ? 'active' : '' }}" href="/dashboard/task">
            <i class='bi bi-list-task'></i>
            Task
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('dashboard/document*')) ? 'active' : '' }}" href="/dashboard/document">
              <i class='bi bi-box'></i>
              Document
            </a>
          </li>

      </ul>
    </div>
  </nav>
