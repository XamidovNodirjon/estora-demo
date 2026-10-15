<!-- Universal Favorite Toggle AJAX Script -->
<script>
function toggleFavorite(productId, event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    fetch(`/favorites/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        // Mehmon foydalanuvchi: auth middleware login sahifasiga yo'naltiradi
        if (response.status === 401 || response.redirected) {
            window.location.href = "{{ route('login') }}";
            return null;
        }
        return response.json();
    })
    .then(data => {
        if (!data || !data.success) return;
        document.querySelectorAll(`.fav-btn-${productId}`).forEach(btn => {
            btn.classList.toggle('active', data.is_favorited);
            btn.innerHTML = data.is_favorited
                ? '<i class="fas fa-heart" style="color: #ef4444;"></i>'
                : '<i class="far fa-heart"></i>';
        });
    })
    .catch(err => console.error('Favorite error:', err));
}
</script>
