<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMORANGKIR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            margin-top: 20px;
            background: #e9ecef;
            padding: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>NIP CHEKER</h1>
<p><a href="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhY4o1W5kXOHahOyzRnyY4pQzVxgs9qH18FL14xY9OMLHODxn-mTyv8Urgc3RKnmwvCcDvYxQdmhFvIobuFjuIhJDylcTXOQvUI_SpN9tkOUU1AgluWxQSldSl7m5ZBOAaJp1gHcuT3pAiU/s1729/NIP+PNS.jpg" target="blank"> Klik disini untuk melihat format penulisan NIP</a></p>
        <form method="POST">
            <label for="start_id">NIP:<br><small>CTH : 200012122025061001</small></label>
          
            <input type="number" name="start_id" id="start_id" required value="">

            <label for="range">Range:</label>
            <input type="number" name="range" id="range" required value="5">

            <button type="submit">Proses</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start_id = intval($_POST["start_id"]);
            $range = intval($_POST["range"]);

            echo "<div class='result'><h3>Hasil :</h3><table border='1' cellspacing='0' cellpadding='10'>";
            echo "<tr><th>NIP</th><th>Keterangan</th></tr>";
            
            for ($i = 0; $i < $range; $i++) {
                $current_id = $start_id + $i;
                $params = [
                        'username' => "$current_id",
                        'token'    => '$2b$10$.TVfAyjpBtGMF87yLeqb7eSDg6xlr1cfsR9ZKZXtzJ5Qxt/V/EjJm',
                        'captcha'  => '0zC8'
                        ];
                $url = 'https://asndigital.bkn.go.id/api/forget-password?' . http_build_query($params);


                $json = file_get_contents($url);
                $response = $json ? json_decode($json, true) : null;

                $status  = $response['status']  ?? "(tidak ada status)";
                $message = $response['message'] ?? "(tidak ada pesan)";

                echo "<tr><td>{$current_id}</td><td>Status: {$status}, Message: {$message}</td></tr>";
            }
            echo "</table></div>";
        }
        ?>
        <label>Mohon tidak tigunakan berulang agar server bkn  tidak overload</label>
    </div>

</body>
</html>