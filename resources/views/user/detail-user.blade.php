<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            text-decoration: none;
            margin: 0px;
            padding: 0px;
        }
        body{
            margin: 0px;
            padding: 0px;
            font-family: 'Poppins';
        }
        .bodystyle{
            margin-left: 5%;
            margin-right: 5%;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Detail user</title>
</head>
<body class="bodystyle">
<br><h2>Detail Pengguna</h2>
    <?php
    if (isset($_GET['id'])) {
        $servername='localhost';
        $username='root';
        $password='';
        $dbname = "db_arkatama";
        $conn=mysqli_connect($servername,$username,$password,"$dbname");
        if($conn->connect_error){
            die('Tidak bisa terhubung ke MySQL:' .$conn->connect_error);
        }
        $sql = "SELECT * FROM users WHERE id = '" . $_GET['id'] . "'";
        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['avatar']).'" height="200" width="200"/>';
            ?>
            <table class="table table-striped">
                <tr>
                    <th scope="col">Nama</th>
                    <td>: <?php echo $row["name"]; ?></td>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <td>: <?php echo $row["email"]; ?></td>
                </tr>
                <tr>
                    <th scope="col">No Telpon</th>
                    <td>: <?php echo $row["phone"]; ?></td>
                </tr>
                <tr>
                    <th scope="col">Role</th>
                    <td>: <?php echo $row["role"]; ?></td>
                </tr>
                <tr>
                    <th scope="col">Alamat</th>
                    <td>: <?php echo $row["address"]; ?></td>
                </tr>
                <tr>
                    <th scope="col">Tanggal dibuat</th>
                    <td>: <?php echo $row["created_at"]; ?></td>
                </tr>
            </table>
            <a type="button" class="btn btn-primary" href="user">Kembali</a>
        <?php
        }
    }
    ?>
</body>
</html>
