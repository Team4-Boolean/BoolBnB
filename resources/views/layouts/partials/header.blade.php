
<div class="header">
  <a href="" class="logo"><img src="{{url('/images/logo.jpg')}}" alt="logo"></a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
      <li><a href="#">Diventa un host</a></li>
      <li><a href=" {{ route("houses.index")}}"> Home Page </a></li>
      <li><a href="{{'login'}}">Accedi</a></li>
      <li><a href="{{'register'}}">Registrati</a></li>
  </ul>
</div>
