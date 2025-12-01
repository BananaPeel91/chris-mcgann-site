<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chris McGann - Professional Painter & Decorator. Quality painting and decorating services for residential and commercial properties.">
    <title>Chris McGann | Painter & Decorator</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-cream: #F5F1EB;
            --color-charcoal: #2C2C2C;
            --color-sage: #7D9181;
            --color-terracotta: #C67B5C;
            --color-gold: #C9A962;
            --color-white: #FFFFFF;
            --color-dark-overlay: rgba(44, 44, 44, 0.85);
            
            --font-display: 'Playfair Display', serif;
            --font-body: 'Outfit', sans-serif;
            
            --header-height: 80px;
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            scroll-padding-top: var(--header-height);
        }
        
        body {
            font-family: var(--font-body);
            background-color: var(--color-cream);
            color: var(--color-charcoal);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* ============================================
           STICKY HEADER
        ============================================ */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            z-index: 1000;
            transition: var(--transition-smooth);
            background: transparent;
        }
        
        .header.scrolled {
            background: var(--color-white);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
        }
        
        .header-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--color-white);
            text-decoration: none;
            transition: var(--transition-smooth);
            letter-spacing: 0.5px;
        }
        
        .header.scrolled .logo {
            color: var(--color-charcoal);
        }
        
        .nav {
            display: flex;
            gap: 50px;
        }
        
        .nav-link {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--color-white);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            transition: var(--transition-smooth);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-gold);
            transition: var(--transition-smooth);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .header.scrolled .nav-link {
            color: var(--color-charcoal);
        }
        
        /* Mobile menu toggle */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        
        .menu-toggle span {
            display: block;
            width: 28px;
            height: 2px;
            background: var(--color-white);
            transition: var(--transition-smooth);
        }
        
        .header.scrolled .menu-toggle span {
            background: var(--color-charcoal);
        }
        
        /* ============================================
           HOME SECTION
        ============================================ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: 
                linear-gradient(135deg, rgba(125, 145, 129, 0.9) 0%, rgba(44, 44, 44, 0.95) 100%),
                url('https://images.unsplash.com/photo-1562259949-e8e7689d7828?q=80&w=2031') center/cover;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(ellipse at 20% 80%, rgba(201, 169, 98, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(198, 123, 92, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        /* Decorative paint stroke */
        .paint-stroke {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 169, 98, 0.2) 0%, transparent 70%);
            filter: blur(60px);
            animation: float 8s ease-in-out infinite;
        }
        
        .paint-stroke-1 {
            top: 10%;
            right: 10%;
        }
        
        .paint-stroke-2 {
            bottom: 20%;
            left: 5%;
            animation-delay: -4s;
            background: radial-gradient(circle, rgba(198, 123, 92, 0.15) 0%, transparent 70%);
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 900px;
            padding: 0 40px;
        }
        
        .hero-subtitle {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 6px;
            color: var(--color-gold);
            margin-bottom: 25px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.2s;
        }
        
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 700;
            color: var(--color-white);
            line-height: 1.1;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.4s;
        }
        
        .hero-title span {
            display: block;
            color: var(--color-gold);
            font-size: 0.5em;
            font-weight: 400;
            margin-top: 10px;
        }
        
        .hero-description {
            font-size: 1.2rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.85);
            max-width: 650px;
            margin: 0 auto 45px;
            line-height: 1.8;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.6s;
        }
        
        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            padding: 18px 45px;
            background: var(--color-gold);
            color: var(--color-charcoal);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: var(--transition-smooth);
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.8s;
        }
        
        .hero-cta:hover {
            background: var(--color-white);
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .hero-cta svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }
        
        .hero-cta:hover svg {
            transform: translateX(5px);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
            margin-inline: auto;
            width: fit-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 1.2s;
        }
        
        .scroll-indicator::after {
            content: '';
            width: 1px;
            height: 50px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.6), transparent);
            animation: scrollPulse 2s ease-in-out infinite;
        }
        
        @keyframes scrollPulse {
            0%, 100% { transform: scaleY(1); opacity: 1; }
            50% { transform: scaleY(0.5); opacity: 0.5; }
        }
        
        /* ============================================
           GALLERY SECTION
        ============================================ */
        .gallery-section {
            padding: 120px 40px;
            background: var(--color-cream);
            position: relative;
        }
        
        .gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to bottom, var(--color-white), transparent);
            pointer-events: none;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
            z-index: 1;
        }
        
        .section-label {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: var(--color-sage);
            margin-bottom: 20px;
        }
        
        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            color: var(--color-charcoal);
            margin-bottom: 25px;
        }
        
        .section-divider {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-terracotta), var(--color-gold));
            margin: 0 auto;
        }
        
        /* Instagram Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            background: var(--color-charcoal);
            cursor: pointer;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-smooth);
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
            opacity: 0.7;
        }
        
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(44, 44, 44, 0.9) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 25px;
            opacity: 0;
            transition: var(--transition-smooth);
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-caption {
            color: var(--color-white);
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
            transform: translateY(20px);
            transition: var(--transition-smooth);
        }
        
        .gallery-item:hover .gallery-caption {
            transform: translateY(0);
        }
        
        .gallery-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--color-gold);
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none;
            margin-top: 15px;
            transform: translateY(20px);
            transition: var(--transition-smooth);
            transition-delay: 0.1s;
        }
        
        .gallery-item:hover .gallery-link {
            transform: translateY(0);
        }
        
        .gallery-link svg {
            width: 16px;
            height: 16px;
        }
        
        /* Instagram CTA */
        .instagram-cta {
            text-align: center;
            margin-top: 60px;
        }
        
        .instagram-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 40px;
            background: transparent;
            color: var(--color-charcoal);
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-decoration: none;
            border: 2px solid var(--color-charcoal);
            transition: var(--transition-smooth);
        }
        
        .instagram-button:hover {
            background: var(--color-charcoal);
            color: var(--color-white);
        }
        
        .instagram-button svg {
            width: 20px;
            height: 20px;
        }
        
        /* ============================================
           CONTACT BAR
        ============================================ */
        .contact-bar {
            background: var(--color-charcoal);
            padding: 60px 40px;
        }
        
        .contact-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 40px;
        }
        
        .contact-text h3 {
            font-family: var(--font-display);
            font-size: 1.8rem;
            font-weight: 500;
            color: var(--color-white);
            margin-bottom: 10px;
        }
        
        .contact-text p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
        }
        
        .contact-info {
            display: flex;
            gap: 50px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--color-white);
            text-decoration: none;
            transition: var(--transition-smooth);
        }
        
        .contact-item:hover {
            color: var(--color-gold);
        }
        
        .contact-item svg {
            width: 24px;
            height: 24px;
            color: var(--color-gold);
        }
        
        .contact-item span {
            font-size: 1rem;
            font-weight: 500;
        }
        
        /* ============================================
           FOOTER
        ============================================ */
        .footer {
            background: var(--color-charcoal);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 40px;
        }
        
        .footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .footer-text {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }
        
        .footer-links {
            display: flex;
            gap: 30px;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            text-decoration: none;
            transition: var(--transition-smooth);
        }
        
        .footer-link:hover {
            color: var(--color-gold);
        }
        
        /* ============================================
           LIGHTBOX
        ============================================ */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition-smooth);
        }
        
        .lightbox.active {
            opacity: 1;
            visibility: visible;
        }
        
        .lightbox-content {
            max-width: 90vw;
            max-height: 90vh;
            position: relative;
        }
        
        .lightbox-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }
        
        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            background: none;
            border: none;
            color: var(--color-white);
            font-size: 2rem;
            cursor: pointer;
            padding: 10px;
            transition: var(--transition-smooth);
        }
        
        .lightbox-close:hover {
            color: var(--color-gold);
        }
        
        .lightbox-caption {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }
        
        /* ============================================
           RESPONSIVE DESIGN
        ============================================ */
        @media (max-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .contact-info {
                gap: 30px;
            }
        }
        
        @media (max-width: 768px) {
            :root {
                --header-height: 70px;
            }
            
            .header-inner {
                padding: 0 25px;
            }
            
            .nav {
                position: fixed;
                top: var(--header-height);
                left: 0;
                right: 0;
                background: var(--color-white);
                padding: 30px;
                flex-direction: column;
                gap: 25px;
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: var(--transition-smooth);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }
            
            .nav.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }
            
            .nav-link {
                color: var(--color-charcoal);
                font-size: 1.1rem;
            }
            
            .menu-toggle {
                display: flex;
            }
            
            .menu-toggle.active span:nth-child(1) {
                transform: rotate(45deg) translate(5px, 6px);
            }
            
            .menu-toggle.active span:nth-child(2) {
                opacity: 0;
            }
            
            .menu-toggle.active span:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -6px);
            }
            
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .gallery-section {
                padding: 80px 25px;
            }
            
            .hero-content {
                padding: 0 25px;
            }
            
            .contact-inner {
                flex-direction: column;
                text-align: center;
            }
            
            .contact-info {
                flex-direction: column;
                gap: 20px;
            }
            
            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .hero-cta {
                padding: 15px 35px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sticky Header -->
    <header class="header" id="header">
        <div class="header-inner">
            <a href="#home" class="logo">Chris McGann</a>
            
            <nav class="nav" id="nav">
                <a href="#home" class="nav-link active">Home</a>
                <a href="#gallery" class="nav-link">Gallery</a>
                <a href="#contact" class="nav-link">Contact</a>
            </nav>
            
            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>
    
    <!-- Home Section -->
    <section class="hero" id="home">
        <div class="paint-stroke paint-stroke-1"></div>
        <div class="paint-stroke paint-stroke-2"></div>
        
        <div class="hero-content">
            <p class="hero-subtitle">Professional Painting Services</p>
            <h1 class="hero-title">
                Chris McGann
                <span>Painter & Decorator</span>
            </h1>
            <p class="hero-description">
                Transforming spaces with precision and artistry. With years of experience in residential and commercial painting, 
                I bring colour and life to every project—delivering exceptional quality finishes that stand the test of time.
            </p>
            <a href="#gallery" class="hero-cta">
                View My Work
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        
        <div class="scroll-indicator">
            <span>Scroll</span>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <section class="gallery-section" id="gallery">
        <div class="section-header">
            <p class="section-label">Portfolio</p>
            <h2 class="section-title">Recent Projects</h2>
            <div class="section-divider"></div>
        </div>
        
        <div class="gallery-grid">
            @forelse($instagramMedia as $media)
                <div class="gallery-item" 
                     data-src="{{ $media['media_type'] === 'VIDEO' ? ($media['thumbnail_url'] ?? $media['media_url']) : $media['media_url'] }}"
                     data-caption="{{ $media['caption'] ?? 'Project by Chris McGann' }}">
                    <img src="{{ $media['media_type'] === 'VIDEO' ? ($media['thumbnail_url'] ?? $media['media_url']) : $media['media_url'] }}" 
                         alt="{{ $media['caption'] ?? 'Painting project' }}"
                         loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">{{ Str::limit($media['caption'] ?? 'Professional painting project', 80) }}</p>
                        @if(!isset($media['is_placeholder']))
                            <a href="{{ $media['permalink'] }}" target="_blank" rel="noopener" class="gallery-link">
                                View on Instagram
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/paint1/600/600" alt="Painting project" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">Professional painting services</p>
                    </div>
                </div>
            @endforelse
        </div>
        
    </section>
    
    <!-- Contact Bar -->
    <section class="contact-bar" id="contact">
        <div class="contact-inner">
            <div class="contact-text">
                <h3>Ready to Transform Your Space?</h3>
                <p>Get in touch for a free quote on your painting project</p>
            </div>
            <div class="contact-info">
                <a href="tel:+447123456789" class="contact-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>07123 456 789</span>
                </a>
                <a href="mailto:chris@chrismcgann.com" class="contact-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>chris@chrismcgann.com</span>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <p class="footer-text">&copy; {{ date('Y') }} Chris McGann Painter & Decorator. All rights reserved.</p>
            <div class="footer-links">
                <a href="#home" class="footer-link">Home</a>
                <a href="#gallery" class="footer-link">Gallery</a>
                <a href="#contact" class="footer-link">Contact</a>
            </div>
        </div>
    </footer>
    
    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <button class="lightbox-close" aria-label="Close lightbox">&times;</button>
            <img src="" alt="Project image" id="lightboxImage">
            <p class="lightbox-caption" id="lightboxCaption"></p>
        </div>
    </div>
    
    <script>
        // Header scroll effect
        const header = document.getElementById('header');
        const heroSection = document.getElementById('home');
        
        function handleScroll() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Update active nav link
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        }
        
        window.addEventListener('scroll', handleScroll);
        handleScroll();
        
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const nav = document.getElementById('nav');
        
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            nav.classList.toggle('active');
        });
        
        // Close mobile menu on link click
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                nav.classList.remove('active');
            });
        });
        
        // Lightbox functionality
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');
        const lightboxClose = document.querySelector('.lightbox-close');
        
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', (e) => {
                if (e.target.closest('.gallery-link')) return;
                
                const src = item.dataset.src;
                const caption = item.dataset.caption;
                
                lightboxImage.src = src;
                lightboxCaption.textContent = caption;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Animate gallery items on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = `fadeInUp 0.6s ease forwards ${index * 0.1}s`;
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.style.opacity = '0';
            observer.observe(item);
        });
    </script>
</body>
</html>

