<x-filament-panels::page.simple>
    @vite(['resources/css/app.css'])

    <style>
        /* Light Mode Archival Canvas & Cultural Geometric Tenun Motif */
        body.fi-body,
        .fi-simple-layout {
            background-color: #f8f5f0 !important;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 0 L40 20 L20 40 L0 20 Z' fill='none' stroke='%232c2825' stroke-width='0.75' stroke-opacity='0.045'/%3E%3Cpath d='M20 6 L34 20 L20 34 L6 20 Z' fill='none' stroke='%232c2825' stroke-width='0.5' stroke-opacity='0.03'/%3E%3Ccircle cx='20' cy='20' r='1.5' fill='%232c2825' fill-opacity='0.04'/%3E%3C/svg%3E") !important;
            background-repeat: repeat !important;
            color: #181615 !important;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
        }

        /* Archival Paper Form Container */
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

        /* Form Field Wrapper Spacing */
        .fi-simple-main .fi-fo-field-wrp {
            margin-bottom: 1.25rem !important;
        }

        /* Labels: Crisp, legible, uppercase editorial */
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

        /* Clean Outer Input Box (.fi-input-wrp) */
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

        /* Inner Input Element: Transparent, no border, generous padding */
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

        .fi-simple-main input.fi-input:focus,
        .fi-simple-main input[type="email"]:focus,
        .fi-simple-main input[type="password"]:focus,
        .fi-simple-main input[type="text"]:focus {
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* Eye Icon (Password Reveal Suffix) Inside Input Box */
        .fi-simple-main .fi-input-wrp-suffix {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding-right: 0.75rem !important;
            padding-left: 0.25rem !important;
            background: transparent !important;
        }

        .fi-simple-main .fi-input-wrp-suffix button,
        .fi-simple-main .fi-input-wrp-suffix .fi-icon-btn {
            color: #7a736a !important;
            padding: 0.25rem !important;
            border-radius: 4px !important;
            transition: color 0.15s ease, background-color 0.15s ease !important;
        }

        .fi-simple-main .fi-input-wrp-suffix [style*="display: none"],
        .fi-simple-main .fi-input-wrp-suffix [hidden] {
            display: none !important;
        }

        .fi-simple-main .fi-input-wrp-suffix button:hover,
        .fi-simple-main .fi-input-wrp-suffix .fi-icon-btn:hover {
            color: #181615 !important;
            background-color: #f2ece2 !important;
        }

        .fi-simple-main .fi-input-wrp-suffix svg {
            width: 1.25rem !important;
            height: 1.25rem !important;
        }

        /* Checkbox: High Contrast & Highly Visible */
        .fi-simple-main input[type="checkbox"],
        .fi-simple-main .fi-checkbox-input {
            appearance: none !important;
            -webkit-appearance: none !important;
            width: 1.125rem !important;
            height: 1.125rem !important;
            min-width: 1.125rem !important;
            border: 1.5px solid #5c554e !important;
            border-radius: 4px !important;
            background-color: #ffffff !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            vertical-align: middle !important;
            margin: 0 0.5rem 0 0 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.15s ease !important;
        }

        .fi-simple-main input[type="checkbox"]:hover,
        .fi-simple-main .fi-checkbox-input:hover {
            border-color: #181615 !important;
        }

        .fi-simple-main input[type="checkbox"]:focus,
        .fi-simple-main .fi-checkbox-input:focus {
            outline: none !important;
            border-color: #181615 !important;
            box-shadow: 0 0 0 2px rgba(24, 22, 21, 0.15) !important;
        }

        .fi-simple-main input[type="checkbox"]:checked,
        .fi-simple-main .fi-checkbox-input:checked {
            background-color: #0c0b0a !important;
            border-color: #0c0b0a !important;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='%23fff' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12.207 4.793a1 1 0 0 1 0 1.414l-5 5a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L6.5 9.086l4.293-4.293a1 1 0 0 1 1.414 0z'/%3E%3C/svg%3E") !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: 11px !important;
        }

        /* Checkbox label text */
        .fi-simple-main .fi-fo-checkbox label,
        .fi-simple-main label:has(input[type="checkbox"]) {
            color: #2e2a27 !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            letter-spacing: normal !important;
            text-transform: none !important;
        }

        /* Pitch Black Primary Submit Button */
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

        .fi-simple-main button[type="submit"]:active,
        .fi-simple-main .fi-btn-primary:active {
            transform: translateY(0) !important;
            box-shadow: 0 2px 4px rgba(12, 11, 10, 0.1) !important;
        }
    </style>

    <div class="budaya-auth-container w-full">
        <!-- Archival Brand Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center mb-4 group focus:outline-none" title="Kembali ke Beranda">
                <div style="width: 3.25rem; height: 3.25rem; border-radius: 9999px; background-color: #121110; border: 1px solid #2c2825; display: flex; align-items: center; justify-content: center; color: #f4f0ea; box-shadow: 0 2px 6px rgba(0,0,0,0.15);" class="group-hover:border-[#5c554e] group-hover:bg-[#1c1a18] transition-all duration-300">
                    <svg style="width: 1.5rem; height: 1.5rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" stroke-dasharray="2 3" stroke-opacity="0.5" />
                        <path d="M12 7v10" />
                        <path d="M8 9.5v5" />
                        <path d="M16 9.5v5" />
                        <path d="M4 11v2" />
                        <path d="M20 11v2" />
                    </svg>
                </div>
            </a>

            <h1 class="font-serif text-2xl sm:text-3xl font-bold tracking-[0.16em] uppercase text-[#181615] leading-tight" style="font-family: 'Cinzel', Georgia, serif;">
                Budaya Tutur
            </h1>
        </div>

        <!-- Filament Livewire Form Schema -->
        <div class="budaya-auth-form">
            {{ $this->content }}
        </div>

        <!-- Editorial Navigation Cue -->
        <div class="mt-8 pt-6 border-t border-[#e3ddd3] text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-xs tracking-[0.18em] uppercase text-[#7a736a] hover:text-[#181615] transition-colors font-medium group">
                <span class="inline-block transition-transform duration-200 group-hover:-translate-x-1 mr-1.5">&larr;</span>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-filament-panels::page.simple>
