<!-- INTERACTIVE MAP MODAL -->
<div id="interactiveMapModal" class="modal-overlay" onclick="handleMapModalBackdrop(event)">
    <div class="modal-content-card">
        <div class="modal-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-map-marked-alt" style="color: var(--accent-blue); font-size: 20px;"></i>
                <h3>O'zbekiston bo'yicha e'lonlar xaritasi</h3>
            </div>
            <button type="button" class="btn-modal-close" onclick="closeInteractiveMapModal()">&times;</button>
        </div>
        <div class="modal-map-wrap">
            <div id="estoraInteractiveMap" style="height: 100%; width: 100%;"></div>
        </div>
    </div>
</div>

<script>
let estoraLeafletMap = null;
let estoraMarkersGroup = null;

function openInteractiveMapModal() {
    const modal = document.getElementById('interactiveMapModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
        initLeafletMap();
    }, 150);
}

function closeInteractiveMapModal() {
    const modal = document.getElementById('interactiveMapModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function handleMapModalBackdrop(e) {
    if (e.target.id === 'interactiveMapModal') {
        closeInteractiveMapModal();
    }
}

function initLeafletMap() {
    if (estoraLeafletMap) {
        estoraLeafletMap.invalidateSize();
        return;
    }

    // Initialize Leaflet Map centered on Tashkent
    estoraLeafletMap = L.map('estoraInteractiveMap').setView([41.2995, 69.2401], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(estoraLeafletMap);

    const mapData = @json($mapProducts ?? []);

    if (mapData && mapData.length > 0) {
        const bounds = [];
        mapData.forEach(item => {
            if (item.lat && item.lng) {
                bounds.push([item.lat, item.lng]);

                const customIcon = L.divIcon({
                    className: 'custom-map-pin',
                    html: `<div style="background: var(--primary-navy, #091a3e); color: #fff; padding: 4px 8px; border-radius: 6px; font-weight: 700; font-size: 11px; box-shadow: 0 3px 8px rgba(0,0,0,0.3); border: 1.5px solid #fff; white-space: nowrap;">
                            ${item.price}
                           </div>`,
                    iconSize: [80, 30],
                    iconAnchor: [40, 15]
                });

                const marker = L.marker([item.lat, item.lng], { icon: customIcon }).addTo(estoraLeafletMap);

                const popupHtml = `
                    <div style="width: 220px; font-family: inherit;">
                        <img src="${item.image}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 6px; margin-bottom: 8px;" onerror="this.src='/images/hero.png'">
                        <div style="font-weight: 800; color: #0084ff; font-size: 14px; margin-bottom: 3px;">${item.price}</div>
                        <div style="font-weight: 700; font-size: 13px; color: #1e293b; line-height: 1.3; margin-bottom: 4px;">${item.name}</div>
                        <div style="font-size: 11px; color: #64748b; margin-bottom: 8px;">${item.region || ''}, ${item.city || ''}</div>
                        <a href="${item.url}" style="display: block; text-align: center; background: #091a3e; color: #fff; padding: 6px 0; border-radius: 4px; font-size: 12px; font-weight: 700; text-decoration: none;">Batafsil ko'rish</a>
                    </div>
                `;

                marker.bindPopup(popupHtml);
            }
        });

        if (bounds.length > 0) {
            estoraLeafletMap.fitBounds(bounds, { padding: [40, 40], maxZoom: 15 });
        }
    }
}
</script>
