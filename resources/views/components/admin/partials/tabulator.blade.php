@push('styles')
    <style>
        tabulator {
            border: none !important;
            background-color: transparent !important;
            font-family: inherit;
        }

        .tabulator-header {
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #e9ecef !important;
            border-top: none !important;
            color: #6c757d !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .tabulator-header .tabulator-col {
            background-color: transparent !important;
            border-right: none !important;
        }

        .tabulator-row {
            border-bottom: 1px solid #f1f3f5 !important;
            background-color: #ffffff !important;
            transition: background-color 0.2s ease;
        }

        .tabulator-row.tabulator-row-even {
            background-color: #fafbfc !important;
        }

        .tabulator-row:hover {
            background-color: #f1f5f9 !important;
        }

        .tabulator-footer {
            background-color: #ffffff !important;
            border-top: 1px solid #e9ecef !important;
            padding: 12px 20px !important;
        }
        .tabulator-footer .tabulator-page {
            border: 1px solid #dee2e6 !important;
            background: #fff !important;
            color: #495057 !important;
            border-radius: 6px !important;
            margin: 0 3px !important;
            padding: 6px 12px !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .tabulator-footer .tabulator-page.active {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #ffffff !important;
        }
        .tabulator-footer .tabulator-page:hover:not(.active) {
            background-color: #e9ecef !important;
        }

        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
        }

    </style>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css"
    />@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/js/tabulator.min.js"></script>
@endpush
