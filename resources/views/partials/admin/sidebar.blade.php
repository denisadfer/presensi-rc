<nav id="sidebar">
  <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn btn-primary"></button>
  </div>
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
</nav>