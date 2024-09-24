<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Negara</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="search-box">
            <h1>Cek Negara</h1>
            <p>Masukkan nama negara untuk melihat informasi</p>
            <form id="countryForm">
                <input type="text" id="countryName" placeholder="Nama Negara" autocomplete="off" required>
                <ul id="suggestions" class="hidden"></ul>
                <button type="submit">Cari</button>
            </form>
            <div id="loading" class="loading">Loading...</div>
            <div id="error" class="error hidden"></div>
        </div>

        <div id="result" class="result-box hidden">
            <img id="flag" src="" alt="Bendera Negara" />
            <h2>Informasi Negara</h2>
            <p><strong>Nama:</strong> <span id="name"></span></p>
            <p><strong>Ibu Kota:</strong> <span id="capital"></span></p>
            <p><strong>Kode Telepon:</strong> <span id="phoneCode"></span></p>
            <p><strong>Kode Benua:</strong> <span id="continent"></span></p>
            <p><strong>Mata Uang:</strong> <span id="currency"></span></p>
            <p><strong>Bahasa Resmi:</strong> <span id="languages"></span></p>
            <button id="searchAgain">Cari Lagi</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
