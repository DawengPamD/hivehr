@extends('layout')
@section('title', 'HiveHR Login')

@section('style')
<style>
@font-face {
    font-family: 'MyCustomFont';
    src: url('/fonts/myfont.woff2') format('woff2'),
         url('/fonts/myfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
@import url('https://rsms.me/inter/inter.css');

body {
    background: url('/images/login_bg.png') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    height: 380px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.header {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.logo {
    margin-right: 10px;
}

.title {
    font-size: 28px;
    font-family: 'Preahvihear', Arial, sans-serif;
    font-weight: 400;
    color: #000000;
    line-height: 15px;
}

.login-form{
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    height: auto;
    padding: 10px;
    padding-top: 0;
}

.input {
         position: relative;
         margin-top: 10px;
         display: flex;
         flex-direction: row;
         align-items: center; /* Center vertically */
         padding: 0px 0px 0px 10px;
         border: 1px solid #FFFFFF;
         border-radius: 3px; /* Adjust as needed */
     }

     .input-label {
         display: flex;
         margin-right: 10px;
         align-items: center; /* Center vertically */
         justify-content: center; /* Center horizontally */
         height: 100%;
         background: transparent;
         white-space: nowrap;
         transform: translate(0, 0);
         transition: transform 120ms ease-in;
         font-weight: bold;
         color: #ffffff;
         line-height: 1.2;
     }

     .input-field {
         box-sizing: border-box;
         display: block;
         width: 100%;
         height: 40px;
         padding: 15px; /* Adjust as needed */
         background: transparent;
         border: 1px solid transparent;
         &:focus,
         &:not(:placeholder-shown) + .input__label {
         }
     }

     input::placeholder {
         color: #FFFFFF;
         font-family: 'Montserrat', Arial, sans-serif;
         font-size: 12px;
         font-weight: 50;
         line-height: 20px;
     }

     input:-internal-autofill-selected {
        background: transparent !important;
     }

     input[type="email" i] {
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 20px;
  }

  input[type="password" i] {
  color: #FFFFFF;
  font-family: 'Montserrat', Arial, sans-serif;
  font-size: 12px;
  font-weight: 100;
  line-height: 20px;
  }

  input[type="text" i] {
  color: #FFFFFF;
  font-family: 'Montserrat', Arial, sans-serif;
  font-size: 12px;
  font-weight: 100;
  line-height: 20px;
  }


.login-button {
    width: 100%;
    height: 50px;
    padding: 10px;
    background-color: #FFFFFF;
    color: #2148C0;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 16px;
    font-weight: 600;
    line-height: 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    margin-bottom: 10px;
    margin-top: 25px;
}

.login-button:hover {
    background-color: #5297FF;
    color: #FFFFFF;
}

.forgot-password {
    display: flex;
    flex-direction: column;
    position: relative;
    left: 35%;
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 20px;
}

.forgot-password a {
    padding-top: 8px;
    text-decoration: none;
    color: inherit;
}

.forgot-password a:hover {
    text-decoration: underline;
}
</style>
@endsection


@section('bodycontent')
<div class="container">
    <div class="header">
        <div class="logo">
        </div>
        <div class="title">HiveHR</div>
    </div>
    
    @csrf
        <!-- Display error message if login fails -->
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Display success message if present -->
         @if(session('success'))
         <div class="alert alert-success">
        {{ session('success') }}
         </div>
        @endif

    <form class="login-form" action="{{ route('login.post') }}" onsubmit="resetForm(this)" method="POST">
    @csrf
        <div class="input">
            <label for="email" class="input-label">
            </label>
            <input type="email" id="email" name="email" class="input-field" required placeholder="EMAIL">
        </div>
        <div class="input">
            <label for="password" class="input-label">
            </label>
            <input type="password" id="password" name="password" class="input-field" required placeholder="PASSWORD">
        </div>
        <button type="submit" class="login-button">LOGIN</button>
        <div class="forgot-password">
            <a href="">Forgot password?</a>
            <a id="showRegister">Don't have an account?</a>
        </div>
    </form>
    
    <form class="register-form" action="{{ route('register.post') }}" method="POST" style="display:none;">
    @csrf
        <input type="hidden" name="token" value="{{ $token ?? '' }}">
        <input type="hidden" name="company_id" value="{{ $company->id ?? '' }}">
        <div class="input">
            <label for="name" class="input-label"></label>
            <input type="text" id="name" name="name" class="input-field" required placeholder="NAME">
        </div>
        <div class="input">
            <label for="email" class="input-label"></label>
            <input type="email" id="email" name="email" class="input-field" required placeholder="EMAIL" value="{{ $email ?? '' }}" {!! isset($email) ? '' : '' !!}>
            </div>
        <div class="input">
            <label for="password" class="input-label"></label>
            <input type="password" id="password" name="password" class="input-field" required placeholder="PASSWORD">
        </div>
        <div class="input">
            <label for="password_confirmation" class="input-label"></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required placeholder="CONFIRM PASSWORD">
        </div>
        <button type="submit" class="login-button">REGISTER</button>
        <div class="forgot-password">
            <a href="#" id="showLogin">Already have an account?</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {

    // Function to switch to registration form
    function showRegisterForm() {
        document.querySelector('.login-form').style.display = "none";
        document.querySelector('.register-form').style.display = "block";
    }

    // Check if token is present to trigger registration form
    @if(isset($key))
        showRegisterForm();
    @endif

    // Event listener for showing registration form
    document.getElementById("showRegister").addEventListener("click", function(e) {
        e.preventDefault();
        showRegisterForm();
    });

    // Event listener for showing login form
    document.getElementById("showLogin").addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector('.login-form').style.display = "block";
        document.querySelector('.register-form').style.display = "none";
    });

    function resetForm(form) {
        setTimeout(function() {
            form.reset();
        }, 0);
    }
});
</script>
@endsection

