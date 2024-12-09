<!-- resources/views/invalizin/preview.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Gambar</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
            margin: 0;
        }
        .image-container {
            text-align: center;
        }
        img {
            max-width: 100%;
            max-height: 100vh;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="image-container">
        <button class="close-btn" onclick="window.history.back();">Close</button>
        <img src="{{ asset('storage/' . $izin->surat) }}" alt="Surat">
    </div>
</body>
</html>
