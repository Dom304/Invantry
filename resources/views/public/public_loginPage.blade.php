
<div class="image-container">
    <img src="{{ asset('images/Button_backpack_logo.png') }}" alt="Invantry Logo" class="mx-auto d-block centered-image">
    <div class="app-name">Invantry</div>
    <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
    <div class="welcome-back">WELCOME BACK</div>
    <form action="{{route('login')}}" method="POST">
    @csrf
    <input type="email" class="username-input" placeholder="Email address" name="email">
    <div class="password-container">
        <input type="password" id="passwordField" class="password-input" placeholder="Password" name="password">
    </div>
    <button class="action-btn continue-btn">Continue</button>
    </form>
    <div class="sign-up">DON'T HAVE AN ACCOUNT? <a href="/" class="sign-up-link">SIGN UP</a></div>
</div>

@section('content')
<example-component></example-component>
<Login></Login>
@endsection