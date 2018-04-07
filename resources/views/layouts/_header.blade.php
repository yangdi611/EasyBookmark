<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar bg-dark">
  <a class="navbar-brand mr-0 mr-md-2" href="/" id="logo">Easy Bookmark</a>

  <div class="navbar-nav-scroll">
    <ul class="navbar-nav bd-navbar-nav flex-row">
      <li class="nav-item">
        <a class="nav-link" href="#">Whatsapp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Whosapp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Howsapp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Wheresapp</a>
      </li>
    </ul>
  </div>

  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">

    @if (Auth::check())
      <li class="nav-item"><a class="nav-link" href="#">User list</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->email }} <b class="caret"></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">User center</a>
          <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">Edit profile</a>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" id="logout" href="#">
              <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-block btn-danger" type="submit" name="button">Log out</button>
              </form>
            </a>
      </div>
      </li>
    @else
      <li class="nav-item"><a class="nav-link" href="{{ route('help') }}">Help</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
    @endif
  </ul>
</header>
