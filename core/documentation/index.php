<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larite Framework - Complete Documentation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Premium Color Palette */
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary: #06b6d4;
            --secondary-dark: #0891b2;
            --accent: #f59e0b;
            --accent-dark: #d97706;
            --success: #10b981;
            --success-dark: #059669;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --warning: #f59e0b;
            --info: #3b82f6;

            /* Text Colors */
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --text-inverse: #f8fafc;
            --text-accent: #6366f1;

            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-quaternary: #e2e8f0;
            --bg-dark: #0f172a;
            --bg-card: #ffffff;
            --bg-glass: rgba(255, 255, 255, 0.8);
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            /* Border Colors */
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --border-dark: #334155;
            --border-accent: #6366f1;

            /* Shadows */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --shadow-inner: inset 0 2px 4px 0 rgb(0 0 0 / 0.05);

            /* Border Radius */
            --radius-xs: 4px;
            --radius-sm: 6px;
            --radius: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --radius-full: 9999px;

            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;

            /* Transitions */
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);

            /* Spacing - Reduced for compact design */
            --space-xs: 0.25rem;
            --space-sm: 0.5rem;
            --space: 0.75rem;
            --space-lg: 1rem;
            --space-xl: 1.5rem;
            --space-2xl: 2rem;
            --space-3xl: 2.5rem;
        }

        [data-theme="dark"] {
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --text-inverse: #0f172a;

            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-quaternary: #475569;
            --bg-card: #1e293b;
            --bg-glass: rgba(30, 41, 59, 0.8);

            --border: #334155;
            --border-light: #475569;
            --border-dark: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: var(--transition);
            overflow-x: hidden;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
            font-size: 14px; /* Reduced base font size */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
            border-radius: var(--radius-full);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            border-radius: var(--radius-full);
            border: 1px solid var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--primary-dark), var(--secondary-dark));
        }

        /* Header - Compact */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px; /* Reduced from 80px */
            background: var(--bg-glass);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
            z-index: 1000;
            transition: var(--transition);
        }

        .header.scrolled {
            background: var(--bg-glass);
            box-shadow: var(--shadow-lg);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
            padding: 0 var(--space-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: var(--space);
        }

        .logo {
            height: 40px; /* Reduced from 60px */
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid var(--border);
        }

        .logo:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: var(--shadow);
            border-color: var(--primary);
        }

        .logo-text {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: var(--space-xl);
        }

        .nav-links {
            display: flex;
            gap: var(--space-lg);
            list-style: none;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            padding: var(--space-xs) var(--space);
            border-radius: var(--radius-full);
            transition: var(--transition);
            position: relative;
            font-size: 0.85rem; /* Reduced font size */
        }

        .nav-link:hover {
            color: var(--primary);
            background: var(--bg-secondary);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(6, 182, 212, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: var(--space);
        }

        .search-container {
            position: relative;
        }

        .search-input {
            width: 280px; /* Reduced from 350px */
            padding: var(--space-sm) var(--space) var(--space-sm) 2.5rem;
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            background: var(--bg-card);
            color: var(--text-primary);
            font-size: 0.85rem;
            transition: var(--transition);
            box-shadow: var(--shadow-xs);
            font-weight: 400;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1), var(--shadow-sm);
            transform: translateY(-1px);
        }

        .search-icon {
            position: absolute;
            left: var(--space);
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .search-results {
            position: absolute;
            top: calc(100% + var(--space-sm));
            left: 0;
            right: 0;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 1001;
        }

        .search-result {
            padding: var(--space);
            border-bottom: 1px solid var(--border-light);
            cursor: pointer;
            transition: var(--transition-fast);
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: 0.85rem;
        }

        .search-result:hover {
            background: var(--bg-secondary);
            transform: translateX(2px);
        }

        .search-result:last-child {
            border-bottom: none;
        }

        .search-result-icon {
            color: var(--primary);
            font-size: 0.8rem;
            width: 16px;
            text-align: center;
        }

        .theme-toggle {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            padding: var(--space-sm);
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-primary);
            box-shadow: var(--shadow-xs);
            width: 36px; /* Reduced from 48px */
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .theme-toggle:hover {
            background: var(--bg-secondary);
            transform: translateY(-1px) rotate(180deg);
            box-shadow: var(--shadow-sm);
            border-color: var(--primary);
        }

        .mobile-menu-btn {
            display: none;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text-primary);
            font-size: 1rem;
            cursor: pointer;
            padding: var(--space-sm);
            transition: var(--transition);
        }

        .mobile-menu-btn:hover {
            background: var(--bg-secondary);
            border-color: var(--primary);
        }

        /* Layout */
        .layout {
            display: flex;
            margin-top: 60px; /* Adjusted for smaller header */
            min-height: calc(100vh - 60px);
        }

        /* Sidebar - Compact */
        .sidebar {
            width: 300px;
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            position: fixed;
            height: calc(100vh - 70px);
            overflow-y: auto;
            z-index: 999;
        }

        .sidebar-header {
            padding: var(--space-xl);
            border-bottom: 1px solid var(--border-light);
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
        }

        .sidebar-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--space-xs);
        }

        .sidebar-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .sidebar-content {
            padding: var(--space) 0;
        }

        .nav-section {
            margin-bottom: var(--space);
        }

        .nav-section-title {
            padding: var(--space-lg) var(--space-xl) var(--space);
            font-weight: 700;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
            border-radius: var(--radius);
            margin: 0 var(--space);
        }

        .nav-section-title:hover {
            color: var(--primary);
            background: var(--bg-secondary);
            transform: translateX(2px);
        }

        .nav-section-icon {
            font-size: 0.9rem;
            margin-right: var(--space-sm);
        }

        .nav-arrow {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.7rem;
            color: var(--primary);
        }

        .nav-arrow.rotated {
            transform: rotate(90deg);
        }

        .nav-items {
            display: none;
            animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-items.expanded {
            display: block;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: var(--space-sm) var(--space-lg) var(--space-sm) 2.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition);
            border-left: 2px solid transparent;
            font-size: 0.85rem;
            font-weight: 400;
            position: relative;
            margin: 0 var(--space-sm);
            border-radius: var(--radius-sm);
        }

        .nav-item:hover {
            color: var(--primary);
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.05) 0%, transparent 100%);
            border-left-color: var(--primary);
            transform: translateX(2px);
        }

        .nav-item.active {
            color: var(--primary);
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(6, 182, 212, 0.05) 100%);
            border-left-color: var(--primary);
            font-weight: 500;
        }

        .nav-item-icon {
            margin-right: var(--space-sm);
            font-size: 0.8rem;
            width: 14px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 0;
            max-width: calc(100% - 280px);
            margin-left: 300px;
        }

        /* Hero Section - Compact */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: var(--space-20) 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url(data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="10" height="10" patternUnits="userSpaceOnUse"><circle cx="5" cy="5" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>);
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-logo {
            height: 100px; /* Reduced from 120px */
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            animation: float 6s ease-in-out infinite;
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: var(--space-xl);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }

        .hero-title {
            line-height: 1.1;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: var(--space-4);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: var(--space-8);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .hero-features {
            display: flex;
            justify-content: center;
            gap: var(--space);
            flex-wrap: wrap;
            margin-bottom: var(--space-xl);
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            background: rgba(255, 255, 255, 0.15);
            padding: var(--space-sm) var(--space);
            border-radius: var(--radius-full);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.85rem;
        }

        .hero-feature:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .hero-feature i {
            font-size: 0.9rem;
        }

        .hero-cta {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space) var(--space-xl); /* Reduced padding */
            border-radius: var(--radius-full);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 0.9rem; /* Reduced font size */
            position: relative;
            overflow: hidden;

            gap: var(--space-2);
            padding: var(--space-4) var(--space-6);
            border-radius: var(--radius-md);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: var(--bg-secondary);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        /* Content Container - Compact */
        .content-container {
            max-width: 1200px; /* Reduced from 1200px */
            margin: 0 auto;
            padding: var(--space-2xl) var(--space-lg);
        }

        /* Content Sections - Compact */
        .content-section {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: var(--space-2xl); /* Reduced from var(--space-3xl) */
            margin-bottom: var(--space-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary), var(--secondary), var(--accent));
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        .content-section:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
            border-color: var(--primary);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: var(--space);
            margin-bottom: var(--space-xl);
            padding-bottom: var(--space);
            border-bottom: 1px solid var(--border-light);
        }

        .section-icon {
            width: 40px; /* Reduced from 60px */
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            box-shadow: var(--shadow-sm);
        }

        .section-title {
            font-size: 1.8rem; /* Reduced from 2.5rem */
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .content-section h2 {
            color: var(--text-primary);
            margin: var(--space-xl) 0 var(--space) 0;
            font-size: 1.5rem; /* Reduced from 2rem */
            font-weight: 600;
            position: relative;
            padding-left: var(--space);
        }

        .content-section h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            border-radius: var(--radius-sm);
        }

        .content-section h3 {
            color: var(--text-primary);
            margin: var(--space-lg) 0 var(--space) 0;
            font-size: 1.2rem; /* Reduced from 1.6rem */
            font-weight: 600;
        }

        .content-section h4 {
            color: var(--text-primary);
            margin: var(--space) 0 var(--space-sm) 0;
            font-size: 1.1rem; /* Reduced from 1.3rem */
            font-weight: 600;
        }

        .content-section p {
            margin-bottom: var(--space);
            color: var(--text-secondary);
            font-size: 0.95rem; /* Reduced from 1.1rem */
            line-height: 1.6;
            font-weight: 400;
        }

        .content-section ul {
            padding-left: 0;
            margin-bottom: var(--space);
            list-style: none;
        }

        .content-section li {
            margin-bottom: var(--space-sm);
            color: var(--text-secondary);
            font-size: 0.95rem;
            display: flex;
            align-items: flex-start;
            gap: var(--space-sm);
            font-weight: 400;
            padding: var(--space-xs);
            border-radius: var(--radius-sm);
            transition: var(--transition-fast);
        }

        .content-section li:hover {
            background: var(--bg-secondary);
            transform: translateX(2px);
        }

        .content-section li::before {
            content: '✓';
            color: var(--success);
            font-weight: 600;
            margin-top: 0.1rem;
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-full);
            width: 18px; /* Reduced from 24px */
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        /* Premium Code Blocks - Compact */
        .code-container {
            position: relative;
            margin: var(--space-lg) 0;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            background: #1e293b;
        }

        .code-header {
            background: linear-gradient(135deg, #334155, #475569);
            padding: var(--space) var(--space-lg);
            border-bottom: 1px solid #475569;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .code-language {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            font-size: 0.8rem;
            font-weight: 500;
            color: #e2e8f0;
        }

        .code-language-icon {
            width: 16px;
            height: 16px;
            border-radius: var(--radius-xs);
            box-shadow: var(--shadow-xs);
        }

        .copy-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: var(--space-xs) var(--space);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            font-weight: 500;
        }

        .copy-btn:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .code-block {
            /*background: #1e293b !important;*/
            background: #1a1a1a !important;
            color: #e2e8f0 !important;
            padding: var(--space-lg) !important;
            margin: 0 !important;
            overflow-x: auto;
            font-family: 'JetBrains Mono', 'Monaco', 'Menlo', monospace !important;
            font-size: 1rem !important;
            line-height: 1.6 !important;
            border: none !important;
            font-weight: 400 !important;
        }

        /* Enhanced Syntax Highlighting */
        .code-block .keyword {
            color: #c792ea !important;
            font-weight: 500 !important;
        }

        .code-block .string {
            color: #c3e88d !important;
        }

        .code-block .comment {
            color: #546e7a !important;
            font-style: italic;
            opacity: 0.8;
        }

        .code-block .number {
            color: #f78c6c !important;
            font-weight: 500 !important;
        }

        .code-block .function {
            color: #82aaff !important;
            font-weight: 500 !important;
        }

        .code-block .variable {
            color: #ffcb6b !important;
        }

        .code-block .operator {
            color: #eff5f8 !important;
            font-weight: 500 !important;
        }

        .code-block .tag {
            color: #f07178 !important;
            font-weight: 500 !important;
        }

        .code-block .attribute {
            color: #c792ea !important;
        }

        .code-block .value {
            color: #c3e88d !important;
        }

        .code-block .class {
            color: #ffcb6b !important;
            font-weight: 500 !important;
        }

        .code-block .method {
            color: #82aaff !important;
            font-weight: 500 !important;
        }

        .code-block .property {
            color: #80cbc4 !important;
        }

        .code-block .punctuation {
            color: #89ddff !important;
        }

        .code-block .php-tag {
            color: #89ddff !important;
            font-weight: 500 !important;
        }

        .code-block .php-variable {
            color: #f78c6c !important;
        }

        .code-block .bash-command {
            color: #c3e88d !important;
            font-weight: 500 !important;
        }

        .code-block .bash-flag {
            color: #82aaff !important;
        }

        .code-block .env-key {
            color: #ffcb6b !important;
            font-weight: 500 !important;
        }

        .code-block .env-value {
            color: #c3e88d !important;
        }

        /* Premium Tables - Compact */
        .table-wrapper {
            overflow-x: auto;
            margin: var(--space-lg) 0;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            background: var(--bg-card);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--bg-card);
        }

        th, td {
            padding: var(--space);
            text-align: left;
            border-bottom: 1px solid var(--border-light);
            font-size: 0.85rem;
        }

        th {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        td {
            color: var(--text-secondary);
            font-weight: 400;
        }

        tr:hover {
            background: var(--bg-secondary);
        }

        td code {
            background: var(--bg-tertiary);
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--primary);
            font-weight: 500;
            border: 1px solid var(--border);
        }

        /* Premium Alerts - Compact */
        .alert {
            padding: var(--space-lg);
            border-radius: var(--radius);
            margin: var(--space-lg) 0;
            border-left: 4px solid;
            display: flex;
            align-items: flex-start;
            gap: var(--space);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05));
        }

        .alert-icon {
            font-size: 1.2rem;
            margin-top: 0.1rem;
        }

        .alert-content {
            flex: 1;
            font-weight: 400;
            font-size: 0.9rem;
        }

        .alert.info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            border-color: var(--info);
            color: var(--info);
        }

        .alert.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
            border-color: var(--warning);
            color: var(--warning);
        }

        .alert.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            border-color: var(--success);
            color: var(--success);
        }

        .alert.danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border-color: var(--danger);
            color: var(--danger);
        }

        /* Progress Bar */
        .progress-bar {
            position: fixed;
            top: 60px;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            transition: width 0.3s ease;
            z-index: 1001;
            box-shadow: 0 1px 5px rgba(99, 102, 241, 0.3);
        }

        /* Floating Action Button - Compact */
        .fab {
            position: fixed;
            bottom: var(--space-lg);
            right: var(--space-lg);
            width: 48px; /* Reduced from 64px */
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: var(--radius-full);
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 1000;
            font-size: 1rem;
        }

        .fab:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
            transform: translateY(-3px) scale(1.05);
            box-shadow: var(--shadow-xl);
        }

        /* Table of Contents - Compact with Hide Option */
        .toc {
            position: fixed;
            right: var(--space-lg);
            top: 50%;
            transform: translateY(-50%);
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: var(--space);
            box-shadow: var(--shadow);
            max-height: 400px;
            overflow-y: auto;
            width: 200px; /* Reduced from 250px */
            display: none;
            z-index: 998;
            transition: var(--transition);
        }

        .toc.hidden {
            transform: translateY(-50%) translateX(220px);
            opacity: 0;
            pointer-events: none;
        }

        .toc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-sm);
            padding-bottom: var(--space-sm);
            border-bottom: 1px solid var(--border-light);
        }

        .toc-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .toc-hide-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: var(--space-xs);
            border-radius: var(--radius-sm);
            transition: var(--transition);
            font-size: 0.8rem;
        }

        .toc-hide-btn:hover {
            color: var(--primary);
            background: var(--bg-secondary);
        }

        .toc-item {
            display: block;
            padding: var(--space-xs) 0;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            transition: var(--transition);
            border-left: 2px solid transparent;
            padding-left: var(--space-sm);
            border-radius: var(--radius-sm);
            font-weight: 400;
        }

        .toc-item:hover,
        .toc-item.active {
            color: var(--primary);
            border-left-color: var(--primary);
            background: var(--bg-secondary);
            transform: translateX(2px);
        }

        /* TOC Show Button */
        .toc-show-btn {
            position: fixed;
            right: var(--space-lg);
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            width: 36px;
            height: 36px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 999;
            font-size: 0.9rem;
        }

        .toc-show-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-50%) scale(1.1);
            box-shadow: var(--shadow-md);
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Responsive Design */
        @media (max-width: 1400px) {
            .toc, .toc-show-btn {
                display: none !important;
            }
        }

        @media (max-width: 1024px) {
            .search-input {
                width: 220px;
            }

            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .search-container {
                display: none;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                max-width: 100%;
            }

            .header-content {
                padding: 0 var(--space);
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .hero-features {
                flex-direction: column;
                align-items: center;
            }

            .content-container {
                padding: var(--space-lg) var(--space);
            }

            .content-section {
                padding: var(--space-lg);
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .fab {
                bottom: var(--space);
                right: var(--space);
            }
        }

        /* Highlight search results */
        .highlight {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(245, 158, 11, 0.1));
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-sm);
            font-weight: 500;
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .skeleton {
            background: linear-gradient(90deg, var(--bg-secondary) 25%, var(--bg-tertiary) 50%, var(--bg-secondary) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        /* Custom Badges - Compact */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-full);
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            border: 1px solid;
        }

        .badge.primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-color: var(--primary);
        }

        .badge.success {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border-color: var(--success);
        }

        .badge.info {
            background: linear-gradient(135deg, var(--info), var(--secondary));
            color: white;
            border-color: var(--info);
        }

        .badge.warning {
            background: linear-gradient(135deg, var(--warning), var(--accent-dark));
            color: white;
            border-color: var(--warning);
        }

        /* Image Styles - Compact */
        .content-image {
            width: 100%;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin: var(--space-lg) 0;
            transition: var(--transition);
        }

        .content-image:hover {
            transform: scale(1.01);
            box-shadow: var(--shadow-md);
        }

        .code-block,
        .code-block code,
        .code-block span {
            font-family: 'Fira Code', 'Monaco', 'Menlo', monospace !important;
        }

    </style>
</head>
<body>
<!-- Progress Bar -->
<div class="progress-bar" id="progressBar"></div>

<!-- Header -->
<header class="header" id="header">
    <div class="header-content">
        <div class="logo-section">
            <img src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/public/images/logo/larite.jpg" alt="Larite Logo" class="logo">
            <span class="logo-text">Larite</span>
        </div>

        <nav class="header-nav">
            <ul class="nav-links">
                <li><a href="#introduction" class="nav-link active">Documentation</a></li>
                <li><a href="#installation" class="nav-link">Quick Start</a></li>
                <li><a href="#features" class="nav-link">Features</a></li>
                <li><a href="#routing" class="nav-link">Routing</a></li>
                <li><a href="#contribute" class="nav-link">Community</a></li>
            </ul>

            <div class="header-controls">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search documentation..." id="searchInput">
                    <div class="search-results" id="searchResults"></div>
                </div>
                <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                    <i class="fas fa-moon"></i>
                </button>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
    </div>
</header>

<div class="layout">
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header" style="display: none">
            <div class="sidebar-title">Complete Documentation</div>
            <div class="sidebar-subtitle">Everything you need to build with Larite</div>
        </div>

        <div class="sidebar-content">
            <div class="nav-section">
                <div class="nav-section-title" data-section="getting-started">
                    <span><i class="fas fa-rocket nav-section-icon"></i>Getting Started</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <div class="nav-items">
                    <a href="#introduction" class="nav-item">
                        <i class="fas fa-book nav-item-icon"></i>Introduction
                    </a>
                    <a href="#why-larite" class="nav-item">
                        <i class="fas fa-star nav-item-icon"></i>Why Larite?
                    </a>
                    <a href="#security" class="nav-item">
                        <i class="fas fa-shield-alt nav-item-icon"></i>Security
                    </a>
                    <a href="#features" class="nav-item">
                        <i class="fas fa-gem nav-item-icon"></i>Features
                    </a>
                    <a href="#installation" class="nav-item">
                        <i class="fas fa-download nav-item-icon"></i>Installation
                    </a>
                    <a href="#environment" class="nav-item">
                        <i class="fas fa-cog nav-item-icon"></i>Environment Setup
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title" data-section="routing">
                    <span><i class="fas fa-route nav-section-icon"></i>Routing</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <div class="nav-items">
                    <a href="#routing" class="nav-item">
                        <i class="fas fa-map nav-item-icon"></i>Basic Routing
                    </a>
                    <a href="#named-routes" class="nav-item">
                        <i class="fas fa-tag nav-item-icon"></i>Named Routes
                    </a>
                    <a href="#resource-routes" class="nav-item">
                        <i class="fas fa-layer-group nav-item-icon"></i>Resource Routes
                    </a>
                    <a href="#route-parameters" class="nav-item">
                        <i class="fas fa-code nav-item-icon"></i>Route Parameters
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title" data-section="database">
                    <span><i class="fas fa-database nav-section-icon"></i>Database</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <div class="nav-items">
                    <a href="#migrations" class="nav-item">
                        <i class="fas fa-exchange-alt nav-item-icon"></i>Migrations
                    </a>
                    <a href="#queries-orm" class="nav-item">
                        <i class="fas fa-search nav-item-icon"></i>Queries & ORM
                    </a>
                    <a href="#relationships" class="nav-item">
                        <i class="fas fa-link nav-item-icon"></i>Relationships
                    </a>
                    <a href="#seeding" class="nav-item">
                        <i class="fas fa-seedling nav-item-icon"></i>Database Seeding
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title" data-section="advanced">
                    <span><i class="fas fa-bolt nav-section-icon"></i>Advanced</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <div class="nav-items">
                    <a href="#middleware" class="nav-item">
                        <i class="fas fa-shield-alt nav-item-icon"></i>Middleware
                    </a>
                    <a href="#validation" class="nav-item">
                        <i class="fas fa-check-circle nav-item-icon"></i>Validation
                    </a>
                    <a href="#mail" class="nav-item">
                        <i class="fas fa-envelope nav-item-icon"></i>Mail Support
                    </a>
                    <a href="#commands" class="nav-item">
                        <i class="fas fa-terminal nav-item-icon"></i>CLI Commands
                    </a>
                    <a href="#scheduler" class="nav-item">
                        <i class="fas fa-clock nav-item-icon"></i>Task Scheduler
                    </a>
                    <a href="#exceptions" class="nav-item">
                        <i class="fas fa-exclamation-triangle nav-item-icon"></i>Exception Handling
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title" data-section="showcase">
                    <span><i class="fas fa-images nav-section-icon"></i>Showcase</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <div class="nav-items">
                    <a href="#welcome" class="nav-item">
                        <i class="fas fa-home nav-item-icon"></i>Welcome Page
                    </a>
                    <a href="#comparison" class="nav-item">
                        <i class="fas fa-brain nav-item-icon"></i>ChatGPT Review
                    </a>
                    <a href="#contribute" class="nav-item">
                        <i class="fas fa-heart nav-item-icon"></i>Contribute
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <img src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/public/images/logo/larite.jpg" alt="Larite Logo" class="hero-logo">
                <h1 class="hero-title">Larite Framework</h1>
                <p class="hero-subtitle">
                    Lightweight. Laravel-Inspired. 100% Custom. A modern PHP MVC framework built from scratch for developers who demand performance and simplicity.
                </p>

                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-feather-alt"></i>
                        <span>Lightweight</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-rocket"></i>
                        <span>Fast</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-code"></i>
                        <span>Laravel-Style</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure</span>
                    </div>
                </div>

                <div class="hero-cta">
                    <a href="#installation" class="btn btn-primary">
                        <i class="fas fa-download"></i>
                        Get Started
                    </a>
                    <a href="#introduction" class="btn btn-secondary">
                        <i class="fas fa-book"></i>
                        Read Documentation
                    </a>
                </div>
            </div>
        </section>

        <div class="content-container">
            <!-- Introduction -->
            <section id="introduction" class="content-section fade-in-up">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h1 class="section-title">Introduction</h1>
                </div>

                <p>
                    Larite is a <strong>lightweight PHP MVC framework</strong> inspired by Laravel, but built entirely from scratch.
                    It's designed for developers who love Laravel's syntax and structure but want full control, performance, and simplicity.
                </p>

                <p>
                    Larite is <strong>not a Laravel clone</strong>. It's a fresh micro-framework for small to medium web apps, dashboards,
                    admin panels, and educational projects — without Composer bloat or hidden magic.
                </p>

                <div class="alert info">
                    <i class="fas fa-info-circle alert-icon"></i>
                    <div class="alert-content">
                        <strong>Perfect For:</strong> Small to medium web applications, dashboards, admin panels, and educational projects.
                    </div>
                </div>
            </section>

            <!-- Why Larite -->
            <section id="why-larite" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h1 class="section-title">Why Choose Larite?</h1>
                </div>

                <ul>
                    <li>Laravel-style routing, middleware, and validation</li>
                    <li>Custom-built DI container and lifecycle</li>
                    <li>CSRF protection and input sanitization</li>
                    <li>Auth scaffolding, flash messages, old inputs</li>
                    <li>CLI commands for models, controllers, and migrations</li>
                    <li>Useful helpers: mail, pagination</li>
                    <li>Simple, extendable, and easy to read/learn</li>
                </ul>
            </section>

            <!-- Security -->
            <section id="security" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h1 class="section-title">Security Features</h1>
                </div>

                <ul>
                    <li>CSRF Protection: <code>&lt;?php csrf_field(); ?&gt;</code> inside <code>&lt;form&gt;</code></li>
                    <li>Output escaping: <code>&lt;?= e($value) ?&gt;</code></li>
                    <li>File upload validation</li>
                    <li>Automatic input sanitization</li>
                </ul>
            </section>

            <!-- Features -->
            <section id="features" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h1 class="section-title">Core Features</h1>
                </div>

                <ul>
                    <li>Auth Scaffolding (<code>Route::authenticate()</code>)</li>
                    <li>Pagination: <code>paginate()</code> / <code>simplePaginate()</code></li>
                    <li>Old input repopulation: <code>old('field')</code></li>
                    <li>Flash messages and session management</li>
                    <li>Built-in validation system</li>
                    <li>Database migrations and seeding</li>
                </ul>
            </section>

            <!-- Installation -->
            <section id="installation" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h1 class="section-title">Installation</h1>
                </div>

                <p>Make sure you have <strong>PHP 8+</strong> and <strong>Composer</strong> installed.</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #4CAF50;"></div>
                            <span>Terminal</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="bash-command">composer</span> <span class="bash-flag">install</span></code></pre>
                </div>
            </section>

            <!-- Environment Setup -->
            <section id="environment" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h1 class="section-title">Environment Setup</h1>
                </div>

                <p>Rename <code>.env.example</code> to <code>.env</code> and configure your environment:</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #FF9800;"></div>
                            <span>Environment</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="env-key">APP_ENV</span>=<span class="env-value">development</span>
<span class="env-key">DB_HOST</span>=<span class="env-value">localhost</span>
<span class="env-key">DB_DATABASE</span>=<span class="env-value">Larite</span>
<span class="env-key">DB_USERNAME</span>=<span class="env-value">root</span>
<span class="env-key">DB_PASSWORD</span>=<span class="env-value">secret</span>
<span class="env-key">AUTH_TABLE</span>=<span class="env-value">users</span></code></pre>
                </div>

                <div class="alert warning">
                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                    <div class="alert-content">
                        <strong>Production Mode:</strong> Set <code>APP_ENV=production</code> to hide error output in production.
                    </div>
                </div>
            </section>

            <!-- Routing -->
            <section id="routing" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h1 class="section-title">Routing</h1>
                </div>

                <h3>Basic Route Definition</h3>
                <p>Define routes in <code>routes/web.php</code>:</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">HomeController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'index'</span><span class="punctuation">]);</span></code></pre>
                </div>

                <h3>Route Groups</h3>
                <p>Group routes with common attributes:</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Route</span><span class="operator">::</span><span class="method">group</span><span class="punctuation">([</span><span class="string">'prefix'</span> <span class="operator">=></span> <span class="string">'admin'</span><span class="punctuation">,</span> <span class="string">'middleware'</span> <span class="operator">=></span> <span class="punctuation">[</span><span class="string">'auth'</span><span class="punctuation">]],</span> <span class="keyword">function</span> <span class="punctuation">()</span> <span class="punctuation">{</span>
    <span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'dashboard'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">DashboardController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'index'</span><span class="punctuation">]);</span>
<span class="punctuation">});</span></code></pre>
                </div>
            </section>

            <!-- Named Routes -->
            <section id="named-routes" class="content-section">
                <h2>Named Routes</h2>
                <p>Named routes allow you to generate URLs for specific routes using a name instead of hardcoding the URL. This makes your application more maintainable and flexible.</p>

                <h3>Defining Named Routes</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="comment">// In routes/web.php</span>
<span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">HomeController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'index'</span><span class="punctuation">])</span><span class="operator">-></span><span class="method">name</span><span class="punctuation">(</span><span class="string">'home.index'</span><span class="punctuation">);</span>
<span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/about'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">HomeController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'about'</span><span class="punctuation">])</span><span class="operator">-></span><span class="method">name</span><span class="punctuation">(</span><span class="string">'about'</span><span class="punctuation">);</span>
<span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/users/{id}'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">UserController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'show'</span><span class="punctuation">])</span><span class="operator">-></span><span class="method">name</span><span class="punctuation">(</span><span class="string">'users.show'</span><span class="punctuation">);</span></code></pre>
                </div>

                <h3>Using Named Routes</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="comment">// Generate URL for a named route</span>
<span class="keyword">echo</span> <span class="function">route</span><span class="punctuation">(</span><span class="string">'home.index'</span><span class="punctuation">);</span> <span class="comment">// Outputs: /</span>

<span class="comment">// Generate URL with parameters</span>
<span class="keyword">echo</span> <span class="function">route</span><span class="punctuation">(</span><span class="string">'users.show'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="string">'user'</span> <span class="operator">=></span> <span class="number">5</span><span class="punctuation">]);</span> <span class="comment">// Outputs: /users/5</span>

<span class="comment">// Use in views</span>
<span class="tag">&lt;a</span> <span class="attribute">href</span>=<span class="value">"&lt;?= route('home.index') ?&gt;"</span><span class="tag">&gt;</span>Home<span class="tag">&lt;/a&gt;</span>
<span class="tag">&lt;a</span> <span class="attribute">href</span>=<span class="value">"&lt;?= route('users.show', ['user' => 1]) ?&gt;"</span><span class="tag">&gt;</span>View User<span class="tag">&lt;/a&gt;</span>

<span class="comment">// Use in redirects</span>
<span class="function">redirect</span><span class="punctuation">(</span><span class="function">route</span><span class="punctuation">(</span><span class="string">'users.index'</span><span class="punctuation">));</span>
<span class="function">redirect</span><span class="punctuation">(</span><span class="function">route</span><span class="punctuation">(</span><span class="string">'users.show'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="string">'user'</span> <span class="operator">=></span> <span class="number">5</span><span class="punctuation">]));</span></code></pre>
                </div>
            </section>

            <!-- Resource Routes -->
            <section id="resource-routes" class="content-section">
                <h2>Resource Routes</h2>
                <p>Resource routes provide a quick way to create all the necessary routes for a resource controller. A resource controller typically handles CRUD operations for a model.</p>

                <h3>Defining Resource Routes</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="comment">// In routes/web.php</span>
<span class="class">Route</span><span class="operator">::</span><span class="method">resource</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">,</span> <span class="class">UserController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">);</span></code></pre>
                </div>

                <p>This single line creates the following routes:</p>
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Method</th>
                            <th>URI</th>
                            <th>Name</th>
                            <th>Action</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><code>GET</code></td>
                            <td><code>/users</code></td>
                            <td><code>users.index</code></td>
                            <td><code>index()</code></td>
                            <td>Display a listing of the resource</td>
                        </tr>
                        <tr>
                            <td><code>GET</code></td>
                            <td><code>/users/create</code></td>
                            <td><code>users.create</code></td>
                            <td><code>create()</code></td>
                            <td>Show the form for creating a new resource</td>
                        </tr>
                        <tr>
                            <td><code>POST</code></td>
                            <td><code>/users</code></td>
                            <td><code>users.store</code></td>
                            <td><code>store()</code></td>
                            <td>Store a newly created resource</td>
                        </tr>
                        <tr>
                            <td><code>GET</code></td>
                            <td><code>/users/{user}</code></td>
                            <td><code>users.show</code></td>
                            <td><code>show()</code></td>
                            <td>Display the specified resource</td>
                        </tr>
                        <tr>
                            <td><code>GET</code></td>
                            <td><code>/users/{user}/edit</code></td>
                            <td><code>users.edit</code></td>
                            <td><code>edit()</code></td>
                            <td>Show the form for editing the specified resource</td>
                        </tr>
                        <tr>
                            <td><code>PUT/PATCH</code></td>
                            <td><code>/users/{user}</code></td>
                            <td><code>users.update</code></td>
                            <td><code>update()</code></td>
                            <td>Update the specified resource</td>
                        </tr>
                        <tr>
                            <td><code>DELETE</code></td>
                            <td><code>/users/{user}</code></td>
                            <td><code>users.destroy</code></td>
                            <td><code>destroy()</code></td>
                            <td>Remove the specified resource</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Route Parameters -->
            <section id="route-parameters" class="content-section">
                <h2>Route Parameters</h2>
                <p>Route parameters allow you to capture segments of the URI within your route definition.</p>

                <h3>Required Parameters</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/user/{id}'</span><span class="punctuation">,</span> <span class="keyword">function</span> <span class="punctuation">(</span><span class="php-variable">$id</span><span class="punctuation">)</span> <span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="string">'User '</span> <span class="operator">.</span> <span class="php-variable">$id</span><span class="punctuation">;</span>
<span class="punctuation">});</span>

<span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/posts/{post}/comments/{comment}'</span><span class="punctuation">,</span> <span class="keyword">function</span> <span class="punctuation">(</span><span class="php-variable">$postId</span><span class="punctuation">,</span> <span class="php-variable">$commentId</span><span class="punctuation">)</span> <span class="punctuation">{</span>
    <span class="comment">// Handle multiple parameters</span>
<span class="punctuation">});</span></code></pre>
                </div>

                <h3>Optional Parameters</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/user/{name?}'</span><span class="punctuation">,</span> <span class="keyword">function</span> <span class="punctuation">(</span><span class="php-variable">$name</span> <span class="operator">=</span> <span class="string">'Guest'</span><span class="punctuation">)</span> <span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="php-variable">$name</span><span class="punctuation">;</span>
<span class="punctuation">});</span></code></pre>
                </div>
            </section>

            <!-- Extending Routes -->
            <section id="middleware" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h1 class="section-title">Extending Routes</h1>
                </div>

                <p>Register route files in <code>`app/Providers/RouteServiceProvider.php`</code></p>
                <pre class="code-block"><code><span class="keyword">public static function </span><span class="function">register()</span><span class="property">: array </span>
<span class="punctuation">{</span><span class="punctuation">
     <span class="keywork">return</span> <span class="punctuation"> [</span>
        <span class="string">'routes/web.php',</span>
        <span class="string">'routes/api.php',</span>
     <span class="punctuation"> ]</span><span class="punctuation">;</span>
<span class="punctuation">}</span></code></pre>

                <div class="alert info">
                    <i class="fas fa-info-circle alert-icon"></i>
                    <div class="alert-content">
                        <strong>Note:</strong> Larite will autoload them all.
                    </div>
                </div>
            </section>

            <!--Middleware-->
            <section id="middleware" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h1 class="section-title">Middleware System</h1>
                </div>

                <p>You can create new middleware by running the below command:</p>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #4CAF50;"></div>
                            <span>Terminal</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">make:middleware</span> <span class="bash-flag">Authenticate</span></code></pre>
                </div>

                <p>Register middleware in <code>App\Kernel.php</code>:</p>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="php-variable">$routeMiddleware</span> <span class="operator">=</span> <span class="punctuation">[</span>
    <span class="string">'auth'</span> <span class="operator">=></span> <span class="class">Authenticate</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span>
    <span class="string">'web'</span>  <span class="operator">=></span> <span class="class">WebMiddleware</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span>
<span class="punctuation">];</span></code></pre>
                </div>

                <p>You can define middleware in any controller's constructor:</p>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">$this</span><span class="operator">-></span><span class="method">middleware</span><span class="punctuation">(</span><span class="punctuation">[</span><span class="string">'auth'</span><span class="punctuation">,</span> <span class="punctuation"><span class="string">'web'</span>]</span><span class="punctuation">)</span><span class="punctuation">;</span> </code></pre>
                </div>
                <h3>Middleware per route</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Route</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">(</span><span class="string">'/profile'</span><span class="punctuation">,</span> <span class="punctuation">[</span><span class="class">ProfileController</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'index'</span><span class="punctuation">])</span><span class="operator">-></span><span class="method">middleware</span><span class="punctuation">(</span><span class="string">'auth'</span><span class="punctuation">);</span></code></pre>
                </div>
            </section>

            <!-- Validation -->
            <section id="validation" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1 class="section-title">Validation</h1>
                </div>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="php-variable">$rules</span> <span class="operator">=</span> <span class="punctuation">[</span>
    <span class="string">'email'</span> <span class="operator">=></span> <span class="string">'required|email|unique:users,email'</span><span class="punctuation">,</span>
    <span class="string">'password'</span> <span class="operator">=></span> <span class="string">'required|min:6|max:20'</span>
<span class="punctuation">];</span>

<span class="php-variable">$validation</span> <span class="operator">=</span> <span class="class">Validator</span><span class="operator">::</span><span class="method">validate</span><span class="punctuation">(</span><span class="php-variable">$request</span><span class="string">-></span><span class="method">all()</span><span class="punctuation">,</span> <span class="php-variable">$rules</span><span class="punctuation">);</span>

<span class="keyword">if</span> <span class="punctuation">(</span><span class="php-variable">$validation</span><span class="operator">-></span><span class="method">fails</span><span class="punctuation">())</span> <span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="function">redirect</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">back</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">withErrors</span><span class="punctuation">(</span><span class="php-variable">$validation</span><span class="operator">-></span><span class="method">errors</span><span class="punctuation">());</span>
<span class="punctuation">}</span></code></pre>
                </div>
            </section>

            <!-- Mail Support -->
            <section id="mail" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h1 class="section-title">Mail Support</h1>
                </div>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Mail</span><span class="operator">::</span><span class="method">send</span><span class="punctuation">(</span><span class="string">'mail'</span><span class="punctuation">,</span> <span class="punctuation">[],</span> <span class="keyword">function</span><span class="punctuation">(</span><span class="php-variable">$mail</span><span class="punctuation">)</span> <span class="punctuation">{</span>
    <span class="php-variable">$mail</span><span class="operator">-></span><span class="method">to</span><span class="punctuation">(</span><span class="string">'admin@example.com'</span><span class="punctuation">);</span>
    <span class="php-variable">$mail</span><span class="operator">-></span><span class="method">subject</span><span class="punctuation">(</span><span class="string">'Welcome'</span><span class="punctuation">);</span>
    <span class="php-variable">$mail</span><span class="operator">-></span><span class="method">from</span><span class="punctuation">(</span><span class="string">'noreply@example.com'</span><span class="punctuation">);</span>
    <span class="php-variable">$mail</span><span class="operator">-></span><span class="method">attachment</span><span class="punctuation">(</span><span class="string">'path/to/file.pdf'</span><span class="punctuation">);</span>
<span class="punctuation">});</span></code></pre>
                </div>
            </section>

            <!-- Migrations -->
            <section id="migrations" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h1 class="section-title">Migrations</h1>
                </div>

                <h3>Create a new migration file</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #4CAF50;"></div>
                            <span>Terminal</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:migration</span> <span class="bash-flag">create_users_table</span></code></pre>
                </div>

                <p>This will generate a file in the <code>database/migrations/</code> directory.</p>

                <h3>Define the schema</h3>
                <p>Each migration file contains <code>up()</code> and <code>down()</code> methods. You can define your table structure using the <code>Blueprint</code> class inside the <code>up()</code> method:</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Migrate</span><span class="operator">::</span><span class="method">create</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">,</span> <span class="keyword">function</span> <span class="punctuation">(</span><span class="class">Blueprint</span> <span class="php-variable">$table</span><span class="punctuation">)</span> <span class="punctuation">{</span>
    <span class="php-variable">$table</span><span class="operator">-></span><span class="method">increments</span><span class="punctuation">(</span><span class="string">'id'</span><span class="punctuation">);</span>
    <span class="php-variable">$table</span><span class="operator">-></span><span class="method">string</span><span class="punctuation">(</span><span class="string">'name'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">nullable</span><span class="punctuation">();</span>
    <span class="php-variable">$table</span><span class="operator">-></span><span class="method">string</span><span class="punctuation">(</span><span class="string">'email'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">unique</span><span class="punctuation">();</span>
    <span class="php-variable">$table</span><span class="operator">-></span><span class="method">string</span><span class="punctuation">(</span><span class="string">'password'</span><span class="punctuation">);</span>
    <span class="php-variable">$table</span><span class="operator">-></span><span class="method">timestamps</span><span class="punctuation">();</span>
<span class="punctuation">});</span></code></pre>
                </div>

                <h3>Rollback the table</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="class">Migrate</span><span class="operator">::</span><span class="method">dropIfExists</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">);</span></code></pre>
                </div>
            </section>

            <!-- Queries & ORM -->
            <section id="queries-orm" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h1 class="section-title">Queries & ORM</h1>
                </div>

                <p>Larite offers a Laravel-inspired ORM for interacting with your database using expressive and chainable syntax.</p>

                <h4>Fetching Data (ORM)</h4>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="comment">// Get all users</span>
<span class="php-variable">$users</span> <span class="operator">=</span> <span class="class">User</span><span class="operator">::</span><span class="method">get</span><span class="punctuation">();</span>

<span class="comment">// Find a specific user by ID</span>
<span class="php-variable">$user</span> <span class="operator">=</span> <span class="class">User</span><span class="operator">::</span><span class="method">find</span><span class="punctuation">(</span><span class="number">1</span><span class="punctuation">);</span>

<span class="comment">// Get users with conditions</span>
<span class="php-variable">$activeUsers</span> <span class="operator">=</span> <span class="class">User</span><span class="operator">::</span><span class="method">where</span><span class="punctuation">(</span><span class="string">'status'</span><span class="punctuation">,</span> <span class="string">'='</span><span class="punctuation">,</span> <span class="string">'active'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">get</span><span class="punctuation">();</span>

<span class="comment">// First matching result</span>
<span class="php-variable">$user</span> <span class="operator">=</span> <span class="class">User</span><span class="operator">::</span><span class="method">where</span><span class="punctuation">(</span><span class="string">'email'</span><span class="punctuation">,</span> <span class="string">'='</span><span class="punctuation">,</span> <span class="string">'john@example.com'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">first</span><span class="punctuation">();</span>

<span class="comment">// Create new user</span>
<span class="php-variable">$user</span> <span class="operator">=</span> <span class="class">User</span><span class="operator">::</span><span class="method">create</span><span class="punctuation">([</span>
    <span class="string">'name'</span> <span class="operator">=></span> <span class="string">'Kashif'</span><span class="punctuation">,</span>
    <span class="string">'email'</span> <span class="operator">=></span> <span class="string">'kashif@gmail.com'</span><span class="punctuation">,</span>
    <span class="string">'password'</span> <span class="operator">=></span> <span class="function">bcrypt</span><span class="punctuation">(</span><span class="string">'12345678'</span><span class="punctuation">),</span>
<span class="punctuation">]);</span></code></pre>
                </div>

                <h4>Query Builder (DB Facade)</h4>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">use</span> <span class="class">Core\Support\Facades\DB</span><span class="punctuation">;</span>

<span class="comment">// Get all users</span>
<span class="php-variable">$users</span> <span class="operator">=</span> <span class="class">DB</span><span class="operator">::</span><span class="method">table</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">get</span><span class="punctuation">();</span>

<span class="comment">// Paginate results</span>
<span class="php-variable">$users</span> <span class="operator">=</span> <span class="class">DB</span><span class="operator">::</span><span class="method">table</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">paginate</span><span class="punctuation">(</span><span class="number">10</span><span class="punctuation">);</span>

<span class="comment">// Get users with conditions</span>
<span class="php-variable">$activeUsers</span> <span class="operator">=</span> <span class="class">DB</span><span class="operator">::</span><span class="method">table</span><span class="punctuation">(</span><span class="string">'users'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">where</span><span class="punctuation">(</span><span class="string">'status'</span><span class="punctuation">,</span> <span class="string">'active'</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">get</span><span class="punctuation">();</span></code></pre>
                </div>
            </section>

            <!-- Relationships -->
            <section id="relationships" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <h1 class="section-title">Defining Relationships</h1>
                </div>

                <h3>One-to-One</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">profile</span><span class="punctuation">()</span>
<span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="php-variable">$this</span><span class="operator">-></span><span class="method">hasOne</span><span class="punctuation">(</span><span class="class">Profile</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'user_id'</span><span class="punctuation">);</span>
<span class="punctuation">}</span></code></pre>
                </div>

                <h3>One-to-Many</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">posts</span><span class="punctuation">()</span>
<span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="php-variable">$this</span><span class="operator">-></span><span class="method">hasMany</span><span class="punctuation">(</span><span class="class">Post</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'user_id'</span><span class="punctuation">);</span>
<span class="punctuation">}</span></code></pre>
                </div>

                <h3>Inverse (Belongs To)</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">user</span><span class="punctuation">()</span>
<span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="php-variable">$this</span><span class="operator">-></span><span class="method">belongsTo</span><span class="punctuation">(</span><span class="class">User</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span> <span class="string">'user_id'</span><span class="punctuation">);</span>
<span class="punctuation">}</span></code></pre>
                </div>

                <h3>Belongs To Many</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">roles</span><span class="punctuation">()</span>
<span class="punctuation">{</span>
    <span class="keyword">return</span> <span class="php-variable">$this</span><span class="operator">-></span><span class="method">belongsToMany</span><span class="punctuation">(</span><span class="class">Role</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">,</span>
        <span class="string">'role_user'</span><span class="punctuation">,</span> <span class="string">'user_id'</span><span class="punctuation">,</span>
        <span class="string">'role_id'</span><span class="punctuation">,</span> <span class="string">'id'</span><span class="punctuation">,</span>
        <span class="string">'id'</span><span class="punctuation">);</span>
<span class="punctuation">}</span></code></pre>
                </div>

                <div class="alert info">
                    <i class="fas fa-info-circle alert-icon"></i>
                    <div class="alert-content">
                        <strong>Note:</strong> Eager loading is supported and implemented.
                    </div>
                </div>
            </section>

            <!-- Database Seeding -->
            <section id="seeding" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h1 class="section-title">Database Seeding</h1>
                </div>

                <p>Larite supports Laravel-style seeders for populating your database with initial or dummy data.</p>

                <h3>Create a Seeder</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #4CAF50;"></div>
                            <span>Terminal</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:seeder</span> <span class="bash-flag">AdminSeeder</span></code></pre>
                </div>

                <h3>Example Seeder</h3>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">use</span> <span class="class">App\Models\User</span><span class="punctuation">;</span>

<span class="keyword">class</span> <span class="class">AdminSeeder</span> <span class="keyword">extends</span> <span class="class">Seeder</span>
<span class="punctuation">{</span>
    <span class="keyword">public</span> <span class="keyword">function</span> <span class="function">run</span><span class="punctuation">()</span><span class="operator">:</span> <span class="keyword">void</span>
    <span class="punctuation">{</span>
        <span class="class">User</span><span class="operator">::</span><span class="method">updateOrCreate</span><span class="punctuation">([</span>
            <span class="string">'email'</span> <span class="operator">=></span> <span class="string">'admin@example.com'</span><span class="punctuation">,</span>
        <span class="punctuation">],</span> <span class="punctuation">[</span>
            <span class="string">'name'</span> <span class="operator">=></span> <span class="string">'Admin'</span><span class="punctuation">,</span>
            <span class="string">'password'</span> <span class="operator">=></span> <span class="function">bcrypt</span><span class="punctuation">(</span><span class="string">'password'</span><span class="punctuation">),</span>
            <span class="string">'role'</span> <span class="operator">=></span> <span class="string">'admin'</span><span class="punctuation">,</span>
        <span class="punctuation">]);</span>
    <span class="punctuation">}</span>
<span class="punctuation">}</span></code></pre>
                </div>
            </section>

            <!-- CLI Commands -->
            <section id="commands" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-terminal"></i>
                    </div>
                    <h1 class="section-title">CLI Commands</h1>
                </div>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #4CAF50;"></div>
                            <span>Terminal</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:auth</span> <span class="bash-flag">auth</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:model</span> <span class="bash-flag">User</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:controller</span> <span class="bash-flag">PostController</span>
<span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">make:controller</span> <span class="bash-flag">PostController</span> <span class="bash-flag">--resource</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">make:migration</span> <span class="bash-flag">create_posts_table</span>
<span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">make:seeder</span> <span class="bash-flag">AdminSeeder</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">migration:migrate</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">migration:rollback</span>
<span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">make:middleware</span> <span class="bash-flag">Authenticate</span>
<span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">make:command</span> <span class="bash-flag">SyncUser</span>
<span class="bash-command">php</span> <span class="bash-flag">larite</span> <span class="bash-flag">schedule:run</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">route:list</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">route:list</span> <span class="bash-flag">--method=GET</span>
<span class="bash-command">php</span> <span class="bash-flag">Larite</span> <span class="bash-flag">route:list</span> <span class="bash-flag">--method=POST</span></code></pre>
                </div>
            </section>

            <!-- Task Scheduler -->
            <section id="scheduler" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h1 class="section-title">Task Scheduler</h1>
                </div>

                <p>Larite supports a simple scheduler inspired by Laravel.</p>

                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="keyword">public</span> <span class="keyword">function</span> <span class="function">schedule</span><span class="punctuation">(</span><span class="class">Schedule</span> <span class="php-variable">$schedule</span><span class="punctuation">)</span><span class="operator">:</span> <span class="keyword">void</span>
<span class="punctuation">{</span>
    <span class="php-variable">$schedule</span><span class="operator">-></span><span class="method">command</span><span class="punctuation">(</span><span class="class">SyncUser</span><span class="operator">::</span><span class="keyword">class</span><span class="punctuation">)</span><span class="operator">-></span><span class="method">everyMinute</span><span class="punctuation">();</span>
<span class="punctuation">}</span></code></pre>
                </div>

                <h3>Supported Schedule Methods</h3>
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Method</th>
                            <th>Cron Expression</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><code>everyMinute()</code></td>
                            <td><code>* * * * *</code></td>
                            <td>Every minute</td>
                        </tr>
                        <tr>
                            <td><code>everyFiveMinutes()</code></td>
                            <td><code>*/5 * * * *</code></td>
                            <td>Every 5 minutes</td>
                        </tr>
                        <tr>
                            <td><code>hourly()</code></td>
                            <td><code>0 * * * *</code></td>
                            <td>Once per hour</td>
                        </tr>
                        <tr>
                            <td><code>daily()</code></td>
                            <td><code>0 0 * * *</code></td>
                            <td>Once a day at midnight</td>
                        </tr>
                        <tr>
                            <td><code>weekly()</code></td>
                            <td><code>0 0 * * 0</code></td>
                            <td>Once a week (Sunday midnight)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Exception Handling -->
            <section id="exceptions" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h1 class="section-title">Exception Handling</h1>
                </div>

                <p>Your global exception handling logic is located at:</p>
                <div class="code-container">
                    <div class="code-header">
                        <div class="code-language">
                            <div class="code-language-icon" style="background: #777BB4;"></div>
                            <span>PHP</span>
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard(this)">
                            <i class="fas fa-copy"></i>
                            Copy
                        </button>
                    </div>
                    <pre class="code-block"><code><span class="comment">// app/Exceptions/Handler.php</span>
<span class="keyword">protected</span> <span class="keyword">bool</span> <span class="php-variable">$exception</span> <span class="operator">=</span> <span class="keyword">true</span><span class="punctuation">;</span> <span class="comment">// true, false</span>

<span class="keyword">public</span> <span class="keyword">function</span> <span class="function">handle</span><span class="punctuation">(</span><span class="class">Throwable</span> <span class="php-variable">$e</span><span class="punctuation">)</span>
<span class="punctuation">{</span>
    <span class="php-variable">$this</span><span class="operator">-></span><span class="method">render</span><span class="punctuation">(</span><span class="php-variable">$e</span><span class="punctuation">,</span> <span class="keyword">function</span> <span class="punctuation">(</span><span class="class">Throwable</span> <span class="php-variable">$e</span><span class="punctuation">)</span> <span class="punctuation">{</span>
        <span class="keyword">if</span> <span class="punctuation">(</span><span class="php-variable">$e</span> <span class="keyword">instanceof</span> <span class="class">NotFoundException</span><span class="punctuation">)</span> <span class="punctuation">{</span>
            <span class="function">response</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">json</span><span class="punctuation">([</span><span class="string">'NotFoundException'</span> <span class="operator">=></span> <span class="php-variable">$e</span><span class="operator">-></span><span class="method">getMessage</span><span class="punctuation">()],</span> <span class="number">404</span><span class="punctuation">);</span>
        <span class="punctuation">}</span> <span class="keyword">elseif</span> <span class="punctuation">(</span><span class="php-variable">$e</span> <span class="keyword">instanceof</span> <span class="class">ValidationException</span><span class="punctuation">)</span> <span class="punctuation">{</span>
            <span class="function">response</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">json</span><span class="punctuation">([</span><span class="string">'ValidationException'</span> <span class="operator">=></span> <span class="php-variable">$e</span><span class="operator">-></span><span class="method">getErrors</span><span class="punctuation">()],</span> <span class="number">422</span><span class="punctuation">);</span>
        <span class="punctuation">}</span> <span class="keyword">elseif</span> <span class="punctuation">(</span><span class="php-variable">$e</span> <span class="keyword">instanceof</span> <span class="class">AuthException</span><span class="punctuation">)</span> <span class="punctuation">{</span>
            <span class="function">response</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">json</span><span class="punctuation">(</span><span class="string">'Unauthenticated.'</span><span class="punctuation">,</span> <span class="number">401</span><span class="punctuation">);</span>
        <span class="punctuation">}</span> <span class="keyword">else</span> <span class="punctuation">{</span>
            <span class="function">response</span><span class="punctuation">()</span><span class="operator">-></span><span class="method">json</span><span class="punctuation">([</span><span class="string">'Exception'</span> <span class="operator">=></span> <span class="string">'Something went wrong.'</span><span class="punctuation">],</span> <span class="number">500</span><span class="punctuation">);</span>
        <span class="punctuation">}</span>
    <span class="punctuation">});</span>
    <span class="keyword">return</span> <span class="keyword">true</span><span class="punctuation">;</span>
<span class="punctuation">}</span></code></pre>
                </div>
            </section>

            <!-- Welcome Page -->
            <section id="welcome" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h1 class="section-title">Larite Welcome Page</h1>
                </div>

                <p>Here is the Larite welcome page view.</p>
                <img class="content-image" src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite.png" alt="Larite Welcome Page">
            </section>

            <!-- ChatGPT Comparison -->
            <section id="comparison" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h1 class="section-title">ChatGPT Review</h1>
                </div>

                <p>Here is the ChatGPT comparison after reviewing the complete Larite's code.</p>
                <img class="content-image" src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite-Review-ChatGpt.png" alt="ChatGPT Review">
            </section>

            <!-- Contribute -->
            <section id="contribute" class="content-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h1 class="section-title">Contribute</h1>
                </div>

                <p>Want to improve this Laravel-style lightweight framework? Submit a PR or open an issue. All contributions are welcome!</p>

                <div class="alert success">
                    <i class="fas fa-code-branch alert-icon"></i>
                    <div class="alert-content">
                        <strong>Open Source:</strong> Larite is open-source and licensed under the MIT license.
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <div class="hero-features" style="justify-content: center;">
                        <div class="badge primary">
                            <i class="fas fa-code"></i>
                            PHP 8+
                        </div>
                        <div class="badge success">
                            <i class="fas fa-rocket"></i>
                            MVC Architecture
                        </div>
                        <div class="badge info">
                            <i class="fas fa-heart"></i>
                            Laravel-Style
                        </div>
                        <div class="badge warning">
                            <i class="fas fa-shield-alt"></i>
                            Secure
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- Table of Contents with Hide Option -->
<div class="toc" id="toc">
    <div class="toc-header">
        <div class="toc-title">On This Page</div>
        <button class="toc-hide-btn" id="tocHideBtn" title="Hide Table of Contents">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <a href="#introduction" class="toc-item">Introduction</a>
    <a href="#installation" class="toc-item">Installation</a>
    <a href="#routing" class="toc-item">Routing</a>
    <a href="#middleware" class="toc-item">Middleware</a>
    <a href="#validation" class="toc-item">Validation</a>
    <a href="#migrations" class="toc-item">Migrations</a>
    <a href="#seeding" class="toc-item">Database Seeding</a>
    <a href="#queries-orm" class="toc-item">Queries &amp; ORM</a>
    <a href="#commands" class="toc-item">CLI Commands</a>
    <a href="#contribute" class="toc-item">Contribute</a>
</div>

<!-- TOC Show Button -->
<button class="toc-show-btn" id="tocShowBtn" title="Show Table of Contents">
    <i class="fas fa-list"></i>
</button>

<!-- Floating Action Button -->
<button class="fab" id="scrollTop">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    $(document).ready(function() {
        // Theme toggle
        const $themeToggle = $('#themeToggle');
        const $html = $('html');

        function setTheme(theme) {
            $html.attr('data-theme', theme);
            localStorage.setItem('theme', theme);
            $themeToggle.find('i').removeClass().addClass(theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon');
        }

        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        $themeToggle.click(() => {
            const newTheme = $html.attr('data-theme') === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });

        // Header scroll effect
        $(window).scroll(function() {
            const scrollTop = $(this).scrollTop();
            if (scrollTop > 50) {
                $('#header').addClass('scrolled');
            } else {
                $('#header').removeClass('scrolled');
            }
        });

        // Mobile menu
        $('#mobileMenuBtn').click(() => {
            $('#sidebar').toggleClass('mobile-visible');
        });

        // Navigation sections
        $('.nav-section-title').click(function() {
            const $items = $(this).siblings('.nav-items');
            const $arrow = $(this).find('.nav-arrow');

            $items.toggleClass('expanded');
            $arrow.toggleClass('rotated');
        });

        // Smooth scrolling
        $('.nav-item, .toc-item, .btn[href^="#"]').click(function(e) {
            e.preventDefault();
            const target = $(this).attr('href');
            const $target = $(target);

            if ($target.length) {
                $('html, body').animate({
                    scrollTop: $target.offset().top - 80
                }, 800, 'easeInOutCubic');

                $('.nav-item, .toc-item').removeClass('active');
                $(this).addClass('active');

                if (window.innerWidth <= 768) {
                    $('#sidebar').removeClass('mobile-visible');
                }
            }
        });

        // TOC Hide/Show functionality
        const $toc = $('#toc');
        const $tocHideBtn = $('#tocHideBtn');
        const $tocShowBtn = $('#tocShowBtn');

        // Check if TOC was previously hidden
        const tocHidden = localStorage.getItem('tocHidden') === 'true';
        if (tocHidden) {
            $toc.addClass('hidden');
            $tocShowBtn.show();
        }

        $tocHideBtn.click(() => {
            $toc.addClass('hidden');
            $tocShowBtn.fadeIn();
            localStorage.setItem('tocHidden', 'true');
        });

        $tocShowBtn.click(() => {
            $toc.removeClass('hidden');
            $tocShowBtn.fadeOut();
            localStorage.setItem('tocHidden', 'false');
        });

        // Search functionality
        let searchTimeout;
        $('#searchInput').on('input', function() {
            const query = $(this).val().toLowerCase();

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (query.length > 2) {
                    performSearch(query);
                } else {
                    $('#searchResults').hide();
                }
            }, 300);
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.search-container').length) {
                $('#searchResults').hide();
            }
        });

        // Scroll effects
        $(window).scroll(function() {
            const scrollTop = $(this).scrollTop();
            const docHeight = $(document).height();
            const winHeight = $(this).height();
            const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;

            $('#progressBar').css('width', scrollPercent + '%');

            // Show/hide FAB
            if (scrollTop > 600) {
                $('#scrollTop').fadeIn();
            } else {
                $('#scrollTop').fadeOut();
            }

            // Show/hide TOC
            if (scrollTop > 800 && window.innerWidth > 1400 && !$toc.hasClass('hidden')) {
                $('#toc').fadeIn();
            } else if (scrollTop > 800 && window.innerWidth > 1400 && $toc.hasClass('hidden')) {
                $('#tocShowBtn').fadeIn();
            } else {
                $('#toc').fadeOut();
                $('#tocShowBtn').fadeOut();
            }

            // Update active navigation
            updateActiveNavigation();
        });

        $('#scrollTop').click(() => {
            $('html, body').animate({scrollTop: 0}, 800);
        });

        // Initialize
        $('.nav-section:first-child .nav-section-title').click();

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, { threshold: 0.1 });

        $('.content-section').each(function() {
            observer.observe(this);
        });

        function updateActiveNavigation() {
            let current = '';
            $('.content-section').each(function() {
                const sectionTop = $(this).offset().top - 120;
                if ($(window).scrollTop() >= sectionTop) {
                    current = $(this).attr('id');
                }
            });

            $('.nav-item, .toc-item').removeClass('active');
            if (current) {
                $(`.nav-item[href="#${current}"], .toc-item[href="#${current}"]`).addClass('active');
            }
        }

        // Add loading states
        $('.code-container').each(function() {
            $(this).addClass('loading');
            setTimeout(() => {
                $(this).removeClass('loading');
            }, Math.random() * 300 + 100);
        });
    });

    // Enhanced search function
    function performSearch(query) {
        const searchableContent = [
            { title: 'Introduction', section: 'introduction', content: 'larite php mvc framework laravel inspired lightweight', icon: 'fas fa-book' },
            { title: 'Why Choose Larite?', section: 'why-larite', content: 'laravel style routing middleware validation', icon: 'fas fa-star' },
            { title: 'Security Features', section: 'security', content: 'csrf protection output escaping file upload validation', icon: 'fas fa-shield-alt' },
            { title: 'Core Features', section: 'features', content: 'auth scaffolding pagination flash messages', icon: 'fas fa-gem' },
            { title: 'Installation', section: 'installation', content: 'composer install php setup', icon: 'fas fa-download' },
            { title: 'Environment Setup', section: 'environment', content: 'env configuration database setup', icon: 'fas fa-cog' },
            { title: 'Basic Routing', section: 'routing', content: 'routes web php get post middleware groups', icon: 'fas fa-route' },
            { title: 'Named Routes', section: 'named-routes', content: 'named routes url generation route helper', icon: 'fas fa-tag' },
            { title: 'Resource Routes', section: 'resource-routes', content: 'resource controller crud operations', icon: 'fas fa-layer-group' },
            { title: 'Route Parameters', section: 'route-parameters', content: 'route parameters required optional', icon: 'fas fa-code' },
            { title: 'Middleware System', section: 'middleware', content: 'middleware authentication web filters', icon: 'fas fa-shield-alt' },
            { title: 'Validation', section: 'validation', content: 'validation rules required email unique', icon: 'fas fa-check-circle' },
            { title: 'Mail Support', section: 'mail', content: 'mail send email smtp attachments', icon: 'fas fa-envelope' },
            { title: 'Migrations', section: 'migrations', content: 'database migrations schema blueprint', icon: 'fas fa-exchange-alt' },
            { title: 'Queries & ORM', section: 'queries-orm', content: 'eloquent orm database queries builder', icon: 'fas fa-search' },
            { title: 'Relationships', section: 'relationships', content: 'hasone hasmany belongsto relationships', icon: 'fas fa-link' },
            { title: 'Database Seeding', section: 'seeding', content: 'seeders database populate data', icon: 'fas fa-seedling' },
            { title: 'CLI Commands', section: 'commands', content: 'artisan commands make model controller migration', icon: 'fas fa-terminal' },
            { title: 'Task Scheduler', section: 'scheduler', content: 'cron scheduler tasks commands schedule', icon: 'fas fa-clock' },
            { title: 'Exception Handling', section: 'exceptions', content: 'exceptions error handling custom handlers', icon: 'fas fa-exclamation-triangle' },
            { title: 'Welcome Page', section: 'welcome', content: 'larite welcome page screenshot', icon: 'fas fa-home' },
            { title: 'ChatGPT Review', section: 'comparison', content: 'chatgpt review comparison analysis', icon: 'fas fa-brain' },
            { title: 'Contribute', section: 'contribute', content: 'contribute open source github pull request', icon: 'fas fa-heart' }
        ];

        const results = searchableContent.filter(item =>
            item.title.toLowerCase().includes(query) ||
            item.content.toLowerCase().includes(query)
        );

        const resultsHtml = results.map(result =>
            `<div class="search-result" onclick="navigateToSection('${result.section}')">
                    <i class="${result.icon} search-result-icon"></i>
                    <span>${result.title}</span>
                </div>`
        ).join('');

        if (results.length > 0) {
            $('#searchResults').html(resultsHtml).show();
        } else {
            $('#searchResults').html('<div class="search-result"><i class="fas fa-search search-result-icon"></i><span>No results found</span></div>').show();
        }
    }

    function navigateToSection(sectionId) {
        const $target = $(`#${sectionId}`);
        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 80
            }, 800);

            $('.nav-item, .toc-item').removeClass('active');
            $(`.nav-item[href="#${sectionId}"], .toc-item[href="#${sectionId}"]`).addClass('active');
        }
        $('#searchResults').hide();
        $('#searchInput').val('');
    }

    // Enhanced copy to clipboard with better feedback
    function copyToClipboard(button) {
        const $button = $(button);
        const codeText = $button.closest('.code-container').find('.code-block code').text();

        navigator.clipboard.writeText(codeText).then(() => {
            const originalHtml = $button.html();
            $button.html('<i class="fas fa-check"></i> Copied!').addClass('pulse');

            setTimeout(() => {
                $button.html(originalHtml).removeClass('pulse');
            }, 2000);
        }).catch(() => {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = codeText;
            textArea.style.position = 'fixed';
            textArea.style.opacity = '0';
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            const originalHtml = $button.html();
            $button.html('<i class="fas fa-check"></i> Copied!').addClass('pulse');

            setTimeout(() => {
                $button.html(originalHtml).removeClass('pulse');
            }, 2000);
        });
    }

    // Custom easing functions
    $.easing.easeInOutCubic = function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    };

    // Add some interactive effects
    $('.content-section').hover(
        function() {
            $(this).find('.section-icon').addClass('pulse');
        },
        function() {
            $(this).find('.section-icon').removeClass('pulse');
        }
    );

    // Keyboard shortcuts
    $(document).keydown(function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 75) {
            e.preventDefault();
            $('#searchInput').focus();
        }

        // Escape to close search results
        if (e.keyCode === 27) {
            $('#searchResults').hide();
            $('#searchInput').blur();
        }

        // Ctrl/Cmd + H to toggle TOC
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 72) {
            e.preventDefault();
            if ($('#toc').hasClass('hidden')) {
                $('#tocShowBtn').click();
            } else {
                $('#tocHideBtn').click();
            }
        }
    });
</script>
</body>
</html>