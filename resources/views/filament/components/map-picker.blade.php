<div 
    wire:ignore
    x-data="{
        map: null,
        marker: null,
        displayLat: null,
        displayLng: null,

        init() {
            this.ensureLeaflet(() => {
                this.$nextTick(() => {
                    this.mountMap();
                });
            });
        },

        ensureLeaflet(callback) {
            if (window.L) {
                callback();
                return;
            }

            if (!document.getElementById('leaflet-cdn-css')) {
                const link = document.createElement('link');
                link.id = 'leaflet-cdn-css';
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                document.head.appendChild(link);
            }

            if (!document.getElementById('leaflet-cdn-js')) {
                const script = document.createElement('script');
                script.id = 'leaflet-cdn-js';
                script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                script.onload = () => callback();
                document.head.appendChild(script);
            } else {
                const checkInterval = setInterval(() => {
                    if (window.L) {
                        clearInterval(checkInterval);
                        callback();
                    }
                }, 100);
            }
        },

        mountMap() {
            const container = this.$refs.mapBox;
            if (!container || !window.L) return;

            // Read initial coordinates from Livewire
            const curLat = parseFloat(this.$wire.get('data.latitude'));
            const curLng = parseFloat(this.$wire.get('data.longitude'));
            const hasCoords = !isNaN(curLat) && !isNaN(curLng) && (curLat !== 0 || curLng !== 0);

            const initialCenter = hasCoords ? [curLat, curLng] : [-2.5489, 118.0149];
            const initialZoom = hasCoords ? 10 : 5;

            if (hasCoords) {
                this.displayLat = curLat;
                this.displayLng = curLng;
            }

            // Create Leaflet Map Instance
            this.map = L.map(container, {
                zoomControl: true,
                scrollWheelZoom: true
            }).setView(initialCenter, initialZoom);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(this.map);

            // Place initial marker if coordinates exist
            if (hasCoords) {
                this.placeMarker(curLat, curLng);
            }

            // Map click listener -> update coordinates
            this.map.on('click', (e) => {
                this.applyNewCoordinates(e.latlng.lat, e.latlng.lng);
            });

            // Handle invalidation for responsive layout
            [200, 500, 1000].forEach((delay) => {
                setTimeout(() => {
                    if (this.map) this.map.invalidateSize();
                }, delay);
            });

            window.addEventListener('resize', () => {
                if (this.map) this.map.invalidateSize();
            });

            // Watch external coordinate changes (e.g. from typing name in form)
            this.$watch('$wire.data.latitude', (val) => {
                this.handleExternalSync(val, this.$wire.get('data.longitude'));
            });

            this.$watch('$wire.data.longitude', (val) => {
                this.handleExternalSync(this.$wire.get('data.latitude'), val);
            });
        },

        placeMarker(lat, lng) {
            if (this.marker) {
                this.marker.setLatLng([lat, lng]);
                return;
            }

            this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);

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
            const lat = parseFloat(newLat);
            const lng = parseFloat(newLng);

            if (isNaN(lat) || isNaN(lng) || (lat === 0 && lng === 0)) {
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
    }"
    class="w-full space-y-2.5"
>
    <!-- Map Instructions & Feedback Bar -->
    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 8px; padding: 10px 14px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 12px; color: #374151;">
        <div style="display: flex; align-items: center; gap: 8px; flex: 1 1 200px;">
            <svg style="width: 16px; height: 16px; min-width: 16px; color: #0284c7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span><strong>Petunjuk:</strong> Klik di peta atau geser pin marker untuk menentukan koordinat centroid.</span>
        </div>

        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px 12px;">
            <template x-if="displayLat !== null && displayLng !== null">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 6px; font-family: monospace; font-size: 11px; font-weight: 600; color: #065f46;">
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></span>
                    <span x-text="`Lat: ${displayLat}, Lng: ${displayLng}`"></span>
                </span>
            </template>
            <template x-if="displayLat === null || displayLng === null">
                <span style="color: #9ca3af; font-style: italic; font-size: 11px;">Belum ada titik</span>
            </template>

            <button 
                type="button" 
                @click="resetView()" 
                style="font-size: 11px; color: #6b7280; text-decoration: underline; background: none; border: none; cursor: pointer; padding: 4px 0; min-height: 32px;"
                onmouseover="this.style.color='#111827'"
                onmouseout="this.style.color='#6b7280'"
            >
                Reset Tampilan
            </button>
        </div>
    </div>

    <!-- Map Viewport -->
    <div 
        x-ref="mapBox" 
        class="w-full h-[280px] sm:h-[350px] md:h-[380px] min-h-[260px] rounded-lg border border-gray-300 relative z-0 bg-gray-100"
    ></div>
</div>
