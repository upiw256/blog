<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Modal</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="qr-code-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('qr-code-modal').style.display='none'">&times;</span>
            <div id="qr-code-modal-content"></div>
        </div>
    </div>

    <script>
        window.addEventListener('open-modal', event => {
            document.getElementById('qr-code-modal-content').innerHTML = event.detail.content;
            document.getElementById('qr-code-modal').style.display = 'block';
        });
    </script>
</body>
</html>