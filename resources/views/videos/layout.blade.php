<!DOCTYPE html>
<html>

<head>
  <title>PoorTube</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>

  <div class="container">
    

    @yield('content')

    <script src="/js/bulma.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        //The first argument are the elements to which the plugin shall be initialized
        //The second argument has to be at least a empty object or a object with your desired options
        OverlayScrollbars(document.querySelectorAll("body"), {});
      });
    </script>
  </div>

</body>

</html>