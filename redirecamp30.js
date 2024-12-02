<script>
        // Daftar URL AMP yang terblokir
        const blockedAmpUrls = [
            "https://pub-9ac899cf166c498fa482c500908726f0.r2.dev/amp.www.ilincaboutique.com.html"
        ];

        // URL AMP baru yang akan digunakan untuk redirect
        const newAmpUrl = "https://pub-76d3d984d11947ef83771803ba5e8803.r2.dev/amp2.www.ilincaboutique.com.html"; // Ganti dengan URL AMP baru Anda

        // Cek apakah URL saat ini ada dalam daftar terblokir
        function checkAndRedirect() {
            const currentUrl = window.location.href;
            if (blockedAmpUrls.some(url => currentUrl === url)) {
                // URL terblokir, redirect ke halaman AMP baru
                window.location.href = newAmpUrl;
            }
        }

        // Panggil fungsi saat halaman dimuat
        window.onload = checkAndRedirect;
    </script>
