<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="{{ config('app.name', 'WhatsDesk') }} - WhatsApp Marketing Platform. Send bulk WhatsApp messages, automate campaigns, and grow your business." />
  <meta name="keywords" content="WhatsApp marketing, bulk messaging, WhatsApp API, campaign automation, India" />
  <meta property="og:title" content="{{ config('app.name', 'WhatsDesk') }} - WhatsApp Bulk Messaging & Marketing Platform" />
  <meta property="og:description" content="Send bulk WhatsApp messages to thousands instantly." />
  <meta property="og:type" content="website" />
  <title>{{ config('app.name', 'WhatsDesk') }} - Start WhatsApp Marketing Today</title>
  
  <!-- Favicon -->
  <link rel="icon" href="{{ config('global.site_favicon', config('settings.favicon', '/favicon-32x32.png')) }}">
  <link rel="apple-touch-icon" href="{{ config('global.site_favicon', config('settings.favicon', '/apple-touch-icon.png')) }}">

  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('new_design_assets/css/style.css') }}" />
  
  <style>
    .pricing-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .pricing-card .mt-4 {
        margin-top: auto !important;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom fixed-top" id="mainNavbar">
    <div class="container">
      <a class="navbar-brand" href="{{ route('landing') }}">
        @if(config('settings.logo'))
            <img src="{{ config('settings.logo') }}" alt="{{ config('app.name', 'WhatsDesk') }}" style="max-height: 40px;" class="me-2">
        @else
            <i class="fab fa-whatsapp me-2" style="color:#25D366;font-size:1.6rem;"></i>
        @endif
        {{ config('app.name', 'WhatsDesk') }}
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link px-3 active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="#pricing">Pricing</a></li>
          @if(Route::has('login'))
              @auth
                  <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Dashboard</a></li>
              @else
                  <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Login</a></li>
                  <li class="nav-item ms-lg-2">
                    <a href="{{ route('register') }}" class="btn btn-wa"><i class="fas fa-rocket me-2"></i>Get Started</a>
                  </li>
              @endauth
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero-section" id="home">
    <div class="container position-relative" style="z-index:1;">
      <div class="row align-items-center gy-5">
        <div class="col-lg-6">
          <div class="hero-badge"><i class="fas fa-star me-2" style="color:#FFC107;"></i>#1 WhatsApp Marketing Platform</div>
          <h1 class="hero-title mb-3">Start <span>WhatsApp Marketing</span> Today &amp; 10x Your Sales</h1>
          <p class="hero-subtitle mb-4">Send bulk WhatsApp messages, automate campaigns, and track performance — all from one powerful dashboard. Trusted by 1000+ businesses.</p>
          <div class="d-flex flex-wrap gap-3 mb-4">
            <a href="{{ auth()->check() ? route('plans.current') : route('register') }}" class="btn btn-wa btn-lg"><i class="fas fa-rocket me-2"></i>Start Free Trial</a>
            <a href="#features" class="btn btn-outline-wa btn-lg"><i class="fas fa-play-circle me-2"></i>See How It Works</a>
          </div>
          <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="trust-badge"><i class="fas fa-check-circle"></i> No Credit Card Required</span>
            <span class="trust-badge"><i class="fas fa-lock"></i> 256-bit SSL Secured</span>
            <span class="trust-badge"><i class="fas fa-shield-alt"></i> GDPR Compliant</span>
          </div>
          <div class="hero-stats">
            <div class="hero-stat"><h3>1K+</h3><p>Active Businesses</p></div>
            <div class="hero-stat"><h3>70k+</h3><p>Messages Sent</p></div>
            <div class="hero-stat"><h3>99.9%</h3><p>Delivery Rate</p></div>
            <div class="hero-stat"><h3>4.9★</h3><p>Customer Rating</p></div>
          </div>
        </div>
        <div class="col-lg-6 text-center">
          <div class="hero-phone-mockup mx-auto" style="position:relative;z-index:1;">
            <div class="phone-header">
              <div class="phone-avatar"><i class="fab fa-whatsapp"></i></div>
              <div><div style="font-weight:600;font-size:.9rem;">{{ config('app.name', 'WhatsDesk') }} Campaign</div><div style="font-size:.7rem;opacity:.8;">3,420 recipients • Online</div></div>
              <div class="ms-auto"><i class="fas fa-ellipsis-v"></i></div>
            </div>
            <div class="phone-body">
              <div class="chat-bubble">🎉 Exclusive Offer!<br>Hi <strong>Rahul</strong>, get <strong>40% OFF</strong> on all products. Use code: PROMO40<br>👉 Shop Now: link.{{ strtolower(config('app.name', 'WhatsDesk')) }}.com/offer<div class="time">10:32 AM ✓✓</div></div>
              <div class="chat-bubble sent">Wow! Amazing deal 🛍️<div class="time">10:33 AM ✓✓</div></div>
              <div class="chat-bubble">📊 Campaign Stats<br>Sent: 3,420 | Delivered: 3,418<br>Opened: 2,890 | Clicked: 1,234<div class="time">10:35 AM</div></div>
            </div>
          </div>
          <div class="meta-badges mt-3">
            <span class="meta-badge"><i class="fas fa-certificate me-1" style="color:#FFC107;"></i>Meta Partner</span>
            <span class="meta-badge"><i class="fas fa-award me-1" style="color:#FFC107;"></i>Secure Platform</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TRUSTED BRANDS -->
  <section class="brands-section py-4">
    <div class="container">
      <p class="text-center text-muted mb-4" style="font-weight:600;font-size:.85rem;letter-spacing:1px;text-transform:uppercase;">Trusted by 10,000+ businesses</p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <div class="brand-logo">Amazon</div><div class="brand-logo">Flipkart</div>
        <div class="brand-logo">Razorpay</div><div class="brand-logo">Zomato</div>
        <div class="brand-logo">Ola</div><div class="brand-logo">Paytm</div>
        <div class="brand-logo">HDFC</div><div class="brand-logo">BYJU'S</div>
        <div class="brand-logo">Swiggy</div><div class="brand-logo">PhonePe</div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="py-5" id="features">
    <div class="container">
      <div class="text-center mb-5">
        <div class="section-badge"><i class="fas fa-magic me-2"></i>Powerful Features</div>
        <h2 class="section-title">Everything You Need to Scale with WhatsApp</h2>
        <p class="section-subtitle mt-3">From bulk messaging to intelligent automation, {{ config('app.name', 'WhatsDesk') }} gives you all the tools to grow your business exponentially.</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-green"><i class="fas fa-paper-plane"></i></div>
            <h5 class="fw-bold mb-2">Bulk Messaging</h5>
            <p class="text-muted mb-0">Send millions of personalized WhatsApp messages in minutes with our high-speed infrastructure. 99.9% delivery rate guaranteed.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-blue"><i class="fas fa-calendar-alt"></i></div>
            <h5 class="fw-bold mb-2">Campaign Scheduling</h5>
            <p class="text-muted mb-0">Schedule messages days or weeks in advance. Automate your outreach with smart timing for maximum engagement.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-purple"><i class="fas fa-chart-line"></i></div>
            <h5 class="fw-bold mb-2">Real-Time Analytics</h5>
            <p class="text-muted mb-0">Track open rates, click rates, and conversions in real time. Make data-driven decisions to boost your ROI.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-orange"><i class="fas fa-code"></i></div>
            <h5 class="fw-bold mb-2">WhatsApp API</h5>
            <p class="text-muted mb-0">Seamlessly integrate WhatsApp with your CRM, ERP, or any existing system using our robust REST API.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-red"><i class="fas fa-robot"></i></div>
            <h5 class="fw-bold mb-2">AI Automation</h5>
            <p class="text-muted mb-0">Build intelligent chatbots and autoresponders that handle customer queries 24/7 without any human intervention.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="feature-card">
            <div class="feature-icon icon-teal"><i class="fas fa-shield-alt"></i></div>
            <h5 class="fw-bold mb-2">Secure &amp; Compliant</h5>
            <p class="text-muted mb-0">End-to-end encryption, GDPR compliant, WhatsApp Business Policy aligned. Your data is always protected.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="stats-section py-5">
    <div class="container">
      <div class="row g-4 text-center">
        <div class="col-lg-3 col-6">
          <div class="p-3"><i class="fas fa-building fa-2x gradient-text mb-3"></i><div class="stat-number">1000+</div><p class="text-muted fw-bold mb-0">Businesses Served</p></div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="p-3"><i class="fas fa-paper-plane fa-2x gradient-text mb-3"></i><div class="stat-number">70k+</div><p class="text-muted fw-bold mb-0">Messages Delivered</p></div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="p-3"><i class="fas fa-server fa-2x gradient-text mb-3"></i><div class="stat-number">99.9%</div><p class="text-muted fw-bold mb-0">Uptime SLA</p></div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="p-3"><i class="fas fa-chart-line fa-2x gradient-text mb-3"></i><div class="stat-number">340%</div><p class="text-muted fw-bold mb-0">Average ROI Increase</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section class="py-5" id="pricing">
    <div class="container">
      <div class="text-center mb-5">
        <div class="section-badge"><i class="fas fa-tag me-2"></i>Simple Pricing</div>
        <h2 class="section-title">Choose the Right Plan for Your Business</h2>
        <p class="section-subtitle mt-3">No hidden charges. Cancel anytime. 7-day free trial on all plans.</p>
        <div class="pricing-toggle-wrap mt-4">
          <div class="toggle-group">
            <button class="btn active" id="monthlyBtnToggle" onclick="togglePricing('monthly')">Monthly</button>
            <button class="btn" id="yearlyBtnToggle" onclick="togglePricing('yearly')">Yearly</button>
          </div>
          <span class="save-badge" id="yearSaveBadgeToggle" style="display:none;">Save 20%</span>
        </div>
      </div>
      
      @php
          $monthlyPlans = $plans->where('period', 1)->values();
          $yearlyPlans = $plans->where('period', 2)->values();
      @endphp

      <!-- Monthly Plans -->
      <div class="row g-4 justify-content-center" id="monthlyPlansContainer">
        @foreach($monthlyPlans as $index => $plan)
        <div class="col-lg-4 col-md-6">
          <div class="pricing-card {{ $index == 1 ? 'popular' : '' }}">
            @if($index == 1)
            <div class="popular-badge"><i class="fas fa-star me-1"></i>Most Popular</div>
            @endif
            <div class="text-center mb-4">
              <div class="feature-icon {{ $index == 0 ? 'icon-green' : ($index == 1 ? 'icon-blue' : 'icon-purple') }} mx-auto mb-3">
                  <i class="fas {{ $index == 0 ? 'fa-seedling' : ($index == 1 ? 'fa-rocket' : 'fa-building') }}"></i>
              </div>
              <h4 class="fw-bold">{{ $plan->name }}</h4>
              <!-- <p class="text-muted small">{{ $plan->description }}</p> -->
              <div class="price-amount">@if(config('settings.cashier_currency') == 'INR') ₹ @else $ @endif<span>{{ $plan->price }}</span><span class="per">/mo</span></div>
            </div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_items > 0 ? $plan->limit_items : 'Unlimited' }} Campaigns</span></div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_views > 0 ? $plan->limit_views : 'Unlimited' }} Messages</span></div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_orders > 0 ? $plan->limit_orders : 'Unlimited' }} Contacts</span></div>
            
            @if($plan->features)
                @foreach(explode(',', $plan->features) as $feature)
                    @if(trim($feature) !== '')
                    <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ trim($feature) }}</span></div>
                    @endif
                @endforeach
            @endif

            @php
                $pluginsJSON = $plan->getConfig('plugins', null);
                $plugins = $pluginsJSON ? json_decode($pluginsJSON, true) : [];
                $pluginNames = [
                    'wpbox' => 'Whatsapp Campaigns',
                    'embeddedlogin' => 'Embedded Login',
                    'agents' => 'Multi-Agents',
                    'embedwhatsapp' => 'Embed WhatsApp'
                ];
            @endphp
            @if(is_array($plugins))
                @foreach($plugins as $plugin)
                    <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $pluginNames[strtolower($plugin)] ?? ucfirst($plugin) }}</span></div>
                @endforeach
            @endif

            <div class="mt-4">
              <a href="{{ auth()->check() ? route('plans.current') : route('register') }}" class="btn {{ $index == 1 ? 'btn-wa' : 'btn-outline-success' }} w-100 rounded-pill fw-bold">
                <i class="fas fa-credit-card me-2"></i>Choose Plan
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Yearly Plans -->
      <div class="row g-4 justify-content-center" id="yearlyPlansContainer" style="display: none;">
        @foreach($yearlyPlans as $index => $plan)
        <div class="col-lg-4 col-md-6">
          <div class="pricing-card {{ $index == 1 ? 'popular' : '' }}">
            @if($index == 1)
            <div class="popular-badge"><i class="fas fa-star me-1"></i>Most Popular</div>
            @endif
            <div class="text-center mb-4">
              <div class="feature-icon {{ $index == 0 ? 'icon-green' : ($index == 1 ? 'icon-blue' : 'icon-purple') }} mx-auto mb-3">
                  <i class="fas {{ $index == 0 ? 'fa-seedling' : ($index == 1 ? 'fa-rocket' : 'fa-building') }}"></i>
              </div>
              <h4 class="fw-bold">{{ $plan->name }}</h4>
              <!-- <p class="text-muted small">{{ $plan->description }}</p> -->
              <div class="price-amount">@if(config('settings.cashier_currency') == 'INR') ₹ @else $ @endif<span>{{ $plan->price }}</span><span class="per">/yr</span></div>
            </div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_items > 0 ? $plan->limit_items : 'Unlimited' }} Campaigns</span></div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_views > 0 ? $plan->limit_views : 'Unlimited' }} Messages</span></div>
            <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $plan->limit_orders > 0 ? $plan->limit_orders : 'Unlimited' }} Contacts</span></div>
            
            @if($plan->features)
                @foreach(explode(',', $plan->features) as $feature)
                    @if(trim($feature) !== '')
                    <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ trim($feature) }}</span></div>
                    @endif
                @endforeach
            @endif

            @php
                $pluginsJSON = $plan->getConfig('plugins', null);
                $plugins = $pluginsJSON ? json_decode($pluginsJSON, true) : [];
                $pluginNames = [
                    'wpbox' => 'Whatsapp Campaigns',
                    'embeddedlogin' => 'Embedded Login',
                    'agents' => 'Multi-Agents',
                    'embedwhatsapp' => 'Embed WhatsApp'
                ];
            @endphp
            @if(is_array($plugins))
                @foreach($plugins as $plugin)
                    <div class="pricing-feature"><i class="fas fa-check-circle"></i><span>{{ $pluginNames[strtolower($plugin)] ?? ucfirst($plugin) }}</span></div>
                @endforeach
            @endif

            <div class="mt-4">
              <a href="{{ auth()->check() ? route('plans.current') : route('register') }}" class="btn {{ $index == 1 ? 'btn-wa' : 'btn-outline-success' }} w-100 rounded-pill fw-bold">
                <i class="fas fa-credit-card me-2"></i>Choose Plan
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  <script>
    function togglePricing(period) {
        if(period === 'monthly') {
            document.getElementById('monthlyBtnToggle').classList.add('active');
            document.getElementById('yearlyBtnToggle').classList.remove('active');
            document.getElementById('monthlyPlansContainer').style.display = 'flex';
            document.getElementById('yearlyPlansContainer').style.display = 'none';
            document.getElementById('yearSaveBadgeToggle').style.display = 'none';
        } else {
            document.getElementById('yearlyBtnToggle').classList.add('active');
            document.getElementById('monthlyBtnToggle').classList.remove('active');
            document.getElementById('yearlyPlansContainer').style.display = 'flex';
            document.getElementById('monthlyPlansContainer').style.display = 'none';
            document.getElementById('yearSaveBadgeToggle').style.display = 'inline-block';
        }
    }
  </script>

  <!-- TESTIMONIALS -->
  <section class="py-5" style="background:#f8f9fa;">
    <div class="container">
      <div class="text-center mb-5">
        <div class="section-badge"><i class="fas fa-heart me-2"></i>Customer Stories</div>
        <h2 class="section-title">10,000+ Businesses Trust {{ config('app.name', 'WhatsDesk') }}</h2>
        <p class="section-subtitle mt-3">Real results from real businesses.</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="testimonial-card">
            <div class="quote-icon mb-2"><i class="fas fa-quote-left"></i></div>
            <p class="mb-3" style="font-size:.95rem;line-height:1.7;">"{{ config('app.name', 'WhatsDesk') }} transformed our customer communication. Our sales went up by 340% in just 3 months. The bulk messaging is absolutely flawless!"</p>
            <div class="stars mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <div class="d-flex align-items-center gap-3">
              <div class="t-avatar" style="background:#128C7E;">RS</div>
              <div><div class="fw-bold" style="font-size:.95rem;">Ravi Sharma</div><div class="text-muted" style="font-size:.8rem;">CEO, ShopMart India</div></div>
            </div>
          </div>
        </div>
        <!-- Add more testimonials dynamically or statically as before -->
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="testimonial-card">
            <div class="quote-icon mb-2"><i class="fas fa-quote-left"></i></div>
            <p class="mb-3" style="font-size:.95rem;line-height:1.7;">"The automation features are incredible. We now send personalized messages to 50,000 customers daily with zero manual effort!"</p>
            <div class="stars mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <div class="d-flex align-items-center gap-3">
              <div class="t-avatar" style="background:#1a73e8;">PM</div>
              <div><div class="fw-bold" style="font-size:.95rem;">Priya Mehta</div><div class="text-muted" style="font-size:.8rem;">Marketing Head, FreshBox</div></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in">
          <div class="testimonial-card">
            <div class="quote-icon mb-2"><i class="fas fa-quote-left"></i></div>
            <p class="mb-3" style="font-size:.95rem;line-height:1.7;">"Best WhatsApp marketing tool. The analytics dashboard helped us deeply understand our audience. Highly recommended to every business!"</p>
            <div class="stars mb-3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            <div class="d-flex align-items-center gap-3">
              <div class="t-avatar" style="background:#673AB7;">AV</div>
              <div><div class="fw-bold" style="font-size:.95rem;">Amit Verma</div><div class="text-muted" style="font-size:.8rem;">Founder, TechGurus</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="cta-section py-5">
    <div class="container position-relative" style="z-index:1;">
      <div class="row justify-content-center text-center text-white">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-3" style="font-size:clamp(1.8rem,4vw,2.5rem);">Ready to Supercharge Your Business with WhatsApp?</h2>
          <p class="mb-4" style="font-size:1.1rem;opacity:.9;">Join 1000+ businesses already using {{ config('app.name', 'WhatsDesk') }}. Start your free 7-day trial — no credit card required.</p>
          <a href="{{ auth()->check() ? route('plans.current') : route('register') }}" class="btn btn-wa btn-lg me-3"><i class="fas fa-rocket me-2"></i>Start Free Trial</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="pt-5 pb-3">
    <div class="container">
      <div class="row gy-4 mb-5">
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand mb-3">
            @if(config('settings.logo'))
                <img src="{{ config('settings.logo') }}" alt="{{ config('app.name', 'WhatsDesk') }}" style="max-height: 40px;" class="me-2">
            @else
                <i class="fab fa-whatsapp me-2" style="color:#25D366;font-size:1.6rem;"></i>
            @endif
            {{ config('app.name', 'WhatsDesk') }}
          </div>
          <p style="font-size:.9rem;line-height:1.8;">India's most trusted WhatsApp Marketing platform. Grow your business with AI-powered bulk messaging, automation, and real-time analytics.</p>
          <div class="mt-3">
            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <h6>Quick Links</h6>
          <a href="#home">Home</a>
          <a href="#features">Features</a>
          <a href="#pricing">Pricing</a>
          <a href="{{ route('login') }}">Login</a>
        </div>
        <div class="col-lg-2 col-md-6">
          <h6>Legal</h6>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookie Policy</a>
        </div>
        <div class="col-lg-2 col-md-6">
          <h6>Contact</h6>
          <a href="mailto:support@whatsdesk.com"><i class="fas fa-envelope me-2"></i>support@whatsdesk.com</a>
        </div>
      </div>
      <hr class="footer-divider" />
      <div class="row align-items-center py-2">
        <div class="col-md-6 mb-2 mb-md-0"><small style="color:rgba(255,255,255,.5);">© {{ date('Y') }} {{ config('app.name', 'WhatsDesk') }}. All rights reserved.</small></div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <button class="scroll-top-btn" id="scrollTopBtn" title="Back to top"><i class="fas fa-arrow-up"></i></button>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="{{ asset('new_design_assets/js/script.js') }}"></script>
</body>
</html>
