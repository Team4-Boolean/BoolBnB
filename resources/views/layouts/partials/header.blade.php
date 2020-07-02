
<div class="header">
  <a href="{{ route("houses.index")}}" class="logo"><img src="{{url('/images/logo.jpg')}}" alt="logo"></a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
      <li><a href=" {{ route("houses.index")}}"> Home Page </a></li>
      @guest
          <li><a href="{{route('login')}}">Accedi</a></li>
          @if (Route::has('register'))
          <li><a href="{{route('register')}}">Registrati</a></li>
          @endif
      @else
          <li><a href=" {{ route("admin.houses.index")}}">Le tue case</a></li>
          <li class="">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
</div>
