<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD POLKISMA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #10243e; /* Dark Navy from image */
            --content-bg: #e5e7eb; /* Light Gray for main content */
            --active-blue: #1c3a63; /* Slightly lighter navy for active states */
            --accent-blue: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #9ca3af;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: transparent; /* Sidebar is part of the main dark bg */
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
            /* Placeholder for the globe logo */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b5563; /* Greyish for the logo lines if svg */
        }
        
        .brand-icon svg {
            width: 100%;
            height: 100%;
            stroke: #475569; /* Muted blue-grey */
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
            padding-right: 20px; /* Space for the curved active background */
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
            margin-right: 0; /* Align to right edge of sidebar area */
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link.active {
            background-color: var(--active-blue); 
            /* Or simply a slightly lighter blue background for the item */
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
            margin-left: var(--sidebar-width);
            background: var(--content-bg); /* The light gray container */
            min-height: 100vh;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            /* In image it looks like top and bottom might be full height but let's do corners */
            position: relative;
            padding: 30px 40px;
            box-sizing: border-box;
            box-shadow: -5px 0 20px rgba(0,0,0,0.1);
            margin-top: 10px; /* Small gap top */
            margin-bottom: 10px; /* Srall gap bottom if desired, or 0 */
            margin-right: 10px; /* Gap right? Image shows full width right?? No, usually dashboards are full width. 
                                   But the image cuts off. Assuming full width right. */
            margin-top: 0; margin-bottom: 0; margin-right: 0;
            border-bottom-left-radius: 30px;
            border-top-left-radius: 30px;
            /* To match the 'floating' look, maybe the body background is seen at top/bottom/left?
               The image sidebar is full height.
               The content area seems to start full height or close to it.
            */
        }
        
        /* Adjust wrapper for the specific design: 
           It looks like a single large card. 
        */

    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="brand">
            <div class="brand-icon">
                <!-- Simple Globe Icon -->
                <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            </div>
            POLKISMA
        </a>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('dosen.dashboard') }}" class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <!-- Grid Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </span> 
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Presentation/Board Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h20"></path><path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"></path><path d="M10 16l2 5 2-5"></path></svg>
                    </span> 
                    Jadwal Mengajar
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Table/Rows Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/></svg>
                    </span> 
                    Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Book Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </span> 
                    Input Nilai
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Layers/Stack Icon -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    </span> 
                    Mata Kuliah
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Grad Cap -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                    </span> 
                    Akademik
                </a>
            </li>
             <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon">
                        <!-- Message Bubble -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </span> 
                    Pesan
                </a>
            </li>
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
