<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>

      @if(Auth::check() && Auth::user()->hasRole('Customer'))
        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
      @else
      <a class="btn btn-success" style="margin-right: 5px" href="register">Register</a>
      <a class="btn btn-success" href="login">Login</a>
      @endif
    </div>
</nav>