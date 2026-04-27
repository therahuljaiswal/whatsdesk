<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'WhatsDesk') }} - Official WhatsApp API Solution</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #1e293b;
            --accent: #10b981;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        nav {
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 40px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
        }

        /* Hero Section */
        .hero {
            padding: 80px 0;
            display: flex;
            align-items: center;
            gap: 40px;
            min-height: 80vh;
        }

        .hero-content {
            flex: 1;
        }

        .hero-image {
            flex: 1;
            text-align: right;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 30px;
        }

        h1 {
            font-size: 64px;
            line-height: 1.1;
            margin-bottom: 24px;
            color: var(--secondary);
        }

        h1 span {
            color: var(--primary);
        }

        .hero p {
            font-size: 20px;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 600px;
        }

        /* Features */
        .features {
            padding: 100px 0;
            text-align: center;
        }

        .section-tag {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 48px;
            margin-bottom: 60px;
            color: var(--secondary);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            text-align: left;
            transition: all 0.3s;
            border: 1px solid #e2e8f0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: var(--primary);
            font-size: 24px;
        }

        .feature-card h3 {
            font-size: 24px;
            margin-bottom: 16px;
        }

        .feature-card p {
            color: var(--text-muted);
        }

        /* Pricing */
        .pricing {
            padding: 100px 0;
            background: #fff;
        }

        .pricing-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .pricing-card {
            background: var(--bg-light);
            padding: 40px;
            border-radius: 30px;
            width: 350px;
            text-align: center;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .pricing-card.popular {
            border-color: var(--primary);
            transform: scale(1.05);
            background: var(--white);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1);
        }

        .pricing-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price {
            font-size: 48px;
            font-weight: 700;
            margin: 20px 0;
        }

        .price span {
            font-size: 16px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .pricing-features {
            list-style: none;
            margin: 30px 0;
            text-align: left;
        }

        .pricing-features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-muted);
        }

        .pricing-features li::before {
            content: "✓";
            color: var(--accent);
            font-weight: 700;
        }

        /* Footer */
        footer {
            padding: 60px 0;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: var(--text-muted);
        }

        @media (max-width: 968px) {
            .hero { flex-direction: column; text-align: center; padding-top: 40px; }
            .hero-content { order: 2; }
            .hero-image { order: 1; }
            h1 { font-size: 48px; }
            .features-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <div class="container">
        <nav>
            <a href="/" class="logo">
                <img src="{{ config('settings.logo') }}" alt="Logo">
                <span>{{ config('app.name', 'WhatsDesk') }}</span>
            </a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#pricing">Pricing</a>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Start Free Trial</a>
            </div>
        </nav>

        <section class="hero">
            <div class="hero-content">
                <div class="section-tag">Direct WhatsApp Cloud API</div>
                <h1>Empower your Business with <span>WhatsApp</span></h1>
                <p>The most advanced multi-agent chat, bulk campaigns, and AI automation platform for your business WhatsApp account.</p>
                <div style="display: flex; gap: 15px;">
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started for Free</a>
                    <a href="#features" class="btn btn-outline">Learn More</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('landing/hero.png') }}" alt="WhatsDesk Hero">
            </div>
        </section>

        <section class="features" id="features">
            <div class="section-tag">Powerful Features</div>
            <h2>Why Choose WhatsDesk?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon-box">💬</div>
                    <h3>Multi-Agent Chat</h3>
                    <p>Assign conversations to different team members and provide instant support to your customers.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box">🚀</div>
                    <h3>Bulk Campaigns</h3>
                    <p>Send thousands of template messages to your contact list with high open rates and tracking.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box">🤖</div>
                    <h3>AI Chatbots</h3>
                    <p>Automate your business 24/7 with ChatGPT-powered agents that handle customer queries naturally.</p>
                </div>
            </div>
        </section>

        <section class="pricing" id="pricing">
            <div class="container">
                <div style="text-align: center; margin-bottom: 60px;">
                    <div class="section-tag">Flexible Pricing</div>
                    <h2>Choose Your Plan</h2>
                </div>
                <div class="pricing-grid">
                    @foreach($plans as $plan)
                    <div class="pricing-card {{ $loop->iteration == 2 ? 'popular' : '' }}">
                        <h3>{{ $plan->name }}</h3>
                        <div class="price">
                            @if(config('settings.cashier_currency') == 'INR') ₹ @else $ @endif{{ $plan->price }}
                            <span>/{{ $plan->period == 1 ? 'mo' : 'yr' }}</span>
                        </div>
                        <ul class="pricing-features">
                            <li>{{ $plan->limit_items > 0 ? $plan->limit_items : 'Unlimited' }} Campaigns</li>
                            <li>{{ $plan->limit_views > 0 ? $plan->limit_views : 'Unlimited' }} Messages</li>
                            <li>{{ $plan->limit_orders > 0 ? $plan->limit_orders : 'Unlimited' }} Contacts</li>
                            <li>Multi-Agent Support</li>
                            <li>AI Bot Integration</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn {{ $loop->iteration == 2 ? 'btn-primary' : 'btn-outline' }}" style="width: 100%">Choose {{ $plan->name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <footer>
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'WhatsDesk') }}. All rights reserved.</p>
            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px;">
                <a href="{{ route('login') }}" style="color: inherit; text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" style="color: inherit; text-decoration: none;">Register</a>
            </div>
        </footer>
    </div>

</body>
</html>
