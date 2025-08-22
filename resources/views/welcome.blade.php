
       @extends('layout')
    <!-- Main Content -->
    <main class="py-4 container">
    
 

            @section('title', 'Welcome')

            @section('content')
            <div class="text-center mt-5">
                <p class="fs-4">
                    Hi, <a href="{{ route('login') }}">Login</a> or 
                    <a href="{{ route('register') }}">Register</a> to create a product list.
                </p>
            </div>
            @endsection
    </main>
