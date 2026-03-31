@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap');

    :root {
        --sky: #0ea5e9;
        --sky-light: #e0f2fe;
        --sky-mid: #38bdf8;
        --sky-dark: #0369a1;
        --sky-deep: #075985;
        --white: #ffffff;
        --gray-soft: #f0f9ff;
        --text-dark: #0c2340;
        --text-mid: #374151;
        --accent: #0369a1;
        --accent-light: #fef3c7;
        --radius: 20px;
        --shadow: 0 4px 28px rgba(14,165,233,0.12);
        --shadow-hover: 0 10px 40px rgba(14,165,233,0.22);
    }

    body {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 60%, #7dd3fc 100%) !important;
        min-height: 100vh;
        font-family: 'Nunito', sans-serif;
    }

    /* HERO */
    .contact-hero {
        background: linear-gradient(120deg, var(--sky-dark) 0%, var(--sky-deep) 100%);
        border-radius: 0 0 50px 50px;
        padding: 60px 0 70px;
        margin-bottom: -44px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
    }
    .contact-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.6rem;
        color: #fff;
        position: relative;
        z-index: 1;
    }
    .contact-hero p {
        color: rgba(255,255,255,0.75);
        font-size: 1.05rem;
        margin-top: 8px;
        position: relative;
        z-index: 1;
    }

    /* WRAPPER */
    .contact-wrapper {
        max-width: 980px;
        margin: 0 auto;
        padding: 60px 20px 70px;
    }

    /* INFO CARD */
    .info-card {
        background: linear-gradient(160deg, var(--sky-deep) 0%, var(--sky-dark) 100%);
        border-radius: var(--radius);
        padding: 36px 30px;
        box-shadow: var(--shadow-hover);
        height: 100%;
        position: relative;
        overflow: hidden;
        color: #fff;
    }
    .info-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .info-card::after {
        content: '';
        position: absolute;
        bottom: -40px; left: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .info-card h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: #fff;
        margin-bottom: 28px;
        position: relative;
        z-index: 1;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
        position: relative;
        z-index: 1;
    }
    .contact-item-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        border: 1px solid rgba(255,255,255,0.22);
        color: var(--accent);
    }
    .contact-item-text p:first-child {
        font-weight: 700;
        font-size: 0.88rem;
        color: rgba(255,255,255,0.65);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .contact-item-text p:last-child {
        font-weight: 600;
        font-size: 0.97rem;
        color: #fff;
    }

    .info-note {
        background: rgba(245,158,11,0.15);
        border: 1px solid rgba(245,158,11,0.32);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 0.88rem;
        color: var(--accent-light);
        margin-top: 10px;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-note i { color: var(--accent); }

    /* FORM CARD */
    .form-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 36px 30px;
        box-shadow: var(--shadow);
        border: 1.5px solid var(--sky-mid);
    }
    .form-card h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 24px;
    }

    .form-group { margin-bottom: 18px; }
    .form-group label {
        display: block;
        font-size: 0.87rem;
        font-weight: 700;
        color: var(--text-mid);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .form-group label i { margin-right: 4px; color: var(--sky-dark); }

    .form-input {
        width: 100%;
        border: 1.5px solid var(--sky-mid);
        background: var(--sky-light);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.97rem;
        color: var(--text-dark);
        font-family: 'Nunito', sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        outline: none;
    }
    .form-input:focus {
        border-color: var(--sky);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(14,165,233,0.15);
    }
    .form-input::placeholder { color: #7dd3fc; }

    textarea.form-input { resize: vertical; min-height: 120px; }

    .submit-btn {
        width: 100%;
        background: linear-gradient(90deg, var(--sky-dark) 0%, var(--sky-deep) 100%);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 1.02rem;
        font-weight: 800;
        padding: 14px 0;
        cursor: pointer;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 18px rgba(14,165,233,0.28);
        transition: transform 0.15s, box-shadow 0.18s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 6px;
        font-family: 'Nunito', sans-serif;
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(14,165,233,0.38);
        background: linear-gradient(90deg, var(--sky-deep) 0%, var(--sky-dark) 100%);
    }
    .submit-btn:active { transform: translateY(0); }
    .submit-btn i { color: var(--accent); }
</style>

<!-- HERO -->
<div class="contact-hero">
    <h1><i class="fa-solid fa-headset mr-3"></i>Contact Us</h1>
    <p>We'd love to hear from you. Get in touch with us anytime.</p>
</div>

<div class="contact-wrapper">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- INFO CARD -->
        <div class="info-card">

            <h2><i class="fa-solid fa-circle-info mr-2"></i>Get in Touch</h2>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="contact-item-text">
                    <p>Email</p>
                    <p>support@yourcompany.co.uk</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="contact-item-text">
                    <p>Phone</p>
                    <p>+44 20 7946 0958</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="contact-item-text">
                    <p>Address</p>
                    <p>221B Baker Street, London, UK</p>
                </div>
            </div>

            <div class="info-note">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Our team usually responds within 24 hours.
            </div>

        </div>

        <!-- FORM CARD -->
        <div class="form-card">

            <h2><i class="fa-solid fa-paper-plane mr-2" style="color:var(--sky-dark);"></i>Send a Message</h2>

            <form method="POST" action="#">
                @csrf

                <div class="form-group">
                    <label><i class="fa-solid fa-user"></i> Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Your full name">
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-input" placeholder="you@example.com">
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-comment-dots"></i> Message</label>
                    <textarea name="message" class="form-input" placeholder="Write your message here..."></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Message
                </button>

            </form>

        </div>

    </div>

</div>

@endsection