@php
    $record = $getRecord() ?? ($entry?->getRecord() ?? ($record ?? null));
@endphp

@if($record)
<div style="font-family: inherit; width: 100%; display: flex; flex-direction: column; gap: 16px;">
    <!-- 1. Metadata Grid Card (Generous Spacing & Clear Visual Hierarchy) -->
    <div style="background-color: #fafaf9; border: 1px solid #e7e5e4; border-radius: 10px; padding: 18px 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px 24px;">
            
            <!-- Nama Pengirim -->
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c;">
                    Nama Pengirim
                </span>
                <span style="font-size: 15px; font-weight: 700; color: #1c1917; line-height: 1.3;">
                    {{ $record->name }}
                </span>
            </div>

            <!-- Alamat Email -->
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c;">
                    Alamat Email
                </span>
                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <span style="font-size: 14px; font-weight: 500; color: #1c1917;">
                        {{ $record->email }}
                    </span>
                    <a href="mailto:{{ $record->email }}?subject={{ rawurlencode('Re: ' . $record->subject) }}" 
                       target="_blank" 
                       title="Buka email untuk membalas"
                       style="display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; color: #1c1917; background-color: #f5f5f4; border: 1px solid #d6d3d1; border-radius: 4px; padding: 2px 7px; text-decoration: none; cursor: pointer;">
                        <svg style="width: 11px; height: 11px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Balas
                    </a>
                </div>
            </div>

            <!-- Waktu Diterima -->
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c;">
                    Waktu Diterima
                </span>
                <span style="font-size: 13px; font-weight: 500; color: #44403c; line-height: 1.3;">
                    {{ $record->created_at ? $record->created_at->format('d F Y, H:i') . ' WIB' : '-' }}
                </span>
            </div>

            <!-- Status Pengiriman -->
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c;">
                    Status Sistem
                </span>
                <div>
                    @if($record->is_sent_via_smtp)
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background-color: #10b981;"></span>
                            Terkirim ke Email SMTP
                        </span>
                    @else
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a;">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background-color: #f59e0b;"></span>
                            Tersimpan di Database (Fallback)
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Subject & Scrollable Message Card -->
    <div style="background-color: #ffffff; border: 1px solid #e7e5e4; border-radius: 10px; padding: 18px 20px;">
        <!-- Subjek Pesan -->
        <div style="margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f5f5f4;">
            <span style="display: block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c; margin-bottom: 6px;">
                Subjek Pesan
            </span>
            <h3 style="font-size: 16px; font-weight: 700; color: #1c1917; margin: 0; line-height: 1.4;">
                {{ $record->subject ?: '(Tanpa Subjek)' }}
            </h3>
        </div>

        <!-- Isi Pesan Lengkap -->
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #78716c;">
                    Isi Pesan Lengkap
                </span>
                <span style="font-size: 11px; color: #a8a29e;">
                    {{ mb_strlen($record->message ?? '') }} karakter
                </span>
            </div>

            <!-- Scrollable Message Body Container -->
            <div style="max-height: 280px; overflow-y: auto; background-color: #fafaf9; border: 1px solid #e7e5e4; border-radius: 8px; padding: 14px 16px; font-size: 13.5px; line-height: 1.7; color: #292524; white-space: pre-wrap; word-break: break-word; user-select: text;">
{{ $record->message }}
            </div>
        </div>
    </div>
</div>
@endif
