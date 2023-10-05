<div class="image-container">
    <img src="{{ asset('images/Button_backpack_logo.png') }}" alt="Invantry Logo" class="mx-auto d-block centered-image">
    <div class="app-name">Invantry</div>
    <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
    <div class="get-started">GET STARTED</div>
    <button class="action-btn login-btn">Login</button>
    <button class="action-btn signup-btn">Sign Up</button>
</div>

<style>
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

    .get-started {
        text-align: center;
        font-size: .85em;
        font-weight: bold;
        margin-top: 60px;
        cursor: default;
        color: gray;
        font-family: 'Panton-LightCaps', Arial, sans-serif;
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
        width: 240px; /* Fixed width for both buttons */
        text-align: center;
    }

    .action-btn:hover {
        background-color: #0056b3;
    }

    .login-btn {
        margin-top: 70px;
    }

    .signup-btn {
        margin-top: 25px;
    }
</style>
