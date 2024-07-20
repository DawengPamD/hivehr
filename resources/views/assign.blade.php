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
    width: 450px;
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

.company-form {
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
    align-items: center;
    padding: 0px 0px 0px 10px;
    border: 1px solid #FFFFFF;
    border-radius: 3px;
}

.input-label {
    display: flex;
    margin-right: 10px;
    align-items: center;
    justify-content: center;
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
    padding: 15px;
    background: transparent;
    border: 1px solid transparent;
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

input[type="text" i],
input[type="email" i],
input[type="password" i] {
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 20px;
}

textarea::placeholder {
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 50;
    line-height: 20px;
}

textarea {
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 20px;
    background: transparent;
    border: 1px solid transparent;
    padding: 15px;
    border-radius: 3px;
    min-height: 70px;
}

.select-field {
    width: 100%;
    background: transparent;
    color: #FFFFFF;
    font-family: 'Montserrat', Arial, sans-serif;
    font-size: 12px;
    font-weight: 100;
    line-height: 20px;
    border: 1px solid #FFFFFF;
    padding: 10px;
    border-radius: 3px;
}

.submit-button {
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
    margin-top: 25px;
}

.submit-button:hover {
    background-color: #5297FF;
    color: #FFFFFF;
}
</style>
@endsection

@section('bodycontent')
<div class="container">
    <div class="action">
        <p>Choose an action, {{ Auth::user()->name }}:</p>
        <ul>
            <li><a id="show-create" class="action-link">Create a Company</a></li>
            <li><a href="{{ route('dashboard') }}" class="action-link">Go to Dashboard</a></li>
        </ul>
    </div>

    <div id="create" class="create-form" style="display:none;">
        <div class="header">
            <div class="logo"></div>
            <div class="title">Create Company</div>
        </div>
        
        <form class="company-form" action="{{ route('company.store') }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="input">
            <label for="email" class="input-label"> <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22.2222 22.6257V20.5402C22.2222 19.4341 21.754 18.3732 20.9205 17.591C20.087 16.8088 18.9565 16.3694 17.7778 16.3694H8.8889C7.71016 16.3694 6.5797 16.8088 5.74621 17.591C4.91271 18.3732 4.44446 19.4341 4.44446 20.5402V22.6257" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.3334 12.1986C15.788 12.1986 17.7778 10.3313 17.7778 8.02779C17.7778 5.72429 15.788 3.85693 13.3334 3.85693C10.8788 3.85693 8.88892 5.72429 8.88892 8.02779C8.88892 10.3313 10.8788 12.1986 13.3334 12.1986Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
</svg>  </label>
            <input type="text" id="name" name="name" class="input-field" required placeholder="COMPANY NAME">
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z" stroke="white" stroke-linejoin="round"/>
</svg></label>
                <input type="email" id="email" name="email" class="input-field" required placeholder="EMAIL">
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.1112 11.5303H5.5556C4.3283 11.5303 3.33337 12.464 3.33337 13.6157V20.9147C3.33337 22.0664 4.3283 23.0001 5.5556 23.0001H21.1112C22.3385 23.0001 23.3334 22.0664 23.3334 20.9147V13.6157C23.3334 12.464 22.3385 11.5303 21.1112 11.5303Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.77783 11.5302V7.35932C7.77783 5.9766 8.36315 4.6505 9.40502 3.67277C10.4469 2.69504 11.86 2.14575 13.3334 2.14575C14.8068 2.14575 16.2199 2.69504 17.2618 3.67277C18.3036 4.6505 18.8889 5.9766 18.8889 7.35932V11.5302" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
</svg> </label>
                <input type="password" id="password" name="password" class="input-field" required placeholder="PASSWORD">
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9 11.5L9 12.75" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1.5 8.16675L1.6274 10.5528C1.76428 13.5642 1.83272 15.07 2.79904 15.9934C3.76536 16.9167 5.27263 16.9167 8.28719 16.9167H9.71281C12.7274 16.9167 14.2346 16.9167 15.201 15.9934C16.1673 15.07 16.2357 13.5642 16.3726 10.5528L16.5 8.16675" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1.37282 7.70255C2.78889 10.3954 5.98283 11.5 9.00016 11.5C12.0175 11.5 15.2114 10.3954 16.6275 7.70255C17.3035 6.41713 16.7916 4 15.1268 4H2.8735C1.20869 4 0.696852 6.41714 1.37282 7.70255Z" stroke="white"/>
<path d="M12.3332 4.00004L12.2596 3.74249C11.8929 2.45912 11.7096 1.81743 11.2731 1.4504C10.8366 1.08337 10.2568 1.08337 9.09731 1.08337H8.90237C7.74283 1.08337 7.16306 1.08337 6.72659 1.4504C6.29011 1.81743 6.10677 2.45912 5.74009 3.74249L5.6665 4.00004" stroke="white"/>
</svg>
 </label>
                <input type="text" id="industry" name="industry" class="input-field" required placeholder="INDUSTRY">
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5 17.5H8.33333C5.58347 17.5 4.20854 17.5 3.35427 16.6457C2.5 15.7915 2.5 14.4165 2.5 11.6667V2.5" stroke="white" stroke-opacity="0.8" stroke-linecap="round"/>
<path d="M14.7538 7.77794L12.3591 11.6539C12.0101 12.2187 11.6139 13.0718 10.8956 12.9455C10.0508 12.7968 9.64502 11.5376 8.91869 11.1206C8.32721 10.7811 7.8996 11.1903 7.5538 11.6668M17.4998 3.3335L15.9552 5.8335M4.1665 16.6668L6.27177 13.5557" stroke="white" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
 </label>
                <select id="size" name="size" class="select-field" required>
                    <option value="" disabled selected>COMPANY SIZE</option>
                    <option value="1-10">1-10</option>
                    <option value="11-50">11-50</option>
                    <option value="51-200">51-200</option>
                    <option value="201-500">201-500</option>
                    <option value="501-1000">501-1000</option>
                    <option value="1001+">1001+</option>
                </select>
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.529922 13.394C0.317268 14.7471 1.268 15.6862 2.43205 16.1542C6.89481 17.9486 13.1052 17.9486 17.5679 16.1542C18.732 15.6862 19.6827 14.7471 19.4701 13.394C19.3394 12.5625 18.6932 11.8701 18.2144 11.194C17.5873 10.2975 17.525 9.31971 17.5249 8.27941C17.5249 4.2591 14.1559 1 10 1C5.84413 1 2.47513 4.2591 2.47513 8.27941C2.47503 9.31971 2.41272 10.2975 1.78561 11.194C1.30684 11.8701 0.660612 12.5625 0.529922 13.394Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7 20C7.79613 20.6219 8.84747 21 10 21C11.1525 21 12.2039 20.6219 13 20" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
 </label>
                <input type="text" id="address" name="address" class="input-field" required placeholder="ADDRESS">
            </div>
            <div class="input">
            <label for="email" class="input-label"> <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1H13" stroke="white" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4.33337 5H9.66671" stroke="white" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 9H13" stroke="white" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4.33337 13H9.66671" stroke="white" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
 </label>
                <textarea id="description" name="description" class="input-field" required placeholder="COMPANY DESCRIPTION" rows="4"></textarea>
            </div>
            <button type="submit" class="submit-button">CREATE COMPANY</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {

    // Function to switch to registration form
    function showRegisterForm() {
        document.querySelector('.action').style.display = "none";
        document.querySelector('.create-form').style.display = "block";
    }

    // Event listener for showing registration form
    document.getElementById("show-create").addEventListener("click", function(e) {
        e.preventDefault();
        showRegisterForm();
    });

    // Event listener for showing login form
    document.getElementById("showaction").addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector('.action').style.display = "block";
        document.querySelector('.create-form').style.display = "none";
    });
});
</script>
@endsection