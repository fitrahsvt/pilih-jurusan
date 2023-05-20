<?php
$servername='localhost';
$username='root';
$password='';
$dbname = "db_arkatama";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if($conn->connect_error){
	die('Tidak bisa terhubung ke MySQL:' .$conn->connect_error);
}
$sql = "SELECT * FROM users";
$result = $conn -> query($sql);
?>
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
    <title>Users Display</title>
</head>
<body class="bodystyle">
    <br>
    <h2>Data Pengguna</h2>
    <a type="button" class="btn btn-success" href="add-user">Tambah Pengguna</a>
    <a type="button" class="btn btn-danger" href="logout.php">Logout</a>
    <?php
    if ($result->num_rows > 0) {?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                while ($row = $result->fetch_assoc()) {?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><a type="button" class="btn btn-primary" href="detail-user?id=<?php echo $row["id"]; ?>">Detail</a>
                        <a type="button" class="btn btn-warning" href="edit-user?id=<?php echo $row["id"]; ?>">Edit</a>
                        <a type="button" class="btn btn-danger" onclick="showConfirm(<?php echo $row["id"] ?>)">Hapus</a></td>
                        <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['avatar']).'" height="100" width="100"/>'; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["phone"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                    </tr>
                    <?php $i++;} ?>
            </tbody>
        </table>
    <?php }
    else {
        echo "</br> Belum ada data!";
    }?>
    <script>
        function showConfirm(a) {
            if(confirm('Apakah anda yakin menghapus user ini?')){
                window.location.href = 'delete-user.php?id=' + a;
            }
        }
    </script>
</body>
</html>
