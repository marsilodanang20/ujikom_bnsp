<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Pendaftaran Kursus - Kelola data peserta, jurusan, dan pendaftaran kursus dengan mudah">
    <title>@yield('title', 'Sistem Pendaftaran Kursus')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ===== CSS RESET & VARIABLES ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-primary: #FFFFFF;
            --bg-secondary: #F8FAFC;
            --bg-card: #FFFFFF;
            --bg-card-hover: #F1F5F9;
            --bg-input: #F8FAFC;
            --border-color: #E2E8F0;
            --border-active: #2563EB;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --text-muted: #94A3B8;
            --accent-primary: #2563EB;
            --accent-secondary: #1D4ED8;
            --success: #059669;
            --success-bg: #ECFDF5;
            --danger: #DC2626;
            --danger-bg: #FEF2F2;
            --warning: #D97706;
            --warning-bg: #FFFBEB;
            --info: #2563EB;
            --info-bg: #EFF6FF;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 14px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-glow: 0 0 30px rgba(37, 99, 235, 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ===== BACKGROUND EFFECTS ===== */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #F8FAFC;
            z-index: 0;
            pointer-events: none;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 270px;
            height: 100vh;
            background: #FFFFFF;
            border-right: 1px solid var(--border-color);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.04);
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand h1 {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--accent-primary);
            letter-spacing: -0.02em;
        }

        .sidebar-brand p {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .sidebar-nav .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            padding: 8px 16px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-size: 0.88rem;
            font-weight: 500;
            transition: var(--transition);
            margin-bottom: 2px;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(37, 99, 235, 0.06);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: rgba(37, 99, 235, 0.08);
            color: var(--accent-primary);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--accent-primary);
            border-radius: 0 4px 4px 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border-color);
            font-size: 0.7rem;
            color: var(--text-muted);
            text-align: center;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 270px;
            padding: 32px 40px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            margin-bottom: 32px;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .page-header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        /* ===== STAT CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-primary);
            opacity: 0;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: var(--border-active);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 16px;
        }

        .stat-card .stat-icon.purple { background: #EFF6FF; color: var(--accent-primary); }
        .stat-card .stat-icon.green { background: var(--success-bg); color: var(--success); }
        .stat-card .stat-icon.blue { background: var(--info-bg); color: var(--info); }
        .stat-card .stat-icon.yellow { background: var(--warning-bg); color: var(--warning); }

        .stat-card .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-card .stat-label {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-top: 4px;
            font-weight: 500;
        }

        /* ===== TABLE ===== */
        .table-container {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-header h3 {
            font-size: 1rem;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 14px 20px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
            color: var(--text-muted);
            background: #F8FAFC;
            border-bottom: 1px solid var(--border-color);
        }

        tbody td {
            padding: 14px 20px;
            font-size: 0.88rem;
            border-bottom: 1px solid #F1F5F9;
            color: var(--text-secondary);
        }

        tbody tr {
            transition: var(--transition);
        }

        tbody tr:hover {
            background: #F8FAFC;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .table-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border-color);
        }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            font-family: inherit;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--accent-primary);
            color: white;
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-success {
            background: var(--success);
            color: white;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
        }

        .btn-warning {
            background: var(--warning);
            color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(217, 119, 6, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-outline:hover {
            border-color: var(--accent-primary);
            color: var(--accent-primary);
            background: #EFF6FF;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.78rem;
        }

        .btn-icon {
            padding: 8px;
            width: 34px;
            height: 34px;
            justify-content: center;
        }

        .btn-group {
            display: flex;
            gap: 6px;
        }

        /* ===== FORMS ===== */
        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 32px;
            max-width: 640px;
            box-shadow: var(--shadow-sm);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 11px 16px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-size: 0.88rem;
            font-family: inherit;
            transition: var(--transition);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.78rem;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* ===== SEARCH ===== */
        .search-box {
            display: flex;
            align-items: center;
            gap: 0;
            max-width: 320px;
        }

        .search-box input {
            flex: 1;
            padding: 10px 16px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            color: var(--text-primary);
            font-size: 0.85rem;
            font-family: inherit;
            outline: none;
            transition: var(--transition);
        }

        .search-box input:focus {
            border-color: var(--accent-primary);
        }

        .search-box button {
            padding: 10px 16px;
            background: var(--accent-primary);
            color: white;
            border: 1px solid var(--accent-primary);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .search-box button:hover {
            background: var(--accent-secondary);
            border-color: var(--accent-secondary);
        }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .badge-aktif {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid #A7F3D0;
        }

        .badge-selesai {
            background: var(--info-bg);
            color: var(--info);
            border: 1px solid #BFDBFE;
        }

        .badge-batal {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid #FECACA;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid #A7F3D0;
        }

        .alert-danger {
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid #FECACA;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .pagination li a,
        .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: var(--radius-sm);
            font-size: 0.82rem;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .pagination li a {
            color: var(--text-secondary);
            border-color: var(--border-color);
        }

        .pagination li a:hover {
            border-color: var(--accent-primary);
            color: var(--accent-primary);
            background: #EFF6FF;
        }

        .pagination li.active span {
            background: var(--accent-primary);
            color: white;
        }

        .pagination li.disabled span {
            color: var(--text-muted);
            cursor: not-allowed;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 28px;
            width: 90%;
            max-width: 420px;
            animation: modalIn 0.3s ease;
        }

        .modal h3 {
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        .modal p {
            color: var(--text-secondary);
            font-size: 0.88rem;
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* ===== RESPONSIVE ===== */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 200;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            font-size: 1.1rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: flex;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: var(--shadow-lg);
            }

            .main-content {
                margin-left: 0;
                padding: 80px 16px 24px;
            }

            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }

            .page-header-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-card {
                padding: 20px;
            }
        }

        /* ===== STATUS SELECT (inline) ===== */
        .status-select {
            padding: 4px 8px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-size: 0.78rem;
            font-family: inherit;
            cursor: pointer;
            outline: none;
            transition: var(--transition);
        }

        .status-select:focus {
            border-color: var(--accent-primary);
        }

        /* ===== RUPIAH FORMAT ===== */
        .text-money {
            font-variant-numeric: tabular-nums;
            font-weight: 600;
            color: var(--success);
        }

        /* ===== HELPER UTILITIES ===== */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-600 { font-weight: 600; }
        .text-white { color: var(--text-primary); }
        .mt-2 { margin-top: 8px; }
        .mb-0 { margin-bottom: 0; }
    </style>
</head>
<body>
    <!-- Mobile Toggle -->
    <button class="mobile-toggle" onclick="toggleSidebar()" id="mobile-toggle-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h1><i class="fas fa-graduation-cap"></i> CRUD KURSUS</h1>
            <p>Sistem Pendaftaran Kursus</p>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}" id="nav-home">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="{{ route('peserta.index') }}" class="nav-item {{ request()->routeIs('peserta.*') ? 'active' : '' }}" id="nav-peserta">
                <i class="fas fa-users"></i> Data Peserta
            </a>
            <a href="{{ route('jurusan.index') }}" class="nav-item {{ request()->routeIs('jurusan.*') ? 'active' : '' }}" id="nav-jurusan">
                <i class="fas fa-book-open"></i> Data Jurusan
            </a>
            <a href="{{ route('pendaftaran.index') }}" class="nav-item {{ request()->routeIs('pendaftaran.*') ? 'active' : '' }}" id="nav-pendaftaran">
                <i class="fas fa-file-signature"></i> Pendaftaran
            </a>
        </nav>
        <div class="sidebar-footer">
            &copy; {{ date('Y') }} MARSILO DANANG W
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success" id="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" id="alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Delete confirmation modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <h3><i class="fas fa-exclamation-triangle" style="color: var(--danger);"></i> Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button class="btn btn-outline" onclick="closeDeleteModal()" id="cancel-delete-btn">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="confirm-delete-btn">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 300);
            });
        }, 4000);

        // Sidebar toggle for mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('mobile-toggle-btn');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Delete modal
        function confirmDelete(url) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        // Close modal on overlay click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Rupiah formatter
        function formatRupiah(num) {
            return 'Rp ' + parseInt(num).toLocaleString('id-ID');
        }
    </script>

    @yield('scripts')
</body>
</html>
