@extends('layout')
@section('title', 'Create Company')

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

  /* Styling for the select element */
select[name="role"] {
    width: 100%; /* Full width of its container */
    padding: 0.5rem; /* Padding inside the select */
    font-size: 1rem; /* Font size */
    border: 1px solid #ccc; /* Border color */
    border-radius: 4px; /* Rounded corners */
    background-color: #fff; /* Background color */
    appearance: none; /* Remove default styling */
    cursor: pointer; /* Pointer cursor on hover */
    background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHZpZXdCb3g9IjAgMCAxOCAxOCIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWpvaW4taW5vcnM9InJvdW5kIj4KPHBhdGggZD0iTTEuMTE1LDEuMTI3NEMxLjAwNSwzLjc2LDEuNTgyLDIuMTUyLDEuMTE1LDEuNDk3IiBzdHJva2U9IiMyNTI1IiBzdHJva2Utd2lkdGg9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPHBhdGggZD0iTTEuMDE5LDguMDAxQzEuMDE5LDguMDAxLDEuMDE5LDcuODExLDEuMDE5LDYuNzk5IiBzdHJva2U9IiMyNTI1IiBzdHJva2Utd2lkdGg9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPHBhdGggZD0iTTcuMTE1LDEuMDE5QzcuMTE1LDEuMDE5LDEuMDE5LDEuMDk0LDEuMDE5LDkuODExIiBzdHJva2U9IiMyNTI1IiBzdHJva2Utd2lkdGg9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPHBhdGggZD0iTTEuMDA5LDEyLjI5QzEuMDA5LDEyLjI5LDEuMDA5LDEyLjI5LDEuMDA5LDEyLjI5IiBzdHJva2U9IiMyNTI1IiBzdHJva2Utd2lkdGg9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPHBhdGggZD0iTTEuMDA5LDEuMDA5QzEuMDA5LDEuMDA5LDEuMDA5LDEuMDA5LDEuMDA5LDEuMDA5IiBzdHJva2U9IiMyNTI1IiBzdHJva2Utd2lkdGg9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPC9zdmc+'); /* Arrow icon */
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
}

/* Remove default styling of the dropdown arrow */
select[name="role"]::-ms-expand {
    display: none;
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
</style>
@endsection

@section('bodycontent')
<div class="container">
    <div class="header">
        <div class="logo"></div>
        <div class="title">Create Company</div>
    </div>
    
    <form class="login-form" action="{{ route('company.invite', ['companyId' => $company->id]) }}" method="POST">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="input">
        <label for="email" class="input-label"><svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22.2222 22.6257V20.5402C22.2222 19.4341 21.754 18.3732 20.9205 17.591C20.087 16.8088 18.9565 16.3694 17.7778 16.3694H8.8889C7.71016 16.3694 6.5797 16.8088 5.74621 17.591C4.91271 18.3732 4.44446 19.4341 4.44446 20.5402V22.6257" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.3334 12.1986C15.788 12.1986 17.7778 10.3313 17.7778 8.02779C17.7778 5.72429 15.788 3.85693 13.3334 3.85693C10.8788 3.85693 8.88892 5.72429 8.88892 8.02779C8.88892 10.3313 10.8788 12.1986 13.3334 12.1986Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
</svg></label>
        <input type="email" id="email" name="email" class="input-field" required placeholder="EMAIL">
        </div>
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <div class="input">
    <label for="role" class="input-label">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.99996 1.08325C12.7319 1.08325 14.5979 1.08325 15.7573 2.24262C16.9166 3.40199 16.9166 5.26797 16.9166 8.99992C16.9166 12.7319 16.9166 14.5978 15.7573 15.7572C14.5979 16.9166 12.7319 16.9166 8.99996 16.9166C5.26801 16.9166 3.40203 16.9166 2.24266 15.7572C1.08329 14.5978 1.08329 12.7319 1.08329 8.99992C1.08329 5.26797 1.08329 3.40199 2.24266 2.24262C3.40203 1.08325 5.26801 1.08325 8.99996 1.08325Z" stroke="white"/>
            <path d="M12.3333 9.97214L10.5713 11.6757C9.83053 12.3918 9.46016 12.7499 8.99992 12.7499C8.53968 12.7499 8.16931 12.3918 7.42857 11.6757L5.66659 9.97214M12.3333 5.24992L10.5713 6.95345C9.83053 7.66961 9.46016 8.0277 8.99992 8.0277C8.53968 8.0277 8.16931 7.66961 7.42857 6.95345L5.66659 5.24992" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </label>
    <select name="role" id="role">
    <option value="Select a Role" id="role-option"><span>Select a Role</span></option>
        @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}
            </option>
        @endforeach
    </select>
</div>

        <button type="submit">Send Invitation</button>
    </form>
   
    </form>
</div>
@endsection



