<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <span class="navbar-text">
    @auth Welcome {{ auth()->user()->name }} to your @endauth</span>

    <a class="navbar-brand" href="/login"> {{ config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/login">Home</a>
        </li>
        @auth
        
        </li>
        <a class="nav-link" href="/categories">Category</a>
        </li>
      
      </li>
        <a class="nav-link" href="{{ route('tasks.index') }}">Create Task</a>
        </li>
        
        </li>
        <a class="nav-link" href="/logout">LogOut</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/login">LogIn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/registration">SignUp</a>
        @endauth
        </li>
      </ul>
      </span>
    </div>
  </div>
</nav>