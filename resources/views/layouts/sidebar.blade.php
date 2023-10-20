



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  
   
  

    



 
  body {
    font-family: "Lato", sans-serif;
  }
  
  .sidenav {
    height: 100%;
    width: 140px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
  }
  
  .sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
  }
  
  .sidenav a:hover {
    color: #f1f1f1;
  }
  
  .main {
    margin-left: 160px; /* Same as the width of the sidenav */
    font-size: 28px; /* Increased text to enable scrolling */
    padding: 0px 10px;
  }
  
  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  </style>
  </head>
  <body>
    
  <div class="sidenav">

    @auth
    <li>
        <span>Welcome,{{ Auth::user()->name}} </span>
    </li>
@endauth

    @can('role-list')
    <li>
        <a href="{{ route('roles.index') }}">Role </a>
    </li>
    @endcan

  
    @can('post-list')
    <li>
         <a href="{{ route('posts.index') }}">Post </a> 
    </li>
    @endcan
    
    @can('user-list')
    <li>
         <a href="{{ route('users.index') }}">User </a> 
    </li>
    @endcan

    <li>
      <a href="{{ route('logout') }}">logout </a> 
 </li>

 
  </div>
  
  <div class="main">
    {{--@auth
    <p>Hi, {{ auth()->user()->name }}</p>
    @endauth--}}
    <p>Hi: {{ Auth::user()->name}}</P>
  </div>
     
  </body>
  </html> 
  
    

