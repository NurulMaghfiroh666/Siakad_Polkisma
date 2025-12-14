<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD POLKISMA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #10243e;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: transparent;
            color: white;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding-top: 30px;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            padding: 0 30px 40px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: white;
            text-decoration: none;
        }

        .brand-icon {
            width: 35px;
            height: 35px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .brand-icon svg {
            width: 100%;
            height: 100%;
            stroke: #64748b;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
            padding-right: 20px;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 30px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.05);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.1) 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .nav-icon {
            margin-right: 15px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Content wrapper */
        .main-wrapper {
            flex: 1;
            margin-left: 250px;
            background: #e5e7eb;
            min-height: 100vh;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            position: relative;
            padding: 30px 40px;
            box-sizing: border-box;
            box-shadow: -5px 0 20px rgba(0,0,0,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-wrapper {
                margin-left: 0;
                border-radius: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            </div>
            POLKISMA
        </a>
        
        <ul class="nav-menu">
            @yield('sidebar-menu')
        </ul>
        
        <!-- Logout -->
        <div style="padding: 20px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; cursor: pointer; color: #cbd5e1; padding-left: 0;">
                    <span class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    </span> 
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-wrapper">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
