@extends('layout_dashboard')
@section('title', 'HiveHR Dashboard')

@section('style') 
<style>
@import url('https://rsms.me/inter/inter.css');
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

/* Root variables */
:root {
    --sidebar-width: 0;
    /*margin-left: var(--sidebar-width);*/
}

/* Base styles */
body {
    margin: 0;
    font-family: 'Outfit', Arial, sans-serif;
    font-weight: 300;
    line-height: 1.5;
}

.full-screen {
    width: 100%;
    height: 100vh;
    display: flex;
}

.half-screen {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
    overflow-y: auto;
    -ms-overflow-style: none;  /* IE 10+ */
    scrollbar-width: none;  /* Firefox */}

.header {
    flex: 0 0 auto;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 10;  /* Ensures header is above other elements */
}

.listView {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 10px;
    gap: 5px;
    overflow-y: auto;
    transition: all 0.3s ease;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .full-screen {
        flex-direction: column;
    }

    .half-screen {
        padding: 5px;
    }

    .header {
        padding: 10px;
    }

    .filter-bar input[type="text"] {
        width: auto;
    }

    .cards {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 90%;
        margin-bottom: 20px;
    }

    .sidebar {
        position: relative;
        height: auto;
        padding: 10px;
        transition: padding 0.3s ease;
    }

    .logo-container {
        padding: 10px;
    }

    .navigation ul li a {
        padding: 10px;
    }

    .navigation ul li .dropdown-btn {
        padding: 10px;
    }

    .navigation ul li .dropdown-container a {
        padding-left: 20px;
    }

    .listView {
        padding: 5px;
    }
}

/* Header Styles */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    transition: all 0.3s ease;
} 

.top-half{
    flex: 0 0 auto;
}

.header-left {
    display: flex;
    align-items: center;
}

.header-left p {
    margin: 0;
    margin-right: 20px;
    font-size: 14px;
}

.header-left .username {
    font-weight: bold;
    color: #333;
}

.header-left .icon {
    background-color: #000;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
}

.header-right {
    display: flex;
    align-items: center;
}

.topic {
    padding: 5px 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 5px;
}

.title-time {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    justify-items: center;
}

.header-right img {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-left: 10px;
}

.header-right .date {
    margin-right: 10px;
    font-size: 12px;
}

.dashboard-title {
    font-family: 'Outfit', Arial, sans-serif;
    font-size: 18px;
}

.breadcrumb {
    color: #888;
    font-size: 12px;
}

/* Card Styles */
.cards {
    display: flex;
    justify-content: space-between;
    gap: 14px;
}

.card {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 10px 20px;
    text-align: center;
    width: 18%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.top-card {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.top-card p {
    margin: 0 !important;
    padding: 0;
    align-self: center;
}

.bottom-card {
    width: auto;
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: flex-start;
}

.card h3 {
    margin: 0;
    color: #888;
}

.card .percentage {
    color: green;
    margin-bottom: 10px;
}

.card .red {
    color: red;
}

.card .value {
    font-size: 18px;
    font-weight: bold;
    margin: 0px !important;
}

.card .description {
    color: #888;
}

/* Filter Bar Styles */
.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 0px 20px;
    border-radius: 8px;
    flex-wrap: wrap;
}

.filter-bar .left,
.filter-bar .right {
    display: flex;
    align-items: center;
}

.filter-bar input[type="text"],
.filter-bar select,
.filter-bar button {
    height: auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-right: 10px;
    font-family: 'Outfit', Arial, sans-serif;
    font-size: 14px;
    font-weight: 350;
    line-height: 12px;
}

.filter-bar input[type="text"] {
    width: 377px;
    flex: 1;
    padding-left: 35px;
    background: url('https://img.icons8.com/ios-filled/50/000000/search--v1.png') no-repeat 10px center;
    background-size: 20px;
}

.filter-bar select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url('https://img.icons8.com/material-outlined/24/000000/sort-down.png') no-repeat right 10px center;
    background-size: 20px;
    padding-right: 30px;
}

.filter-bar button {
    background-color: transparent;
    color: #000000;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.filter-bar button svg {
    margin-right: 5px;
}

.filter-bar button:hover {
    background-color: #007bff;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-height: 0; /* Allows the content to shrink */
}

table {
    height: 100%;
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #f1f1f1;
}

th, td {
    padding: 13px;
    text-align: left;
}

th {
    font-weight: 450;
    position: sticky;
    top: 0;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 12px;
    color: #fff;
    font-size: 0.9em;
}

.status.completed {
    border: 0.5px solid #069855;
    background-color: #E6F5EE;
    color: #069855;
}

.status.ongoing {
    background-color: #FDF4F4;
    border: 0.5px solid #D62525;
    color: #D62525;
}

progress {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    box-sizing: border-box;
    height: 15px;
    border-radius: 10px;
    overflow: hidden;
    background-color: #e0e0e0;
    border: none;
}

progress::-webkit-progress-bar {
    background-color: #5297FF;
    border-radius: 10px;
}

progress::-webkit-progress-value {
    background-color: #534FEB;
    border-radius: 10px 10px 10px 10px;
    transition: width 0.4s ease;
}

progress::-moz-progress-bar {
    background-color: #007bff;
    border-radius: 10px 0 0 10px;
    transition: width 0.4s ease;
}

/* Scrollbar Styles */
.listView::-webkit-scrollbar {
    width: 8px;
}

.listView::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.listView::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
    border: 3px solid #f1f1f1;
}

.listView::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 20px;
    padding-top: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 5px;
    font-size: 0.75em;
}

.buttons button {
    padding: 6px 10px;
    border: none;
    background-color: #F5F5F5;
    color: #000000;
    cursor: pointer;
    margin: 0 5px;
    border: 0.5px solid #0000000D;
    border-radius: 5px;
}

.buttons button:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
}

.buttons button:hover:not(:disabled) {
    background-color: #0056b3;
}

.page-label p {
    padding: 5px 0px;
    margin: 0;
}

.page-label p b {
    font-weight: 500;
    margin: 0 10px;
}

/* Sidebar Styles */
.sidebar {
    background-color: #F5F5F5;
    padding: 5px;
    padding-top: 0px;
    overflow-y: auto;
    -ms-overflow-style: none;  /* IE 10+ */
    scrollbar-width: none;  /* Firefox */
    transition: width 0.3s ease, background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    display: flex; /* Ensure sidebar itself is a flex container */
    flex-direction: column; /* Arrange children vertically */       
}

.sidebar::-webkit-scrollbar {
    display: none;
}

.logo-container {
    display: flex;
    flex-direction: row;
    padding: 20px 20px 0px 10px;
    margin-bottom: 20px;
    align-items: center;
    gap: 10px;
    font-family: 'Preahvihear', Arial, sans-serif;
    font-size: 18px;
    font-weight: 550;
    line-height: 14px;
    text-align: left;
    transition: padding 0.3s ease;
}

.navigation {
    display: flex;
    flex: 1;
    flex-direction: column;
    justify-content: flex-start;
    padding: 0 5px;
    padding-top: 10px;
}

.navigation ul {
    width: 100%; /* Full width of the navigation */
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex; /* Display as flex for vertical stacking */
    flex-direction: column; /* Stack items vertically */
    justify-content: space-between; /* Distribute items evenly */
}

.navigation ul li {
    margin: 5px 0;
    width: 100%;
    border-radius: 12px 0px 0px 12px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.navigation ul li a {
    text-decoration: none;
    color: #333;
    border-radius: 10px;
    font-size: 14px;
    padding: 10px 12px;
    display: block;
    transition: background-color 0.3s ease, color 0.3s ease, padding-left 0.3s ease;
}

.navigation ul li a:hover {
    background-color: #f0f0f0;
    padding-left: 25px;
}

.navigation ul li a.active {
    background-color: #007bff;
    color: white;
    padding-left: 25px;
}

.navigation ul li .dropdown-btn {
    display: flex;
    gap: 10px;
    align-items: center;
    text-decoration: none;
    color: inherit;
    border-radius: 10px;
    transition: background-color 0.3s ease, color 0.3s ease, padding-left 0.3s ease;
}

.navigation ul li .dropdown-btn:hover {
    background-color: #f0f0f0;
    padding-left: 25px;
}

.navigation ul li .dropdown-container {
    display: none;
    list-style-type: none;
    padding-left: 20px;
    transition: all 0.3s ease;
}

.navigation ul li .dropdown-container a {
    padding-left: 30px;
}

.icon-container{
    display: flex;
    justify-content: center;
}

.navigation ul li .arrow {
    display: flex;
    align-items: center;
    margin-left: auto;
    transition: transform 0.3s ease;
}

.navigation ul li .arrow.rotate {
    transform: rotate(180deg);
}

.show {
    display: flex !important;
    flex-direction: column;
}

.show .dropdown-container {
    display: block !important;
}

/* Sidebar Toggle Animation */
.sidebar.collapsed {
    width: 60px;
}

.sidebar.collapsed .logo-container,
.sidebar.collapsed .navigation ul li a,
.sidebar.collapsed .navigation ul li .dropdown-btn {
    padding-left: 10px;
    padding-right: 10px;
    justify-content: center;
    text-align: center;
}

.sidebar.collapsed .navigation ul li a span,
.sidebar.collapsed .navigation ul li .dropdown-btn span {
    display: none;
}

.sidebar.collapsed .arrow {
    display: none;
}


.collapsed-header {
    display: none;
}

.collapsed-sidebar {
    display: none;
}

.expanded-fullscreen {
    width: 100%;
}

.toggle-btn {
    background-color: #555;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card, .filter-bar, .header, .navigation ul li {
    animation: slideIn 0.5s ease-in-out;
}
</style>

@endsection

@section('sidebar-content') 
<div class="sidebar">
      <div class="logo-container">
        <div class="logo">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M37.8 20C39.015 20 40.0125 20.988 39.8792 22.1957C39.42 26.3535 37.6652 30.2835 34.8349 33.4136C31.5105 37.0903 26.9392 39.4015 22.0075 39.899C17.0758 40.3965 12.135 39.045 8.14319 36.1064C4.1514 33.1678 1.39305 28.8516 0.403005 23.9947C-0.587041 19.1378 0.26176 14.0863 2.78482 9.81975C5.30788 5.55316 9.32542 2.3755 14.0584 0.902947C18.7914 -0.56961 23.9026 -0.23214 28.4009 1.84992C32.2305 3.62249 35.3836 6.552 37.4336 10.1984C38.029 11.2575 37.4978 12.5571 36.3798 13.0327C35.2617 13.5083 33.9825 12.9767 33.3545 11.9366C31.7545 9.2866 29.392 7.15711 26.5527 5.84294C23.044 4.21893 19.0573 3.9557 15.3656 5.1043C11.6738 6.25289 8.54015 8.73146 6.57216 12.0594C4.60417 15.3873 3.94211 19.3275 4.71434 23.1159C5.48658 26.9043 7.63809 30.2709 10.7517 32.563C13.8653 34.8551 17.7191 35.9093 21.5658 35.5212C25.4126 35.1331 28.9782 33.3304 31.5712 30.4626C33.6696 28.1419 35.0101 25.2576 35.4452 22.1928C35.6159 20.9898 36.585 20 37.8 20Z" fill="#534FEB"/>
          <path d="M20 9.32C20 8.59098 19.4072 7.99249 18.6826 8.07252C16.8784 8.2718 15.1368 8.87858 13.5924 9.85395C11.6746 11.0651 10.1394 12.7949 9.16464 14.843C8.18989 16.891 7.81553 19.1733 8.08496 21.4255C8.30195 23.2392 8.92932 24.9734 9.91246 26.4994C10.3073 27.1122 11.1456 27.1948 11.7114 26.7351C12.2772 26.2753 12.3539 25.4478 11.9782 24.823C11.2994 23.6939 10.8639 22.4298 10.7063 21.1119C10.4961 19.3552 10.7881 17.575 11.5484 15.9775C12.3087 14.38 13.5062 13.0308 15.002 12.0861C16.1243 11.3773 17.38 10.9181 18.6844 10.7329C19.4061 10.6304 20 10.049 20 9.32Z" fill="#534FEB"/>
          <path d="M25.748 15.7982C26.1403 15.5114 26.2292 14.9569 25.9011 14.5984C25.084 13.7058 24.0722 13.0072 22.9397 12.5597C21.5333 12.004 19.9983 11.8583 18.5126 12.1395C17.0269 12.4206 15.6512 13.1171 14.5451 14.1481C13.6544 14.9785 12.9678 15.9984 12.5333 17.1279C12.3588 17.5815 12.6442 18.0652 13.1142 18.1888C13.5842 18.3124 14.0598 18.0282 14.2483 17.5802C14.5889 16.7706 15.0979 16.0389 15.7452 15.4355C16.6079 14.6313 17.6809 14.0881 18.8398 13.8688C19.9987 13.6495 21.196 13.7632 22.2929 14.1966C23.1159 14.5217 23.8571 15.0169 24.4699 15.646C24.8091 15.9941 25.3556 16.085 25.748 15.7982Z" fill="#534FEB"/>
          </svg>
        </div>
        <div class="title">HiveHR</div>
      </div>
        <div class="navigation">
            <ul>
              <li>

                <a href="{{ route('dashboard') }}" class="dropdown-btn">
                  <div class="icon-container">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.6665 15C1.6665 13.7163 1.6665 13.0744 1.95544 12.6029C2.11712 12.3391 2.33895 12.1172 2.60278 11.9556C3.07429 11.6666 3.71614 11.6666 4.99984 11.6666C6.28354 11.6666 6.92538 11.6666 7.39689 11.9556C7.66073 12.1172 7.88255 12.3391 8.04423 12.6029C8.33317 13.0744 8.33317 13.7163 8.33317 15C8.33317 16.2837 8.33317 16.9255 8.04423 17.397C7.88255 17.6608 7.66073 17.8827 7.39689 18.0444C6.92538 18.3333 6.28354 18.3333 4.99984 18.3333C3.71614 18.3333 3.07429 18.3333 2.60278 18.0444C2.33895 17.8827 2.11712 17.6608 1.95544 17.397C1.6665 16.9255 1.6665 16.2837 1.6665 15Z" stroke="black" stroke-opacity="0.8"/><path d="M11.6665 15C11.6665 13.7163 11.6665 13.0744 11.9554 12.6029C12.1171 12.3391 12.3389 12.1172 12.6028 11.9556C13.0743 11.6666 13.7161 11.6666 14.9998 11.6666C16.2835 11.6666 16.9254 11.6666 17.3969 11.9556C17.6607 12.1172 17.8826 12.3391 18.0442 12.6029C18.3332 13.0744 18.3332 13.7163 18.3332 15C18.3332 16.2837 18.3332 16.9255 18.0442 17.397C17.8826 17.6608 17.6607 17.8827 17.3969 18.0444C16.9254 18.3333 16.2835 18.3333 14.9998 18.3333C13.7161 18.3333 13.0743 18.3333 12.6028 18.0444C12.3389 17.8827 12.1171 17.6608 11.9554 17.397C11.6665 16.9255 11.6665 16.2837 11.6665 15Z" stroke="black" stroke-opacity="0.8"/><path d="M1.6665 4.99996C1.6665 3.71626 1.6665 3.07441 1.95544 2.6029C2.11712 2.33907 2.33895 2.11724 2.60278 1.95557C3.07429 1.66663 3.71614 1.66663 4.99984 1.66663C6.28354 1.66663 6.92538 1.66663 7.39689 1.95557C7.66073 2.11724 7.88255 2.33907 8.04423 2.6029C8.33317 3.07441 8.33317 3.71626 8.33317 4.99996C8.33317 6.28366 8.33317 6.92551 8.04423 7.39701C7.88255 7.66085 7.66073 7.88267 7.39689 8.04435C6.92538 8.33329 6.28354 8.33329 4.99984 8.33329C3.71614 8.33329 3.07429 8.33329 2.60278 8.04435C2.33895 7.88267 2.11712 7.66085 1.95544 7.39701C1.6665 6.92551 1.6665 6.28366 1.6665 4.99996Z" stroke="black" stroke-opacity="0.8"/><path d="M11.6665 4.99996C11.6665 3.71626 11.6665 3.07441 11.9554 2.6029C12.1171 2.33907 12.3389 2.11724 12.6028 1.95557C13.0743 1.66663 13.7161 1.66663 14.9998 1.66663C16.2835 1.66663 16.9254 1.66663 17.3969 1.95557C17.6607 2.11724 17.8826 2.33907 18.0442 2.6029C18.3332 3.07441 18.3332 3.71626 18.3332 4.99996C18.3332 6.28366 18.3332 6.92551 18.0442 7.39701C17.8826 7.66085 17.6607 7.88267 17.3969 8.04435C16.9254 8.33329 16.2835 8.33329 14.9998 8.33329C13.7161 8.33329 13.0743 8.33329 12.6028 8.04435C12.3389 7.88267 12.1171 7.66085 11.9554 7.39701C11.6665 6.92551 11.6665 6.28366 11.6665 4.99996Z" stroke="black" stroke-opacity="0.8"/>  </svg>
                      </div>Dashboard
                      <span class="arrow">
                          <svg width="12" height="10" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 0.500038C11 0.500038 7.31756 5.49999 5.99996 5.5C4.68237 5.50001 1 0.499999 1 0.499999" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                          </span>
                        </a>
                  <ul class="dropdown-container">
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Tasks</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Resources</a></li>
                    <li><a href="#">Reports</a></li>
                  </ul>
              </li>
                <li><a href="{{ route('service-providers.index') }}" class="dropdown-btn">
                  <div class="icon-container">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.31656 12.7469C3.26858 13.3612 0.520848 14.6155 2.1944 16.185C3.01192 16.9516 3.92242 17.5 5.06715 17.5H11.5992C12.7439 17.5 13.6544 16.9516 14.4719 16.185C16.1455 14.6155 13.3978 13.3612 12.3498 12.7469C9.89229 11.3065 6.77405 11.3065 4.31656 12.7469Z" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.6667 5.83333C11.6667 7.67428 10.1743 9.16667 8.33333 9.16667C6.49238 9.16667 5 7.67428 5 5.83333C5 3.99238 6.49238 2.5 8.33333 2.5C10.1743 2.5 11.6667 3.99238 11.6667 5.83333Z" stroke="black" stroke-opacity="0.8"/>
                    <path d="M16.2498 3.33337V7.50004M18.3332 5.41671L14.1665 5.41671" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </div>Service Providers <span></span>
                  </a></li>
                <li>
                    <a href="#" class="dropdown-btn">
                      <div class="icon-container">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.3117 15C17.9361 15 18.4328 14.6071 18.8787 14.0576C19.7916 12.9329 18.2928 12.034 17.7211 11.5938C17.14 11.1463 16.4912 10.8928 15.8333 10.8333M15 9.16667C16.1506 9.16667 17.0833 8.23393 17.0833 7.08333C17.0833 5.93274 16.1506 5 15 5" stroke="black" stroke-linecap="round"/>
                        <path d="M2.68846 15C2.06404 15 1.56739 14.6071 1.12145 14.0576C0.20857 12.9329 1.70739 12.034 2.27903 11.5938C2.86014 11.1463 3.50898 10.8928 4.16683 10.8333M4.5835 9.16667C3.4329 9.16667 2.50016 8.23393 2.50016 7.08333C2.50016 5.93274 3.4329 5 4.5835 5" stroke="black" stroke-linecap="round"/>
                        <path d="M6.73667 12.5927C5.88518 13.1192 3.65265 14.1943 5.01241 15.5396C5.67665 16.1968 6.41643 16.6667 7.34652 16.6667H12.6538C13.5839 16.6667 14.3237 16.1968 14.9879 15.5396C16.3477 14.1943 14.1151 13.1192 13.2637 12.5927C11.2669 11.3581 8.73338 11.3581 6.73667 12.5927Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.9168 6.25004C12.9168 7.86087 11.611 9.16671 10.0002 9.16671C8.38933 9.16671 7.0835 7.86087 7.0835 6.25004C7.0835 4.63921 8.38933 3.33337 10.0002 3.33337C11.611 3.33337 12.9168 4.63921 12.9168 6.25004Z" stroke="black"/>
                        </svg>
                        </div>Projects<span class="arrow"><svg width="12" height="10" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 0.500038C11 0.500038 7.31756 5.49999 5.99996 5.5C4.68237 5.50001 1 0.499999 1 0.499999" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    <ul class="dropdown-container">
                        <li><a href="#">Overview | Tasks</a></li>
                        <li><a href="#">Teams</a></li>
                        <li><a href="#">Resources</a></li>
                        <li><a href="#">Reports</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('projects.index') }}" class="dropdown-btn">
                  <div class="icon-container">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 17.5C17.2737 17.6696 17.024 17.8173 16.7551 17.9394C15.8882 18.3333 14.743 18.3333 12.4526 18.3333H7.54736C5.25695 18.3333 4.11175 18.3333 3.24485 17.9394C2.97603 17.8173 2.72632 17.6696 2.5 17.5" stroke="black" stroke-opacity="0.8" stroke-linecap="round"/>
                    <path d="M1.6665 8.33341C1.6665 5.38551 1.6665 3.91156 2.54384 2.9275C2.68416 2.7701 2.83882 2.62454 3.00605 2.49247C4.05162 1.66675 5.61769 1.66675 8.74984 1.66675H11.2498C14.382 1.66675 15.9481 1.66675 16.9936 2.49247C17.1609 2.62454 17.3155 2.7701 17.4558 2.9275C18.3332 3.91156 18.3332 5.38551 18.3332 8.33341C18.3332 11.2813 18.3332 12.7553 17.4558 13.7393C17.3155 13.8967 17.1609 14.0423 16.9936 14.1744C15.9481 15.0001 14.382 15.0001 11.2498 15.0001H8.74984C5.61769 15.0001 4.05162 15.0001 3.00605 14.1744C2.83882 14.0423 2.68416 13.8967 2.54384 13.7393C1.6665 12.7553 1.6665 11.2813 1.6665 8.33341Z" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.4165 8.3335H15.409" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.58301 8.3335H4.57552" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.1258 8.33333C12.1258 9.48393 11.1931 10.4167 10.0425 10.4167C8.89189 10.4167 7.95915 9.48393 7.95915 8.33333C7.95915 7.18274 8.89189 6.25 10.0425 6.25C11.1931 6.25 12.1258 7.18274 12.1258 8.33333Z" stroke="black" stroke-opacity="0.8"/>
                    </svg>
                    </div>Calendar<span></span>
                  </a></li>
                  <li><a href="{{ route('projects.index') }}" class="dropdown-btn">
                    <div class="icon-container">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.83301 7.0835L8.28469 8.53302C9.71402 9.3781 10.2853 9.3781 11.7147 8.53302L14.1663 7.0835" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M1.67964 11.2298C1.73412 13.7844 1.76136 15.0617 2.70397 16.0079C3.64657 16.9541 4.95845 16.987 7.58219 17.0529C9.19926 17.0936 10.8004 17.0936 12.4175 17.0529C15.0412 16.987 16.3531 16.9541 17.2957 16.0079C18.2383 15.0617 18.2656 13.7844 18.32 11.2298C18.3376 10.4084 18.3376 9.59181 18.32 8.77041C18.2656 6.2158 18.2383 4.93849 17.2957 3.9923C16.3531 3.04611 15.0412 3.01315 12.4175 2.94722C10.8004 2.90659 9.19926 2.90659 7.58219 2.94722C4.95844 3.01313 3.64657 3.04609 2.70396 3.99229C1.76136 4.93848 1.73412 6.21579 1.67964 8.7704C1.66212 9.5918 1.66212 10.4084 1.67964 11.2298Z" stroke="black" stroke-linejoin="round"/>
                      </svg>
                      </div>Messages<span></span>
                    </a></li>
                    <li><a href="{{ route('projects.index') }}" class="dropdown-btn">
                      <div class="icon-container" >
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.10843 11.9951C1.93122 13.1226 2.72349 13.9052 3.69354 14.2953C7.4125 15.7906 12.5878 15.7906 16.3068 14.2953C17.2768 13.9052 18.0691 13.1226 17.8919 11.9951C17.783 11.3022 17.2445 10.7252 16.8455 10.1618C16.3229 9.41468 16.271 8.59984 16.2709 7.73292C16.2709 4.38267 13.4634 1.66675 10.0002 1.66675C6.53694 1.66675 3.72943 4.38267 3.72943 7.73292C3.72936 8.59984 3.67743 9.41468 3.15484 10.1618C2.75586 10.7252 2.21734 11.3022 2.10843 11.9951Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 17.5C8.16345 18.0182 9.03956 18.3333 10 18.3333C10.9604 18.3333 11.8366 18.0182 12.5 17.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </div> <span>Notifications Center</span> <span></span>
                      </a></li>
                    <li><a href="{{ route('projects.index') }}" class="dropdown-btn">
                      <div class="icon-container">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9163 9.99992C12.9163 11.6107 11.6105 12.9166 9.99967 12.9166C8.38884 12.9166 7.08301 11.6107 7.08301 9.99992C7.08301 8.38909 8.38884 7.08325 9.99967 7.08325C11.6105 7.08325 12.9163 8.38909 12.9163 9.99992Z" stroke="black"/>
                        <path d="M17.3253 7.62667C17.9972 8.7848 18.3332 9.36386 18.3332 10C18.3332 10.6361 17.9972 11.2152 17.3253 12.3733L15.7222 15.1365C15.053 16.29 14.7184 16.8668 14.1681 17.1834C13.6178 17.5 12.95 17.5 11.6143 17.5L8.3854 17.5C7.04969 17.5 6.38184 17.5 5.83156 17.1834C5.28128 16.8668 4.94666 16.29 4.27743 15.1365L2.67435 12.3733C2.00245 11.2152 1.6665 10.6361 1.6665 10C1.6665 9.36386 2.00245 8.7848 2.67435 7.62667L4.27743 4.86351C4.94667 3.70997 5.28128 3.1332 5.83156 2.8166C6.38184 2.5 7.04969 2.5 8.3854 2.5L11.6143 2.5C12.95 2.5 13.6178 2.5 14.1681 2.8166C14.7184 3.1332 15.053 3.70997 15.7223 4.86351L17.3253 7.62667Z" stroke="black"/>
                        </svg>
                        </div>Settings<span></span>
                      </a></li>
                    <li><a href="{{ route('projects.index') }}" class="dropdown-btn">
                      <div class="icon-container">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.3332 10.0002C18.3332 5.39779 14.6022 1.66683 9.99984 1.66683C5.39746 1.66683 1.6665 5.39779 1.6665 10.0002C1.6665 14.6025 5.39746 18.3335 9.99984 18.3335C14.6022 18.3335 18.3332 14.6025 18.3332 10.0002Z" stroke="black" stroke-opacity="0.8"/>
                        <path d="M10.2015 14.1667V10.0001C10.2015 9.60724 10.2015 9.41083 10.0795 9.28879C9.95742 9.16675 9.761 9.16675 9.36816 9.16675" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.993 6.66675H10.0005" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </div>Help<span></span>
                      </a></li>
                      <li><a href="{{ route('logout.index') }}" class="dropdown-btn">
                        <div class="icon-container">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12.5 14.6875C12.4387 16.2308 11.1526 17.5412 9.4297 17.499C9.02887 17.4892 8.53344 17.3495 7.5426 17.07C5.15801 16.3974 3.08796 15.267 2.5913 12.7346C2.5 12.2691 2.5 11.7453 2.5 10.6977L2.5 9.30229C2.5 8.25468 2.5 7.73087 2.5913 7.26538C3.08796 4.73304 5.15801 3.60263 7.5426 2.93002C8.53345 2.65054 9.02887 2.5108 9.4297 2.50099C11.1526 2.45884 12.4387 3.76923 12.5 5.31251" stroke="black" stroke-opacity="0.8" stroke-linecap="round"/>
                          <path d="M17.5002 10.0001H8.3335M17.5002 10.0001C17.5002 9.41656 15.8382 8.32636 15.4168 7.91675M17.5002 10.0001C17.5002 10.5836 15.8382 11.6738 15.4168 12.0834" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                          </div>Logout<span></span>
                        </a></li>
            </ul>
        </div>
    </div>
@endsection 

@section('header') 
<div class="header">
    <div class="header-left">
    <button id="toggleHeader" class="toggle-btn"></button>
    <span>____</span>
    <button id="toggleSidebar" class="toggle-btn"></button>
    <p>Welcome back, <span class="username"> {{ Auth::user()->name }}</span></p>
    </div>
    <div class="header-right">
     
        <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.5 20C23.5 21.933 21.933 23.5 20 23.5C18.067 23.5 16.5 21.933 16.5 20C16.5 18.067 18.067 16.5 20 16.5C21.933 16.5 23.5 18.067 23.5 20Z" stroke="black"/>
            <path d="M28.7906 17.152C29.5969 18.5418 30 19.2366 30 20C30 20.7634 29.5969 21.4582 28.7906 22.848L26.8669 26.1638C26.0638 27.548 25.6623 28.2402 25.0019 28.6201C24.3416 29 23.5402 29 21.9373 29L18.0627 29C16.4598 29 15.6584 29 14.9981 28.6201C14.3377 28.2402 13.9362 27.548 13.1331 26.1638L11.2094 22.848C10.4031 21.4582 10 20.7634 10 20C10 19.2366 10.4031 18.5418 11.2094 17.152L13.1331 13.8362C13.9362 12.452 14.3377 11.7598 14.9981 11.3799C15.6584 11 16.4598 11 18.0627 11L21.9373 11C23.5402 11 24.3416 11 25.0019 11.3799C25.6623 11.7598 26.0638 12.452 26.8669 13.8362L28.7906 17.152Z" stroke="black"/>
            </svg>
            <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 17.5L16.942 19.2394C18.6572 20.2535 19.3428 20.2535 21.058 19.2394L24 17.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.01577 22.4756C9.08114 25.5412 9.11383 27.0739 10.245 28.2094C11.3761 29.3448 12.9503 29.3843 16.0988 29.4634C18.0393 29.5122 19.9607 29.5122 21.9012 29.4634C25.0497 29.3843 26.6239 29.3448 27.7551 28.2094C28.8862 27.0739 28.9189 25.5412 28.9842 22.4756C29.0053 21.4899 29.0053 20.5101 28.9842 19.5244C28.9189 16.4589 28.8862 14.9261 27.7551 13.7907C26.6239 12.6552 25.0497 12.6157 21.9012 12.5366C19.9607 12.4878 18.0393 12.4878 16.0988 12.5366C12.9503 12.6157 11.3761 12.6552 10.245 13.7906C9.11382 14.9261 9.08114 16.4588 9.01576 19.5244C8.99474 20.5101 8.99475 21.4899 9.01577 22.4756Z" stroke="black" stroke-linejoin="round"/>
                <circle cx="28" cy="11" r="4.5" fill="#534FEB" stroke="white"/>
                </svg>
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5299 23.394C10.3173 24.7471 11.268 25.6862 12.4321 26.1542C16.8948 27.9486 23.1052 27.9486 27.5679 26.1542C28.732 25.6862 29.6827 24.7471 29.4701 23.394C29.3394 22.5625 28.6932 21.8701 28.2144 21.194C27.5873 20.2975 27.525 19.3197 27.5249 18.2794C27.5249 14.2591 24.1559 11 20 11C15.8441 11 12.4751 14.2591 12.4751 18.2794C12.475 19.3197 12.4127 20.2975 11.7856 21.194C11.3068 21.8701 10.6606 22.5625 10.5299 23.394Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.3078 29.606C17.0902 29.436 16.7759 29.4746 16.606 29.6922C16.436 29.9098 16.4746 30.2241 16.6922 30.394L17.3078 29.606ZM23.3078 30.394C23.5254 30.2241 23.564 29.9098 23.394 29.6922C23.2241 29.4746 22.9098 29.436 22.6922 29.606L23.3078 30.394ZM20 30.5C18.9564 30.5 18.014 30.1576 17.3078 29.606L16.6922 30.394C17.5783 31.0862 18.7385 31.5 20 31.5V30.5ZM22.6922 29.606C21.986 30.1576 21.0436 30.5 20 30.5V31.5C21.2615 31.5 22.4217 31.0862 23.3078 30.394L22.6922 29.606Z" fill="black"/>
                    <circle cx="27" cy="11" r="4.5" fill="#534FEB" stroke="white"/>
                    </svg>
                   
           
    </div>
</div>
<div class="top-half">
<div class="topic">
<div class="title-time">
<div class="dashboard-title">Project Management Dashboard</div>
<div class="date">13 January, 2024 &nbsp; 11:23 AM</div>
</div>
<div class="breadcrumb">Dashboard &nbsp; • &nbsp; Project</div>
</div>

<div class="cards">
    <div class="card">
        <div class="top-card">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.25" y="0.25" width="39.5" height="39.5" rx="7.75" stroke="black" stroke-opacity="0.2" stroke-width="0.5"/>
            <path d="M20 22.5L20 23.75" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 19.1665L12.6274 21.5526C12.7643 24.564 12.8327 26.0697 13.799 26.9931C14.7654 27.9165 16.2726 27.9165 19.2872 27.9165H20.7128C23.7274 27.9165 25.2346 27.9165 26.201 26.9931C27.1673 26.0697 27.2357 24.564 27.3726 21.5526L27.5 19.1665" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.3728 18.7025C13.7889 21.3954 16.9828 22.5 20.0002 22.5C23.0175 22.5 26.2114 21.3954 27.6275 18.7025C28.3035 17.4171 27.7916 15 26.1268 15H13.8735C12.2087 15 11.6969 17.4171 12.3728 18.7025Z" stroke="#534FEB"/>
            <path d="M23.3332 14.9999L23.2596 14.7424C22.8929 13.459 22.7096 12.8173 22.2731 12.4503C21.8366 12.0833 21.2568 12.0833 20.0973 12.0833H19.9024C18.7428 12.0833 18.1631 12.0833 17.7266 12.4503C17.2901 12.8173 17.1068 13.459 16.7401 14.7424L16.6665 14.9999" stroke="#534FEB"/>
            </svg>
        <p class="percentage">10% vs last month</p>
        </div>
        <div class="bottom-card">
        <h3>Total Projects</h3>
        <p class="value">150</p>
    </div>
    </div>
    <div class="card">
        <div class="top-card">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.25" y="0.25" width="39.5" height="39.5" rx="7.75" stroke="black" stroke-opacity="0.2" stroke-width="0.5"/>
            <path d="M20 22.5L20 23.75" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 19.1665L12.6274 21.5526C12.7643 24.564 12.8327 26.0697 13.799 26.9931C14.7654 27.9165 16.2726 27.9165 19.2872 27.9165H20.7128C23.7274 27.9165 25.2346 27.9165 26.201 26.9931C27.1673 26.0697 27.2357 24.564 27.3726 21.5526L27.5 19.1665" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.3728 18.7025C13.7889 21.3954 16.9828 22.5 20.0002 22.5C23.0175 22.5 26.2114 21.3954 27.6275 18.7025C28.3035 17.4171 27.7916 15 26.1268 15H13.8735C12.2087 15 11.6969 17.4171 12.3728 18.7025Z" stroke="#534FEB"/>
            <path d="M23.3332 14.9999L23.2596 14.7424C22.8929 13.459 22.7096 12.8173 22.2731 12.4503C21.8366 12.0833 21.2568 12.0833 20.0973 12.0833H19.9024C18.7428 12.0833 18.1631 12.0833 17.7266 12.4503C17.2901 12.8173 17.1068 13.459 16.7401 14.7424L16.6665 14.9999" stroke="#534FEB"/>
            </svg>
        <p class="percentage">10% vs last month</p>
        </div>
        <div class="bottom-card">
        <h3>Total Projects</h3>
        <p class="value">150</p>
    </div>
    </div>
    <div class="card">
        <div class="top-card">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.25" y="0.25" width="39.5" height="39.5" rx="7.75" stroke="black" stroke-opacity="0.2" stroke-width="0.5"/>
            <path d="M20 22.5L20 23.75" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 19.1665L12.6274 21.5526C12.7643 24.564 12.8327 26.0697 13.799 26.9931C14.7654 27.9165 16.2726 27.9165 19.2872 27.9165H20.7128C23.7274 27.9165 25.2346 27.9165 26.201 26.9931C27.1673 26.0697 27.2357 24.564 27.3726 21.5526L27.5 19.1665" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.3728 18.7025C13.7889 21.3954 16.9828 22.5 20.0002 22.5C23.0175 22.5 26.2114 21.3954 27.6275 18.7025C28.3035 17.4171 27.7916 15 26.1268 15H13.8735C12.2087 15 11.6969 17.4171 12.3728 18.7025Z" stroke="#534FEB"/>
            <path d="M23.3332 14.9999L23.2596 14.7424C22.8929 13.459 22.7096 12.8173 22.2731 12.4503C21.8366 12.0833 21.2568 12.0833 20.0973 12.0833H19.9024C18.7428 12.0833 18.1631 12.0833 17.7266 12.4503C17.2901 12.8173 17.1068 13.459 16.7401 14.7424L16.6665 14.9999" stroke="#534FEB"/>
            </svg>
        <p class="percentage">10% vs last month</p>
        </div>
        <div class="bottom-card">
        <h3>Total Projects</h3>
        <p class="value">150</p>
    </div>
    </div>
    <div class="card">
        <div class="top-card">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.25" y="0.25" width="39.5" height="39.5" rx="7.75" stroke="black" stroke-opacity="0.2" stroke-width="0.5"/>
            <path d="M20 22.5L20 23.75" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 19.1665L12.6274 21.5526C12.7643 24.564 12.8327 26.0697 13.799 26.9931C14.7654 27.9165 16.2726 27.9165 19.2872 27.9165H20.7128C23.7274 27.9165 25.2346 27.9165 26.201 26.9931C27.1673 26.0697 27.2357 24.564 27.3726 21.5526L27.5 19.1665" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.3728 18.7025C13.7889 21.3954 16.9828 22.5 20.0002 22.5C23.0175 22.5 26.2114 21.3954 27.6275 18.7025C28.3035 17.4171 27.7916 15 26.1268 15H13.8735C12.2087 15 11.6969 17.4171 12.3728 18.7025Z" stroke="#534FEB"/>
            <path d="M23.3332 14.9999L23.2596 14.7424C22.8929 13.459 22.7096 12.8173 22.2731 12.4503C21.8366 12.0833 21.2568 12.0833 20.0973 12.0833H19.9024C18.7428 12.0833 18.1631 12.0833 17.7266 12.4503C17.2901 12.8173 17.1068 13.459 16.7401 14.7424L16.6665 14.9999" stroke="#534FEB"/>
            </svg>
        <p class="percentage">10% vs last month</p>
        </div>
        <div class="bottom-card">
        <h3>Total Projects</h3>
        <p class="value">150</p>
    </div>
    </div>
    <div class="card">
        <div class="top-card">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.25" y="0.25" width="39.5" height="39.5" rx="7.75" stroke="black" stroke-opacity="0.2" stroke-width="0.5"/>
            <path d="M20 22.5L20 23.75" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.5 19.1665L12.6274 21.5526C12.7643 24.564 12.8327 26.0697 13.799 26.9931C14.7654 27.9165 16.2726 27.9165 19.2872 27.9165H20.7128C23.7274 27.9165 25.2346 27.9165 26.201 26.9931C27.1673 26.0697 27.2357 24.564 27.3726 21.5526L27.5 19.1665" stroke="#534FEB" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.3728 18.7025C13.7889 21.3954 16.9828 22.5 20.0002 22.5C23.0175 22.5 26.2114 21.3954 27.6275 18.7025C28.3035 17.4171 27.7916 15 26.1268 15H13.8735C12.2087 15 11.6969 17.4171 12.3728 18.7025Z" stroke="#534FEB"/>
            <path d="M23.3332 14.9999L23.2596 14.7424C22.8929 13.459 22.7096 12.8173 22.2731 12.4503C21.8366 12.0833 21.2568 12.0833 20.0973 12.0833H19.9024C18.7428 12.0833 18.1631 12.0833 17.7266 12.4503C17.2901 12.8173 17.1068 13.459 16.7401 14.7424L16.6665 14.9999" stroke="#534FEB"/>
            </svg>
        <p class="percentage">10% vs last month</p>
        </div>
        <div class="bottom-card">
        <h3>Total Projects</h3>
        <p class="value">150</p>
    </div>
    </div>
        </div>  
        </div> 
@endsection

@section('listview') 
<div class="listView">
      <div class="filter-bar">
          <div class="left">
              <input type="text" placeholder="Search by name, role, department...">
              <button>Filter By</button>
          </div>
          <div class="right">
              <select>
                  <option>Service Provider</option>
                  <option>Progress</option>
                  <option>Status</option>
                  <option>Start Date</option>
                  <option>End Date</option>
                  <!-- Add more options as needed -->
              </select>
              <button>
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 1.66675V3.33341M5 1.66675V3.33341" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M8.33333 14.1668L8.33332 11.1228C8.33332 10.963 8.21938 10.8335 8.07882 10.8335H7.5M11.358 14.1668L12.4868 11.1245C12.5396 10.9822 12.4274 10.8335 12.2672 10.8335H10.8333" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round"/>
                  <path d="M2.08334 10.2027C2.08334 6.57161 2.08334 4.75607 3.12677 3.62803C4.1702 2.5 5.84958 2.5 9.20834 2.5H10.7917C14.1504 2.5 15.8298 2.5 16.8732 3.62803C17.9167 4.75607 17.9167 6.57161 17.9167 10.2027V10.6306C17.9167 14.2617 17.9167 16.0773 16.8732 17.2053C15.8298 18.3333 14.1504 18.3333 10.7917 18.3333H9.20834C5.84958 18.3333 4.1702 18.3333 3.12677 17.2053C2.08334 16.0773 2.08334 14.2617 2.08334 10.6306V10.2027Z" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M5 6.66675H15" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  13 Jan, 2024
              </button>
              <button>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.5646 7.50922C14.5709 7.50919 14.5771 7.50917 14.5833 7.50917C16.6544 7.50917 18.3333 9.19118 18.3333 11.2661C18.3333 13.1998 16.875 14.7924 15 15M14.5646 7.50922C14.577 7.37172 14.5833 7.23247 14.5833 7.09174C14.5833 4.55579 12.5313 2.5 9.99999 2.5C7.60269 2.5 5.63526 4.34389 5.43368 6.69326M14.5646 7.50922C14.4794 8.45632 14.1072 9.3205 13.5357 10.0138M5.43368 6.69326C3.31997 6.89477 1.66666 8.67827 1.66666 10.8486C1.66666 12.8681 3.09812 14.5527 4.99999 14.9394M5.43368 6.69326C5.5652 6.68072 5.69852 6.67431 5.83332 6.67431C6.77151 6.67431 7.63728 6.98495 8.33373 7.50917" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.99999 10.8333L9.99999 17.4999M9.99999 10.8333C9.41647 10.8333 8.32626 12.4952 7.91666 12.9166M9.99999 10.8333C10.5835 10.8333 11.6737 12.4952 12.0833 12.9166" stroke="black" stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                  Export CSV
              </button>
          </div>
      </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Service Provider</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Project Manager</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Project A</td>
                    <td>Provider 1</td>
                    <td><progress value="70" max="100"></progress></td>
                    <td><span class="status completed">Completed</span></td>
                    <td>2024-01-01</td>
                    <td>2024-03-01</td>
                    <td>John Doe</td>
                </tr>
                <tr>
                    <td>Project B</td>
                    <td>Provider 2</td>
                    <td><progress value="50" max="100"></progress></td>
                    <td><span class="status ongoing">Ongoing</span></td>
                    <td>2024-02-15</td>
                    <td>2024-04-15</td>
                    <td>Jane Smith</td>
                </tr>
                <tr>
                    <td>Project C</td>
                    <td>Provider 3</td>
                    <td><progress value="30" max="100"></progress></td>
                    <td><span class="status completed">Completed</span></td>
                    <td>2024-03-10</td>
                    <td>2024-05-10</td>
                    <td>Michael Johnson</td>
                </tr>
                <tr>
                    <td>Project C</td>
                    <td>Provider 3</td>
                    <td><progress value="30" max="100"></progress></td>
                    <td><span class="status ongoing">Ongoing</span></td>
                    <td>2024-03-10</td>
                    <td>2024-05-10</td>
                    <td>Michael Johnson</td>
                </tr>
                <tr>
                    <td>Project C</td>
                    <td>Provider 3</td>
                    <td><progress value="30" max="100"></progress></td>
                    <td><span class="status ongoing">Ongoing</span></td>
                    <td>2024-03-10</td>
                    <td>2024-05-10</td>
                    <td>Michael Johnson</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
      <div class="page-label">
        <p>Showing <b>1 to 6 of 120</b> Service Providers</p>
      </div>
      <div class="buttons">
        <button disabled>Previous</button>
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>Next</button>
      </div>

    </div>
  </div>
@endsection


@section('scripts') 
<script>
document.addEventListener("DOMContentLoaded", function() {
  var dropdowns = document.querySelectorAll(".dropdown-btn");

  dropdowns.forEach(function(dropdown) {
    var dropdownContainer = dropdown.nextElementSibling; // Assuming .dropdown-container is next sibling

    dropdown.addEventListener("click", function() {
      dropdownContainer.classList.toggle("show");

      var arrow = this.querySelector(".arrow");
      if (dropdownContainer.classList.contains("show")) {
        this.style.backgroundColor = "blue";
        this.style.color = "white";

        arrow.innerHTML = `
        <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.99988 4.99997C8.99988 4.99997 6.05392 1.00001 4.99985 1C3.94577 0.999991 0.999878 5 0.999878 5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
      } else {
        this.style.backgroundColor = ""; // Reset background color
        this.style.color = ""; // Reset text color

        arrow.innerHTML = `
        <svg width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11 0.500038C11 0.500038 7.31756 5.49999 5.99996 5.5C4.68237 5.50001 1 0.499999 1 0.499999" stroke="black" stroke-opacity="0.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector('.sidebar');
            let sidebarWidth = getComputedStyle(sidebar).width;
            // Convert to a number and add 5 pixels
            let sidebarWidthValue = parseFloat(sidebarWidth) + 30;
            document.documentElement.style.setProperty('--sidebar-width', sidebarWidthValue + 'px');
        });

    document.addEventListener("DOMContentLoaded", function() {
    var toggleHeaderButton = document.getElementById("toggleHeader");
    var toggleSidebarButton = document.getElementById("toggleSidebar");
    var header = document.querySelector(".top-half");
    var sidebar = document.querySelector(".sidebar");
    var content = document.querySelector(".half-screen");
    var fullScreen = document.querySelector(".full-screen");

    toggleHeaderButton.addEventListener("click", function() {
        header.classList.toggle("collapsed-header");
        fullScreen.classList.toggle("expanded-fullscreen");
    });

    toggleSidebarButton.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed-sidebar");
        if (sidebar.classList.contains("collapsed-sidebar")) {
            content.style.marginLeft = "0"; 
        } else {
            content.style.marginLeft = "0"; 
        }
    });
});


</script>
@endsection