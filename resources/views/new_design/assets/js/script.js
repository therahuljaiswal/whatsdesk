/* ============================================
   BulkReach - WhatsApp Marketing Website
   Main JavaScript File
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

  /* ---- Sticky Navbar ---- */
  const navbar = document.getElementById('mainNavbar');
  if (navbar) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 50) {
        navbar.classList.add('navbar-scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
      }
    });
  }

  /* ---- Scroll to Top Button ---- */
  const scrollBtn = document.getElementById('scrollTopBtn');
  if (scrollBtn) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) {
        scrollBtn.classList.add('show');
      } else {
        scrollBtn.classList.remove('show');
      }
    });
    scrollBtn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---- Pricing Toggle (Monthly / Yearly) ---- */
  const monthlyBtn = document.getElementById('monthlyBtn');
  const yearlyBtn = document.getElementById('yearlyBtn');
  const saveBadge = document.getElementById('yearSaveBadge');

  if (monthlyBtn && yearlyBtn) {
    const prices = {
      starter:  { monthly: '₹999',   yearly: '₹799' },
      growth:   { monthly: '₹1,999', yearly: '₹1,599' },
      agency:   { monthly: '₹4,999', yearly: '₹3,999' },
    };
    const origPrices = {
      starter: '₹999/mo',
      growth:  '₹1,999/mo',
      agency:  '₹4,999/mo',
    };

    monthlyBtn.addEventListener('click', function () {
      monthlyBtn.classList.add('active');
      yearlyBtn.classList.remove('active');
      if (saveBadge) saveBadge.style.display = 'none';
      Object.keys(prices).forEach(function (plan) {
        const el = document.getElementById('price-' + plan);
        const orig = document.getElementById('orig-' + plan);
        if (el) el.textContent = prices[plan].monthly;
        if (orig) orig.style.display = 'none';
      });
    });

    yearlyBtn.addEventListener('click', function () {
      yearlyBtn.classList.add('active');
      monthlyBtn.classList.remove('active');
      if (saveBadge) saveBadge.style.display = 'inline-block';
      Object.keys(prices).forEach(function (plan) {
        const el = document.getElementById('price-' + plan);
        const orig = document.getElementById('orig-' + plan);
        if (el) el.textContent = prices[plan].yearly;
        if (orig) orig.style.display = 'block';
      });
    });
  }

  /* ---- Razorpay Dummy Integration ---- */
  document.querySelectorAll('.razorpay-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const plan = btn.getAttribute('data-plan') || 'Selected';
      const price = btn.getAttribute('data-price') || '';
      alert('Razorpay Payment Gateway\n\nPlan: ' + plan + '\nAmount: ' + price + '\n\nIn production this opens the secure Razorpay checkout modal.\nAccepts: UPI, Cards, Net Banking, Wallets & EMI.');
    });
  });

  /* ---- Contact Form Submission ---- */
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const successMsg = document.getElementById('formSuccess');
      if (successMsg) {
        successMsg.style.display = 'block';
        contactForm.reset();
        setTimeout(function () { successMsg.style.display = 'none'; }, 6000);
      }
    });
  }

  /* ---- Newsletter Form ---- */
  document.querySelectorAll('.newsletter-form').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const input = form.querySelector('input[type="email"]');
      if (input && input.value) {
        alert('🎉 Thank you for subscribing!\n\nYou\'ll receive our next newsletter at: ' + input.value);
        input.value = '';
      }
    });
  });

  /* ---- Smooth scroll for anchor links ---- */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 80;
        const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });

  /* ---- Active nav link ---- */
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link').forEach(function (link) {
    const href = link.getAttribute('href');
    if (href === currentPage || (currentPage === '' && href === 'index.html') || (href && href !== '#' && currentPage.includes(href.replace('.html', '')))) {
      link.classList.add('active');
      link.style.color = '#25D366';
    }
  });

  /* ---- Counter animation ---- */
  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-target'), 10);
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(function () {
      current += step;
      if (current >= target) { current = target; clearInterval(timer); }
      el.textContent = Math.floor(current).toLocaleString() + (el.getAttribute('data-suffix') || '');
    }, 16);
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-counter]').forEach(function (el) {
    observer.observe(el);
  });

  /* ---- AOS-like fade-in on scroll ---- */
  const fadeEls = document.querySelectorAll('.fade-in');
  if (fadeEls.length) {
    const fadeObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    fadeEls.forEach(function (el) {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      fadeObserver.observe(el);
    });
  }

});
