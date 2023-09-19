<div class="image-container">
    <img src="{{ asset('images/Button_backpack_logo.png') }}" alt="Invantry Logo" class="mx-auto d-block centered-image">
    <div class="app-name">Invantry</div>
    <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
    <div class="welcome-back">WELCOME BACK</div>
    <input type="text" class="username-input" placeholder="Username/Email address">
    <div class="password-container">
        <input type="password" id="passwordField" class="password-input" placeholder="Password">
        <span id="togglePassword" class="password-icon">👁</span>
    </div>
    <button class="action-btn continue-btn">Continue</button>
    <div class="sign-up">DON'T HAVE AN ACCOUNT? <a href="#" class="sign-up-link">SIGN UP</a></div>
</div>

<style>
    @font-face {
        font-family: 'Recharge';
        src: url('{{ asset('fonts/recharge/recharge bd.otf') }}') format('opentype');
    }

    @font-face {
        font-family: 'Panton-LightCaps';
        src: url('{{ asset('fonts/panton/Panton-LightCaps.otf') }}') format('opentype');
    }

    .image-container {
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;  
    }

    .centered-image {
        margin-top: -10%;
        transform: scale(0.33);
    }

    .app-name {
        text-align: center;
        font-size: 2em;
        font-weight: bold;
        margin-top: -60px;
        font-family: 'Recharge', Arial, sans-serif;
    }

    .description {
        text-align: center;
        font-size: .5em;
        margin-top: 10px;
        color: gray;
        font-family: 'Panton-LightCaps', Arial, sans-serif;
    }

    .welcome-back {
        text-align: center;
        font-size: .85em;
        font-weight: bold;
        margin-top: 60px;
        cursor: default;
        color: gray;
        font-family: 'Panton-LightCaps', Arial, sans-serif;
    }

    .sign-up {
        text-align: center;
        font-size: .75em;
        font-weight: bold;
        margin-top: 30px;
        cursor: default;
        color: gray;
        font-family: 'Panton-LightCaps', Arial, sans-serif;
    }

    .sign-up-link {
        color: #007BFF; 
        text-decoration: none; 
        cursor: pointer;
    }

    .sign-up-link:hover {
        text-decoration: underline; 
    }

    .action-btn {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 16px 20px;
        border-radius: 4px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 240px; 
        text-align: center;
    }

    .action-btn:hover {
        background-color: #0056b3;
    }

    .continue-btn {
        margin-top: 40px;
    }

    .signup-btn {
        margin-top: 25px;
    }

    .username-input, .password-input {
        padding: 20px 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        font-size: 1em;
        width: 399px; 
    }

    .username-input {
        margin-top: 60px;
    }

    .password-input {
        padding-right: 40px; 
    }

    .username-input::placeholder, .password-input::placeholder {
        color: #aaa;
    }

    .password-container {
        position: relative;
        margin-top: 5px;
    }

    .password-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 1.2em;
        color: darkgray;
    }

    .password-icon.active {
        color: gray;
    }
</style>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('passwordField');
        const icon = document.getElementById('togglePassword');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.add('active'); // Add active class when password is visible
        } else {
            passwordField.type = 'password';
            icon.classList.remove('active'); // Remove active class when password is hidden
        }
    });
</script>
