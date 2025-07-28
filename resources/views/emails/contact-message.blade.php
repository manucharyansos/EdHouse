<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <title>Նոր հաղորդագրություն կայքից</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        strong {
            color: #000;
        }
        @media only screen and (max-width: 600px) {
            .container {
                padding: 15px 20px;
            }
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="https://edhouse.am/images/logo.png" alt="EdHouse Logo" style="max-width: 150px;">
    </div>
    <h2>Նոր հաղորդագրություն կայքից</h2>

    <p><strong>Անուն:</strong> {{ $data['name'] }}</p>
    <p><strong>Հեռախոս:</strong> {{ $data['phone'] ?? 'չկա' }}</p>
    <p><strong>Էլ․ փոստ:</strong> {{ $data['email'] }}</p>
    <p><strong>Հաղորդագրություն:</strong></p>
    <p>{{ $data['message'] }}</p>
</div>
</body>
</html>

