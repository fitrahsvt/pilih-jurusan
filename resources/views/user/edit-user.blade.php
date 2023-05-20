<?php
$servername='localhost';
$username='root';
$password='';
$dbname = "db_arkatama";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if($conn->connect_error){
	die('Tidak bisa terhubung ke MySQL:' .$conn->connect_error);
}
$sql1 = "SELECT * FROM users where id = '". $_GET['id'] . "'";
$result = $conn -> query($sql1);
$row = $result->fetch_assoc();

?>
<html>
    <head>
        <title>Edit User</title>
        <meta charset="UTF-8">
        <meta name="description" contents="">
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
    </head>
	<body class="bodystyle">
<br><h2>Edit Pengguna</h2>
    <form name="form1" action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input name= "name" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo $row['name']; ?>">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Role</label>
                <select name= "role" class="form-select">
                    <?php
                    if ($row['role']=="admin") { ?>
                        <option>Pilih Role</option>
                        <option value="admin" selected>Admin</option>
                        <option value="staff">Staff</option>
                    <?php
                    } else {?>
                        <option>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="staff"selected>Staff</option>
                    <?php
                    }?>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Recipient's username" value="<?php echo $row['password']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" placeholder="name@example.com" value="<?php echo $row['email']; ?>">
            </div>
            <div class="col">
                <label class="form-label">Telp</label>
                <input name="phone" type="text" class="form-control" placeholder="08xxxxx" value="<?php echo $row['phone']; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="address" class="form-control" rows="3"><?php echo $row['address']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Unggah Foto</label>
            <input name="f1" class="form-control" type="file">
        </div>
        <input type="submit" name="save" value="Simpan Data" class="btn btn-success">
        <a href="user" class="btn btn-danger">batal</a>
    </form>
    <?php
    if (isset($_POST["save"])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        if ($_FILES['f1']['tmp_name']==null) {
            $sql = "UPDATE users set
            name='" . $name . "',
            role='" . $role . "',
            password='" . $password . "',
            email='" . $email . "',
            phone='" . $phone . "',
            address='" . $address . "'
            WHERE id='" . $_GET['id'] . "'";
        }else{
            $image = addslashes(file_get_contents($_FILES['f1']['tmp_name']));
            $sql = "UPDATE users set
            name='" . $name . "',
            role='" . $role . "',
            password='" . $password . "',
            email='" . $email . "',
            phone='" . $phone . "',
            address='" . $address . "',
            avatar='" . $image ."'
            WHERE id='" . $_GET['id'] . "'";
        }
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        ?>
        <script>
            alert("Data Berhasil disimpan!")
            window.location.href = 'display-user.php';
        </script>
        <?php
    }
    ?>
	</body>
</html>

