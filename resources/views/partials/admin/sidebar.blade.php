<nav id="sidebar">
  <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary"></button>
  </div>
  {{-- <div class="" style="background-image: url(https://cdn.discordapp.com/attachments/865222321475158016/1083254891016888391/logo_rose.png)">
    <div class="user-logo">
      <div class="img" style="background-image: url({{ URL::asset('images/logo.png')}})"></div>
    </div>
  </div> --}}
  <div class="bg-wrap">
    <img src="https://cdn.discordapp.com/attachments/865222321475158016/1095530652553707651/logo_rose_new.png" alt="logo-rc" width="100%">
  </div>
  <ul class="list-unstyled components mb-5">
    <li class="@if($title=='Dashboard') active @endif">
      <a href="/admin/dashboard"><span class="fa fa-home mr-3"></span>Dashboard</a>
    </li>
    <li class="@if($title=='Presences') active @endif">
      <a href="/admin/presences" class=""><span class="fa fa-clipboard mr-3"></span> Presences</a>
    </li>
    <li class="@if($title=='Employee') active @endif">
      <a href="/admin/users" class=""><span class="fa fa-user mr-3"></span> Employee</a>
    </li>
    <li class="@if($title=='Position') active @endif">
      <a href="/admin/position"><span class="fa fa-list mr-3"></span> Position</a>
    </li>
    <li class="">
      <a href="/logout"><span class="fa fa-sign-out mr-3"></span>Sign Out</a>
    </li>
  </ul>
  {{-- <div class="d-flex justify-content-center">
    <footer class="col-4 d-flex justify-content-between">
      <a href="https://www.instagram.com/denisadfer/" class="text-decoration-none text-muted" target="blank"><span
          class="fa fa-instagram"></span></a>
      <a href="https://www.facebook.com/denis.aditya.1422" class="text-decoration-none text-muted" target="blank"><span
          class="fa fa-facebook"></span></a>
      <a href="https://twitter.com/denisadfer/" class="text-decoration-none text-muted" target="blank"><span
          class="fa fa-twitter"></span></a>
    </footer>
  </div> --}}
</nav>