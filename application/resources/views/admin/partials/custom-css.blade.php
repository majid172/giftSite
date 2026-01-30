<style>
    /* 
     * Custom Admin Panel Design
     * Theme: Modern, Glassmorphism, Premium
     */

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4F46E5; /* Indigo 600 */
        --primary-hover: #4338CA; /* Indigo 700 */
        --secondary: #64748B; /* Slate 500 */
        --success: #10B981; /* Emerald 500 */
        --danger: #EF4444; /* Red 500 */
        --warning: #F59E0B; /* Amber 500 */
        --info: #3B82F6; /* Blue 500 */
        
        --bg-body: #F1F5F9; /* Slate 100 */
        --bg-card: #FFFFFF;
        --text-main: #1E293B; /* Slate 800 */
        --text-muted: #64748B;
        --border-color: #E2E8F0; /* Slate 200 */
        
        --sidebar-width: 260px;
        --header-height: 70px;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --radius: 0.5rem;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-body);
        color: var(--text-main);
        line-height: 1.5;
        overflow-x: hidden;
    }

    /* Layout Structure */
    .app-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .app-sidebar {
        width: var(--sidebar-width);
        background-color: var(--bg-card);
        border-right: 1px solid var(--border-color);
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 50;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
    }

    .sidebar-header {
        height: var(--header-height);
        display: flex;
        align-items: center;
        padding: 0 24px;
        border-bottom: 1px solid var(--border-color);
    }

    .brand-logo {
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 24px 0;
    }

    .nav-label {
        padding: 0 24px;
        margin-bottom: 8px;
        margin-top: 24px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        font-weight: 600;
    }
    .nav-label:first-child {
        margin-top: 0;
    }

    .nav-item {
        display: block;
        padding: 10px 24px;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .nav-item:hover, .nav-item.active {
        color: var(--primary);
        background-color: #EEF2FF; /* Indigo 50 */
        border-right: 3px solid var(--primary);
    }

    .nav-item i {
        font-size: 1.25rem;
    }

    /* Main Content Area */
    .app-main {
        flex: 1;
        margin-left: var(--sidebar-width);
        display: flex;
        flex-direction: column;
        min-width: 0; /* Prevent overflow */
    }

    /* Header */
    .app-header {
        height: var(--header-height);
        background-color: var(--bg-card); /* Glassmorphism effect can be added here */
        border-bottom: 1px solid var(--border-color);
        padding: 0 30px;
        display: flex;
        align-items: center;
        /* justify-content: space-between; removed in favor of flex-grow on left */
        position: sticky;
        top: 0;
        z-index: 40;
    }

    .header-left {
        flex: 1; /* Pushes header-right to the end */
    }

    .header-left h1 {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .user-profile-dropdown {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    /* Content Body */
    .app-content {
        padding: 30px;
        flex: 1;
    }

    /* Card Component */
    .card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 24px;
        margin-bottom: 24px;
    }

    .card-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-weight: 500;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s;
        text-decoration: none;
        gap: 8px;
        font-size: 0.875rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
    }

    .btn-outline {
        background-color: transparent;
        border-color: var(--border-color);
        color: var(--text-main);
    }
    .btn-outline:hover {
        background-color: var(--bg-body);
    }

    /* Forms */
    .form-control {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: var(--radius);
        background-color: #F8FAFC;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        background-color: white;
    }
    
    label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-main);
    }

    /* Tables */
    .table-responsive {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }
    .table th, .table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    .table th {
        background-color: #F8FAFC;
        font-weight: 600;
        color: var(--text-muted);
    }
    .table tr:last-child td {
        border-bottom: none;
    }

    /* Utilities */
    .text-sm { font-size: 0.875rem; }
    .text-muted { color: var(--text-muted); }
    .mb-4 { margin-bottom: 1rem; }
    .flex { display: flex; }
    .gap-4 { gap: 1rem; }
    .items-center { align-items: center; }
    .justify-between { justify-content: space-between; }

    /* Responsive Sidebar */
    @media (max-width: 1024px) {
        .app-sidebar {
            transform: translateX(-100%);
            box-shadow: none;
        }
        .app-main {
            margin-left: 0;
        }
        .sidebar-open .app-sidebar {
            transform: translateX(0);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        
        /* Backdrop */
        .sidebar-backdrop {
             position: fixed;
             top: 0;
             left: 0;
             width: 100vw;
             height: 100vh;
             background: rgba(0,0,0,0.5);
             z-index: 45; /* Below sidebar (50) but above header (40) if needed, or higher */
             display: none;
        }
        .sidebar-open .sidebar-backdrop {
            display: block;
        }
    }
</style>

<style>
    /* Icon Standardization */
    .ti {
        font-size: 1.25rem;
        vertical-align: text-bottom;
        stroke-width: 1.5;
    }
    .btn .ti {
        vertical-align: middle;
        margin-right: 4px;
        font-size: 1.1rem;
    }
    .btn-icon .ti {
        margin-right: 0;
    }
    
    /* Navigation Icons */
    .nav-item .ti {
        margin-right: 8px;
        color: inherit;
    }
    
    /* Ensure no conflicts with old classes */
    [class^="icon-"], [class*=" icon-"] {
        display: none !important;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1;
    }
    .badge-success { background-color: #ECFDF5; color: #047857; }
    .badge-warning { background-color: #FFFBEB; color: #B45309; }
    .badge-danger { background-color: #FEF2F2; color: #B91C1C; }
    .badge-info { background-color: #EFF6FF; color: #1D4ED8; }
    .badge-secondary { background-color: #F1F5F9; color: #475569; }
</style>
