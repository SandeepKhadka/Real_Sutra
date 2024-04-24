@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
<style>
    /* Contact section CSS styles */
    .contact_section {
        padding: 50px 0;
        background-color: #f9f9f9;
    }

    .heading_container h2 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
    }

    .container-bg {
        background-color: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .container-bg input,
    .container-bg textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .container-bg button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .container-bg button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('main-content')
<section class="contact_section">
    <div class="container px-0">
        <div class="heading_container">
            <h2>Contact Us</h2>
        </div>
    </div>
    <div class="container container-bg">
        <div class="row">
            <div class="col-lg-2 col-md-6 px-0">
            </div>
            
            <div class="col-md-6 col-lg-8 px-0">
                <form id="contactForm" action="#">
                    <div>
                        <input type="text" placeholder="Name">
                    </div>
                    <div>
                        <input type="email" placeholder="Email">
                    </div>
                    <div>
                        <input type="text" placeholder="Phone">
                    </div>
                    <div>
                        <textarea class="message-box" placeholder="Message"></textarea>
                    </div>
                    <div class="d-flex">
                        <button type="submit">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Handle form submission here, e.g., send form data to server
        
        alert('Form Submitted Successfully');
        location.reload(); // Reload the page after form submission
    });
</script>
@endsection
