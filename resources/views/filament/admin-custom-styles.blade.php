<style>
    /* Table Header 1-Row Layout: Heading on left, Search on top-right */
    @media (min-width: 640px) {
        .fi-ta-header-ctn {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
        }

        .fi-ta-header-ctn > .fi-ta-header {
            border-bottom-width: 0 !important;
            padding-top: 0.875rem !important;
            padding-bottom: 0.875rem !important;
        }

        .fi-ta-header-ctn > .fi-ta-header-toolbar {
            border-bottom-width: 0 !important;
            padding-top: 0.875rem !important;
            padding-bottom: 0.875rem !important;
            margin-left: auto !important;
        }
    }

    /* Refined Table Search Input */
    .fi-ta-header-toolbar .fi-input-wrapper {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
        border-radius: 0.5rem !important;
        transition: all 0.15s ease-in-out !important;
    }

    .fi-ta-header-toolbar .fi-input-wrapper:focus-within {
        box-shadow: 0 0 0 2px rgba(28, 26, 24, 0.15) !important;
    }

    /* Modern subtle card styling */
    .fi-section, .fi-ta-ctn {
        border-radius: 1rem !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.03), 0 1px 2px -1px rgba(0, 0, 0, 0.03) !important;
    }

    /* Clean heading */
    .fi-ta-header-heading {
        font-size: 1rem !important;
        font-weight: 600 !important;
        letter-spacing: -0.01em !important;
    }

    /* Editorial Archival Status Pill */
    .bt-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.2rem 0.65rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.02em;
        line-height: 1.1;
    }

    .bt-status-pill.published {
        background-color: #f7f6f4;
        color: #2e2a27;
        border: 1px solid #e2ded8;
    }

    .bt-status-pill.published .bt-dot {
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 9999px;
        background-color: #2d6a4f;
    }

    .bt-status-pill.draft {
        background-color: #faf9f8;
        color: #78716c;
        border: 1px dashed #d6d3d1;
    }

    .bt-status-pill.draft .bt-dot {
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 9999px;
        background-color: #a8a29e;
    }

    /* Welcome Banner Custom Layout */
    .bt-welcome-container {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    @media (min-width: 640px) {
        .bt-welcome-container {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .bt-welcome-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .bt-welcome-avatar {
        width: 3rem;
        height: 3rem;
        border-radius: 0.75rem;
        background-color: #f5f3f0;
        color: #1c1a18;
        border: 1px solid #e3ddd3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .bt-welcome-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .bt-welcome-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: #7a736a;
        font-weight: 500;
    }

    .bt-meta-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.125rem 0.5rem;
        border-radius: 0.375rem;
        background-color: #f2ece2;
        color: #2e2a27;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .bt-meta-dot {
        width: 0.35rem;
        height: 0.35rem;
        border-radius: 9999px;
        background-color: #5c554e;
    }

    .bt-meta-sep {
        color: #d0c8bb;
    }

    .bt-welcome-heading {
        font-size: 1.25rem;
        font-weight: 600;
        color: #121110;
        line-height: 1.35;
        margin: 0;
    }

    .bt-welcome-name {
        font-weight: 700;
        color: #1c1a18;
    }

    .bt-welcome-desc {
        font-size: 0.8125rem;
        color: #7a736a;
        margin: 0;
    }

    .bt-welcome-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    /* Table Toolbar Segmented Tabs: Inside Table Card Toolbar (1-Row with Filter & Search) */
    @media (min-width: 768px) {
        .fi-resource-list-records-page .fi-page-content,
        .fi-resource-list-records-page .fi-sc.fi-grid {
            position: relative !important;
            gap: 0 !important;
            row-gap: 0 !important;
        }

        .fi-resource-list-records-page [wire\:key$="content.resourceTabs"] {
            height: 0 !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .bt-table-tabs {
            position: absolute !important;
            top: 0.875rem !important;
            left: 1.25rem !important;
            z-index: 10 !important;
            margin: 0 !important;
            width: auto !important;
        }

        .bt-table-tabs .fi-tabs:not(.fi-contained) {
            margin: 0 !important;
            padding: 0.2rem !important;
            background-color: #f7f6f4 !important;
            border: 1px solid #e5e2dc !important;
            box-shadow: none !important;
            border-radius: 0.625rem !important;
            --tw-ring-shadow: 0 0 #0000 !important;
        }

        .bt-table-tabs .fi-tabs-item {
            padding: 0.25rem 0.7rem !important;
            border-radius: 0.45rem !important;
            font-size: 0.8125rem !important;
            font-weight: 500 !important;
            color: #57534e !important;
            transition: all 0.15s ease !important;
        }

        .bt-table-tabs .fi-tabs-item.fi-active {
            background-color: #ffffff !important;
            color: #1c1917 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            font-weight: 600 !important;
        }

        .bt-table-tabs .fi-tabs-item .fi-badge {
            font-size: 0.7rem !important;
            padding: 0.1rem 0.4rem !important;
            border-radius: 9999px !important;
            background-color: #eae6e0 !important;
            color: #44403c !important;
        }

        .fi-resource-list-records-page .fi-ta-header-toolbar {
            min-height: 4rem !important;
            padding-top: 0.875rem !important;
            padding-bottom: 0.875rem !important;
            padding-left: 1.25rem !important;
            padding-right: 1.25rem !important;
        }
    }

    @media (max-width: 767px) {
        .bt-table-tabs {
            margin-bottom: 0.75rem !important;
        }
    }

    /* Page Header Subheading & Spacing Polish */
    .fi-header-subheading {
        font-size: 0.875rem !important;
        color: #78716c !important;
        margin-top: 0.25rem !important;
    }

    .fi-resource-list-records-page .fi-page-header-main-ctn {
        gap: 0.875rem !important;
    }

    .fi-resource-list-records-page .fi-header {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
</style>
