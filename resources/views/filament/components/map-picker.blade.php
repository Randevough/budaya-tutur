<div 
    wire:ignore
    x-data="regencyMapPicker()"
    style="display: flex; flex-direction: column; gap: 12px; width: 100%;"
>
    <!-- Map Instructions & Feedback Bar (Editorial Archival Theme) -->
    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; padding: 10px 14px; background: #faf9f7; border: 1px solid #e8e4dc; border-radius: 8px; font-size: 12px; color: #2e2a27;">
        <div style="display: flex; align-items: center; flex: 1 1 240px;">
            <span style="line-height: 1.4;"><strong style="font-weight: 600; color: #181615;">Petunjuk:</strong> Klik di peta atau geser pin marker untuk menentukan koordinat centroid.</span>
        </div>

        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px 12px;">
            <template x-if="displayLat !== null && displayLng !== null">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; background: #181615; border: 1px solid #2e2a27; border-radius: 6px; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 11px; font-weight: 500; color: #f4f0ea; letter-spacing: 0.02em; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #ded7cc;"></span>
                    <span x-text="`Lat: ${displayLat}, Lng: ${displayLng}`"></span>
                </span>
            </template>
            <template x-if="displayLat === null || displayLng === null">
                <span style="color: #7a736a; font-style: italic; font-size: 11px; padding: 4px 8px; background: #f2ece2; border: 1px solid #e3ddd3; border-radius: 6px;">Belum ada titik</span>
            </template>

            <button 
                type="button" 
                @click="resetView()" 
                style="display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 500; color: #3e3934; background: #f2ece2; border: 1px solid #dcd7ce; border-radius: 6px; padding: 5px 10px; cursor: pointer; transition: all 0.15s ease;"
                onmouseover="this.style.background='#e5ded3'; this.style.borderColor='#b8b0a5'; this.style.color='#181615';"
                onmouseout="this.style.background='#f2ece2'; this.style.borderColor='#dcd7ce'; this.style.color='#3e3934';"
            >
                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                <span>Reset Tampilan</span>
            </button>
        </div>
    </div>

    <!-- Map Viewport -->
    <div 
        x-ref="mapBox" 
        id="regency-map-picker-box"
        class="bt-admin-map-container"
        style="width: 100%; height: 380px; min-height: 350px; border-radius: 8px; border: 1px solid #dcd7ce; background-color: #f7f6f4; position: relative; z-index: 0; box-shadow: inset 0 1px 3px rgba(0,0,0,0.04); overflow: hidden;"
    ></div>
</div>
