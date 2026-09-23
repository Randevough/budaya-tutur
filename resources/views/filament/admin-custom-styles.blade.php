<!-- Leaflet CSS and JS for Admin Panel Map Picker -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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



    /* Table Toolbar Segmented Tabs: Inside Table Card Toolbar on Large Screens (1-Row with Filter & Search) */
    @media (min-width: 1200px) {
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

        .fi-resource-list-records-page .fi-ta-header-toolbar {
            min-height: 4rem !important;
            padding-top: 0.875rem !important;
            padding-bottom: 0.875rem !important;
            padding-left: 1.25rem !important;
            padding-right: 1.25rem !important;
        }
    }

    /* Tabs Styling (Applied across all viewports) */
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

    /* Relative Tabs on Tablets & Mobile (< 1200px) to prevent collision with search toolbar */
    @media (max-width: 1199px) {
        .bt-table-tabs {
            position: relative !important;
            margin-bottom: 0.75rem !important;
            width: 100% !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }
    }

    /* Clean Mobile Table Header & Search (< 640px) */
    @media (max-width: 639px) {
        .fi-ta-header-ctn {
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 0.75rem !important;
            padding: 0.875rem 1rem !important;
        }

        .fi-ta-header-ctn > .fi-ta-header {
            padding-bottom: 0 !important;
        }

        .fi-ta-header-ctn > .fi-ta-header-toolbar {
            width: 100% !important;
            margin-left: 0 !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            gap: 0.5rem !important;
            padding-top: 0 !important;
        }

        .fi-ta-header-toolbar .fi-input-wrapper {
            width: 100% !important;
        }

        /* Prevent auto zoom on iOS Safari inside admin panel */
        .fi-input-wrapper input,
        .fi-input-wrapper select,
        .fi-input-wrapper textarea {
            font-size: 16px !important;
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

    /* 1. Topbar & Sidebar Boundary */
    .fi-topbar {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e7e3dc !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02) !important;
    }

    .fi-sidebar {
        background-color: #ffffff !important;
        border-right: 1px solid #e7e3dc !important;
    }

    /* 2. Smooth Sidebar Transitions */
    @media (min-width: 1024px) {
        .fi-sidebar {
            transition: width 240ms cubic-bezier(0.4, 0, 0.2, 1), transform 240ms cubic-bezier(0.4, 0, 0.2, 1) !important;
            will-change: width;
        }

        .fi-main-ctn {
            transition: margin 240ms cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .fi-sidebar-nav {
            transition: width 240ms cubic-bezier(0.4, 0, 0.2, 1), padding 240ms cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .fi-sidebar-item-label,
        .fi-sidebar-group-label {
            transition: opacity 180ms ease, transform 180ms ease !important;
        }

        .fi-sidebar-item-btn {
            transition: background-color 150ms ease, color 150ms ease, padding 200ms ease !important;
        }
    }

    /* 3. Contrast & Layering Architecture */
    .fi-body,
    .fi-main-ctn,
    .fi-main {
        background-color: #f7f5f2 !important;
    }

    /* Standard Contained Form Section Cards */
    .fi-section:not(.fi-section-not-contained):not(.fi-wi-stats-overview .fi-section) {
        background-color: #ffffff !important;
        border: 1px solid #e5e0d8 !important;
        border-radius: 0.875rem !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.03), 0 4px 12px 0 rgba(0, 0, 0, 0.015) !important;
    }

    /* Uncontained Widgets / Overview Section */
    .fi-wi-stats-overview,
    .fi-wi-stats-overview .fi-section,
    .fi-section-not-contained {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }

    /* Pure Deep Obsidian Black Toggle Switch */
    .fi-toggle.fi-toggle-on,
    button.fi-toggle[aria-checked="true"],
    .fi-toggle-btn[aria-checked="true"] {
        background-color: #121110 !important;
    }

    .fi-toggle.fi-toggle-on:hover,
    button.fi-toggle[aria-checked="true"]:hover {
        background-color: #000000 !important;
    }

    .fi-wi-stats-overview-stat {
        background-color: #ffffff !important;
        border: 1px solid #e5e0d8 !important;
        border-radius: 0.875rem !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.03) !important;
    }

    .fi-sidebar-header-logo-ctn {
        display: flex !important;
        align-items: center !important;
        overflow: hidden !important;
    }

    /* Form Input Fields Contrast & Focus */
    .fi-input-wrapper {
        background-color: #ffffff !important;
        border: 1px solid #d8d2c7 !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02) !important;
        transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
    }

    .fi-input-wrapper:hover {
        border-color: #a89f91 !important;
    }

    .fi-input-wrapper:focus-within {
        border-color: #1a1816 !important;
        box-shadow: 0 0 0 1.5px #1a1816, 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
    }

    .fi-input-wrapper input,
    .fi-input-wrapper select,
    .fi-input-wrapper textarea {
        font-size: 0.875rem !important;
        color: #1a1816 !important;
    }

    .fi-input-wrapper input::placeholder,
    .fi-input-wrapper textarea::placeholder {
        color: #9c9589 !important;
    }

    .fi-fo-field-wrp-label label {
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        color: #2e2a27 !important;
        letter-spacing: -0.005em !important;
    }

    .fi-fo-field-wrp-helper-text {
        font-size: 0.75rem !important;
        color: #797166 !important;
        margin-top: 0.375rem !important;
    }

    /* FileUpload Aesthetic */
    .fi-fo-file-upload .filepond--panel-root {
        background-color: #fbfaf8 !important;
        border: 1px dashed #d5cec3 !important;
        border-radius: 0.625rem !important;
        transition: all 0.2s ease !important;
    }

    .fi-fo-file-upload:hover .filepond--panel-root {
        background-color: #f8f6f3 !important;
        border-color: #a89f91 !important;
    }

    /* Fieldset Styling in Editorial Monochrome */
    .fi-fieldset {
        border: 1px solid #e7e2d8 !important;
        border-radius: 0.75rem !important;
        padding: 1.25rem 1.25rem 1.5rem !important;
        margin-top: 0.75rem !important;
        background-color: #faf9f7 !important;
    }

    .fi-fieldset > legend {
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        color: #24211e !important;
        letter-spacing: -0.01em !important;
        padding: 0 0.5rem !important;
        background-color: transparent !important;
    }

    /* 4. Section Header Single Crisp Line */
    .fi-section-header {
        display: flex !important;
        align-items: center !important;
        gap: 0.875rem !important;
        padding-bottom: 0.875rem !important;
        border-bottom: 1px solid #dcd6cb !important;
        margin-bottom: 1.25rem !important;
    }

    .fi-section-content-ctn,
    .fi-section.fi-contained > .fi-section-content-ctn,
    .fi-section.fi-divided > :not([hidden]) ~ :not([hidden]) {
        border-top: none !important;
        border-top-width: 0 !important;
    }

    .fi-section-header > .fi-icon {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 2.25rem !important;
        height: 2.25rem !important;
        padding: 0.45rem !important;
        border-radius: 0.5rem !important;
        background-color: #f6f3ee !important;
        border: 1px solid #e4ded4 !important;
        color: #2b2723 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
        margin-top: 0 !important;
        flex-shrink: 0 !important;
    }

    .fi-section-header-text-ctn {
        display: flex !important;
        flex-direction: column !important;
        gap: 0.15rem !important;
    }

    .fi-section-header-heading {
        font-size: 0.9375rem !important;
        font-weight: 600 !important;
        color: #171513 !important;
        letter-spacing: -0.01em !important;
        line-height: 1.3 !important;
    }

    .fi-section-header-description {
        font-size: 0.78125rem !important;
        color: #797166 !important;
        line-height: 1.35 !important;
    }

    /* Map Picker Container & Leaflet Styling (Editorial Monochrome) */
    .bt-admin-map-container {
        width: 100% !important;
        height: 380px !important;
        min-height: 350px !important;
        border-radius: 0.625rem !important;
        border: 1px solid #dcd7ce !important;
        background-color: #f7f6f4 !important;
        position: relative !important;
        z-index: 0 !important;
        overflow: hidden !important;
    }

    .bt-admin-map-container .leaflet-control-zoom {
        border: 1px solid #dcd7ce !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
        border-radius: 6px !important;
        overflow: hidden !important;
    }

    .bt-admin-map-container .leaflet-control-zoom a {
        background-color: #fdfbf7 !important;
        color: #181615 !important;
        border-bottom: 1px solid #e5dfd5 !important;
    }

    .bt-admin-map-container .leaflet-control-zoom a:hover {
        background-color: #f0ebe1 !important;
        color: #000000 !important;
    }

    .bt-admin-map-container .leaflet-control-attribution,
    .leaflet-control-attribution {
        display: none !important;
    }

    /* ========================================================
       Archival Editorial Theme for Auth Pages (Login & Password Reset)
       ======================================================== */
    body.fi-body:has(.fi-simple-layout),
    .fi-simple-layout {
        background-color: #f8f5f0 !important;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 0 L40 20 L20 40 L0 20 Z' fill='none' stroke='%232c2825' stroke-width='0.75' stroke-opacity='0.045'/%3E%3Cpath d='M20 6 L34 20 L20 34 L6 20 Z' fill='none' stroke='%232c2825' stroke-width='0.5' stroke-opacity='0.03'/%3E%3Ccircle cx='20' cy='20' r='1.5' fill='%232c2825' fill-opacity='0.04'/%3E%3C/svg%3E") !important;
        background-repeat: repeat !important;
        color: #181615 !important;
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
    }

    .fi-simple-main {
        background-color: #fdfbf7 !important;
        border: 1px solid #e3ddd3 !important;
        box-shadow: 0 12px 32px -4px rgba(24, 22, 21, 0.07), 0 0 0 1px rgba(24, 22, 21, 0.02) !important;
        border-radius: 12px !important;
        padding: 1.5rem 1.25rem !important;
        max-width: 28rem !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    @media (min-width: 640px) {
        .fi-simple-main {
            padding: 2.75rem 2.5rem !important;
        }
    }

    @media screen and (max-width: 767px) {
        .fi-simple-main input.fi-input,
        .fi-simple-main input[type="email"],
        .fi-simple-main input[type="password"],
        .fi-simple-main input[type="text"] {
            font-size: 16px !important;
        }
    }

    .fi-simple-main .fi-fo-field-wrp {
        margin-bottom: 1.25rem !important;
    }

    .fi-simple-main label,
    .fi-simple-main .fi-fo-field-wrp-label {
        color: #181615 !important;
        font-weight: 600 !important;
        letter-spacing: 0.06em !important;
        font-size: 0.8125rem !important;
        margin-bottom: 0.375rem !important;
        display: inline-flex !important;
        align-items: center !important;
    }

    .fi-simple-main .fi-input-wrp {
        background-color: #ffffff !important;
        border: 1px solid #d0c8bb !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
        border-radius: 6px !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
        display: flex !important;
        align-items: center !important;
        min-height: 44px !important;
        padding: 0 !important;
        overflow: hidden !important;
    }

    .fi-simple-main .fi-input-wrp:focus-within {
        border-color: #181615 !important;
        box-shadow: 0 0 0 2px rgba(24, 22, 21, 0.12) !important;
        outline: none !important;
    }

    .fi-simple-main input.fi-input,
    .fi-simple-main input[type="email"],
    .fi-simple-main input[type="password"],
    .fi-simple-main input[type="text"] {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
        color: #181615 !important;
        font-size: 0.9375rem !important;
        line-height: 1.5rem !important;
        padding: 0.625rem 0.875rem !important;
        width: 100% !important;
        height: auto !important;
    }

    .fi-simple-main button[type="submit"],
    .fi-simple-main .fi-btn-primary {
        background-color: #0c0b0a !important;
        color: #fdfbf7 !important;
        border: 1px solid #0c0b0a !important;
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.18em !important;
        text-transform: uppercase !important;
        border-radius: 6px !important;
        padding-top: 0.8125rem !important;
        padding-bottom: 0.8125rem !important;
        width: 100% !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-shadow: 0 2px 5px rgba(12, 11, 10, 0.15) !important;
        cursor: pointer !important;
    }

    .fi-simple-main button[type="submit"]:hover,
    .fi-simple-main .fi-btn-primary:hover {
        background-color: #2c2825 !important;
        border-color: #2c2825 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 16px -2px rgba(12, 11, 10, 0.25) !important;
    }
</style>

<script>
window.regencyMapPicker = function() {
    return {
        map: null,
        marker: null,
        displayLat: null,
        displayLng: null,

        parseCoord(val) {
            if (val === null || val === undefined || val === '') return null;
            if (typeof val === 'number') return isNaN(val) ? null : val;
            const normalized = String(val).trim().replace(',', '.');
            const num = parseFloat(normalized);
            return isNaN(num) ? null : num;
        },

        init() {
            this.ensureLeaflet(() => {
                this.$nextTick(() => {
                    this.mountMap();
                });
            });
        },

        ensureLeaflet(callback) {
            if (window.L && typeof window.L.map === 'function') {
                callback();
                return;
            }

            const checkInterval = setInterval(() => {
                if (window.L && typeof window.L.map === 'function') {
                    clearInterval(checkInterval);
                    callback();
                }
            }, 50);

            // Fallback timeout to prevent waiting indefinitely
            setTimeout(() => {
                clearInterval(checkInterval);
                if (window.L && typeof window.L.map === 'function') {
                    callback();
                }
            }, 5000);
        },

        mountMap() {
            const container = this.$refs.mapBox;
            if (!container || !window.L) return;

            // Safe cleanup if re-mounting or container already bound
            if (this.map) {
                this.map.remove();
                this.map = null;
                this.marker = null;
            } else if (container._leaflet_id) {
                delete container._leaflet_id;
            }

            // Read initial coordinates from Livewire
            const curLat = this.parseCoord(this.$wire.get('data.latitude'));
            const curLng = this.parseCoord(this.$wire.get('data.longitude'));
            const hasCoords = curLat !== null && curLng !== null && (curLat !== 0 || curLng !== 0);

            const initialCenter = hasCoords ? [curLat, curLng] : [-2.5489, 118.0149];
            const initialZoom = hasCoords ? 10 : 5;

            if (hasCoords) {
                this.displayLat = Math.round(curLat * 10000000) / 10000000;
                this.displayLng = Math.round(curLng * 10000000) / 10000000;
            }

            // Create Leaflet Map Instance (No watermark / attribution)
            this.map = L.map(container, {
                zoomControl: true,
                scrollWheelZoom: true,
                attributionControl: false
            }).setView(initialCenter, initialZoom);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: ''
            }).addTo(this.map);

            // Place initial marker if coordinates exist
            if (hasCoords) {
                this.placeMarker(curLat, curLng);
            }

            // Map click listener -> update coordinates
            this.map.on('click', (e) => {
                this.applyNewCoordinates(e.latlng.lat, e.latlng.lng);
            });

            // Force map layout computation so tiles load immediately
            [100, 300, 600, 1000].forEach((delay) => {
                setTimeout(() => {
                    if (this.map) this.map.invalidateSize();
                }, delay);
            });

            window.addEventListener('resize', () => {
                if (this.map) this.map.invalidateSize();
            });

            if (window.ResizeObserver) {
                const ro = new ResizeObserver(() => {
                    if (this.map) this.map.invalidateSize();
                });
                ro.observe(container);
            }

            // Watch external coordinate changes (e.g. from typing name in form or detection)
            this.$watch('$wire.data.latitude', (val) => {
                this.handleExternalSync(val, this.$wire.get('data.longitude'));
            });

            this.$watch('$wire.data.longitude', (val) => {
                this.handleExternalSync(this.$wire.get('data.latitude'), val);
            });
        },

        getPinIcon() {
            return L.divIcon({
                className: 'bt-map-picker-pin',
                html: '<div style="position: relative; width: 28px; height: 36px; display: flex; align-items: center; justify-content: center;"><svg style="width: 28px; height: 36px; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.35));" viewBox="0 0 24 32" fill="none"><path d="M12 0C5.373 0 0 5.373 0 12c0 9 12 20 12 20s12-11 12-20c0-6.627-5.373-12-12-12z" fill="#181615"/><circle cx="12" cy="11" r="4.5" fill="#f4f0ea"/></svg></div>',
                iconSize: [28, 36],
                iconAnchor: [14, 36]
            });
        },

        placeMarker(lat, lng) {
            if (this.marker) {
                this.marker.setLatLng([lat, lng]);
                return;
            }

            this.marker = L.marker([lat, lng], { 
                draggable: true,
                icon: this.getPinIcon()
            }).addTo(this.map);

            this.marker.on('dragend', (e) => {
                const pos = e.target.getLatLng();
                this.applyNewCoordinates(pos.lat, pos.lng, false);
            });
        },

        applyNewCoordinates(lat, lng, pan = true) {
            const roundedLat = Math.round(lat * 10000000) / 10000000;
            const roundedLng = Math.round(lng * 10000000) / 10000000;

            this.displayLat = roundedLat;
            this.displayLng = roundedLng;

            this.placeMarker(roundedLat, roundedLng);

            if (pan && this.map) {
                this.map.panTo([roundedLat, roundedLng]);
            }

            this.$wire.set('data.latitude', roundedLat);
            this.$wire.set('data.longitude', roundedLng);
        },

        handleExternalSync(newLat, newLng) {
            const lat = this.parseCoord(newLat);
            const lng = this.parseCoord(newLng);

            if (lat === null || lng === null || (lat === 0 && lng === 0)) {
                return;
            }

            if (lat === this.displayLat && lng === this.displayLng) {
                return;
            }

            this.displayLat = lat;
            this.displayLng = lng;
            this.placeMarker(lat, lng);

            if (this.map) {
                this.map.flyTo([lat, lng], 10, { duration: 1.2 });
            }
        },

        resetView() {
            if (this.map) {
                this.map.flyTo([-2.5489, 118.0149], 5, { duration: 1 });
            }
        }
    };
};
</script>
