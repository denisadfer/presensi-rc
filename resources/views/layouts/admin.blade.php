<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ $title }}</title>
    @include('partials.style')
  </head>
  <body>
    <div class="wrapper d-flex align-items-stretch">
      @include('partials.admin.sidebar')
      <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container">
          @yield('content')
        </div>
      </div>
    </div>

    @include('partials.script')
  </body>
</html>