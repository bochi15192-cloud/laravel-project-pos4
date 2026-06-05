<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pos system</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class ="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>  
                </ul>        
            </div>      
        </div>
    </nav> 
    <div class="container-fluid mt-4">
        @yield('content')
        </div>
          <footer class="bg-primary text-white text-center py-3 mt-4">
            &copy; 2024 Pos system. All rights reserved.
        </footer>

         @if(session('status'))
         
       <script>
            document.addEventListener('DOMContentLoaded',function(){
                Swal.fire({ 
                    icon: '{{session('status')['status'] }}', 
                    title: '{{session('status')['title'] }}', 
                    text: '{{ session('status')['message'] }}', 
                    timer: 5000, 
            confirmButtonText: 'okay',
              });
            });
        </script>
         @endif
  </body>
</html>