document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('modal-overlay');
    const btnOpenEdit = document.getElementById('btn-open-edit');

    const modalBanner = document.getElementById('modal-banner');
    const bannerInput = document.getElementById('banner-input');
    const btnRemoveBanner = document.getElementById('btn-remove-banner');

    const avatarInput = document.getElementById('avatar-input');
    const modalAvatarImg = document.getElementById('modal-avatar-img');
    const modalAvatarDefault = document.getElementById('modal-avatar-default');

    // Buka Popup Modal
    if (btnOpenEdit) {
        btnOpenEdit.addEventListener('click', function () {
            overlay.classList.remove('hidden');
            document.body.classList.add('no-scroll');
        });
    }

    // Tutup Popup Modal
    function closeModal() {
        overlay.classList.add('hidden');
        document.body.classList.remove('no-scroll');
    }

    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay && !overlay.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Preview Banner Sementara saat Memilih File
    if (bannerInput) {
        bannerInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    modalBanner.style.backgroundImage = 'url("' + e.target.result + '")';
                    modalBanner.style.backgroundSize = 'cover';
                    modalBanner.style.backgroundPosition = 'center';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Preview Avatar Sementara saat Memilih File
    if (avatarInput) {
        avatarInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (modalAvatarImg) {
                        modalAvatarImg.src = e.target.result;
                        modalAvatarImg.classList.remove('hidden');
                    }
                    if (modalAvatarDefault) {
                        modalAvatarDefault.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});