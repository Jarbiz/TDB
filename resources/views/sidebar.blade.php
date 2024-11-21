<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="
            {{ auth()->user()->images ? asset(auth()->user()->images) : 'https://img.lovepik.com/free-png/20210926/lovepik-cartoon-avatar-png-image_401440477_wh1200.png' }}
            " alt="profile" />
            <span class="login-status online"></span>
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
            <span class="text-secondary text-small">{{ auth()->user()->role_id == 1 ? 'ADMIN' : '' }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('doashboard') }}">
          <span class="menu-title">Trang chủ</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Người dùng</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.index') }}">Quản lý người dùng</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Danh mục bài viết</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('new.index') }}">Danh sách bài viết</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{  route('category_new.index') }}">Danh mục nhóm bài viết</a>
            </li>
          
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-course" aria-expanded="false" aria-controls="ui-course">
          <span class="menu-title">Danh mục khóa học</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-course">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('course.index') }}">Danh sách khóa học</a>
            </li>
          
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-rate" aria-expanded="false" aria-controls="ui-rate">
          <span class="menu-title">Bình luận đánh giá</span>
          <i class="menu-arrow"></i>
          <i class="fa fa-comments-o"></i>
        </a>
        <div class="collapse" id="ui-rate">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('rateYo.index') }}">Duyệt bình luận</a>
            </li>
          
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-cart" aria-expanded="false" aria-controls="ui-cart">
          <span class="menu-title">Quản lí giỏ hàng</span>
          <i class="menu-arrow"></i>
          <i  class="fa fa-shopping-cart"></i>
        </a>
        <div class="collapse" id="ui-cart">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('order.index') }}">Danh mục giỏ hàng</a>
            </li>
          
          </ul>
        </div>
      </li>
    </ul>
  </nav>