
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Laravel Quickstart - Intermediate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
      <nav class="navbar navbar-default">
        <a href="/" onclick="logout()">Logout</a>
      </nav>
    </div>
    @yield('content')
  </body>

  <script>
    function logout() {
      document.cookie = 'user_id' + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
  </script>
</html>
