<html>
  <head>
    <title>@yield('title', 'Easy Bookmark') - Easy way to share your URLs!</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('layouts._header')
    <div class="container">
      @include('shared._messages')
      @yield('content')
    </div>
    @include('layouts._footer')
  </body>
<script src="/js/app.js"></script>
</html>
