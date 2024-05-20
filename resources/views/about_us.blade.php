@extends('cmaster')

@section('title')
Makeup Hub | About Us
@endsection

@section('content')
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes bounceIn {
        from, 20%, 40%, 60%, 80%, to {
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        from { opacity: 0; transform: scale3d(.3, .3, .3); }
        20% { transform: scale3d(1.1, 1.1, 1.1); }
        40% { transform: scale3d(.9, .9, .9); }
        60% { opacity: 1; transform: scale3d(1.03, 1.03, 1.03); }
        80% { transform: scale3d(.97, .97, .97); }
        to { opacity: 1; transform: scale3d(1, 1, 1); }
    }
    @keyframes fadeInUp {
        from {
            transform: translate3d(0, 100%, 0);
            opacity: 0;
        }
        to {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
    }
    .animate__fadeIn {
        animation-name: fadeIn;
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    .animate__bounceIn {
        animation-name: bounceIn;
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    .animate__fadeInUp {
        animation-name: fadeInUp;
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    .about-us-section {
        background-color: #f9f9f9;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .heading-latest {
        font-size: 2.5rem;
        font-weight: bold;
        color: #ff69b4;
        margin-top: 20px;
        margin-bottom: 40px;
    }
</style>
<div class="p-20 text-center animate__fadeIn heading-latest">
    Makeup Hub 
</div>

<div class="p-20 text-center animate__fadeIn about-us-section">
    <h2 class="text-success animate__bounceIn">About Us</h2>
    <h4 class="animate__fadeInUp">Welcome to Makeup Hub, where beauty meets convenience.</h4>
    <p class="animate__fadeInUp">
        At Makeup Hub, we believe in providing a comprehensive and personalized shopping experience tailored to your unique beauty needs. 
        We understand the value of your time, which is why we strive to make every minute count by delivering top-quality makeup products right to your doorstep.
    </p>
    <p class="animate__fadeInUp">
        Our team of expert makeup artists and beauty enthusiasts is dedicated to helping you look and feel your best. Whether you're getting ready for a special occasion or simply enhancing your everyday look, we're here to support you every step of the way.
    </p>
    <p class="animate__fadeInUp">
        Join our community and discover the latest trends, tips, and tutorials, all designed to empower you to express your unique style.
    </p>
</div>


@endsection
