<style>
    /* Kartly Global Admin Styles */
    .kartly-settings-container {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }
    .kartly-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-body {
        padding: 24px;
    }
    
    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
        color: #475569;
    }
    .form-control {
        width: 100%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 10px 16px;
        color: #334155;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        background: #ffffff;
        border-color: #cbd5e1;
    }
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Buttons */
    .save-btn {
        background: #1e40af;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .save-btn:hover {
        background: #1e3a8a;
    }
    .back-btn {
        padding: 8px 16px;
        background: transparent;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .back-btn:hover {
        background: #f8fafc;
        color: #475569;
    }
    .create-btn {
        background: #1e40af;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .create-btn:hover {
        background: #1e3a8a;
    }
    .action-btn {
        padding: 6px;
        border-radius: 4px;
        color: #64748b;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .action-btn:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .action-btn.delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    /* Image Upload & Preview */
    .image-preview-box {
        width: 100%;
        min-height: 200px;
        border: 2px dashed #cbd5e1;
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #f8fafc;
        overflow: hidden;
        position: relative;
        transition: all 0.2s;
    }
    .image-preview-box:hover {
        border-color: #94a3b8;
        background: #f1f5f9;
    }
    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }
    .upload-placeholder {
        text-align: center;
        padding: 20px;
    }
    
    /* Tables */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-table th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        padding: 12px 24px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    .custom-table td {
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
    }
    .custom-table tr:last-child td {
        border-bottom: none;
    }
    .custom-table tr:hover {
        background-color: #f8fafc;
    }
    
    .table-img {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        object-fit: cover;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
    }
    .badge-gray { background: #f1f5f9; color: #64748b; }
    .badge-blue { background: #eff6ff; color: #1e40af; }
    .badge-green { background: #f0fdf4; color: #166534; }
    .badge-red { background: #fef2f2; color: #991b1b; }
</style>
