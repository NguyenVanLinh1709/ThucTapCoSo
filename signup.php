<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Signup TastyFood</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="signupStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
    <?php include 'connect.php'; ?>
    <?php
    $username = $password = $fullname = '';
    ?>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <a href="http://localhost:8080/learnphp/Internship_TastyFood/index.php"><img src="logo.png" class="brand_logo" alt="Logo"></a>
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" value="" placeholder="Tài khoản">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_user" value="" placeholder="Mật khẩu">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" name="fullname" class="form-control input_user" value="" placeholder="Họ tên đầy đủ">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Đồng ý với điều khoản của chúng tôi</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn login_btn">Đăng Ký</button>
                        </div>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $errors = array();
                            if (empty($_POST['username'])) {
                                array_push($errors, "Chưa nhập mã tài khoản");
                            } else {
                                $username = trim($_POST['username']);
                            }
                            if (empty($_POST['password'])) {
                                array_push($errors, "Chưa nhập mật khẩu");
                            } else {
                                $password = trim($_POST['password']);
                            }
                            if (empty($_POST['fullname'])) {
                                array_push($errors, "Chưa nhập Họ tên đầy đủ");
                            } else {
                                $fullname = trim($_POST['fullname']);
                            }
                            if (empty($errors) == true) {
                                $sql_them_user = "INSERT INTO `users`(`username`, `password`, `fullname`) 
                            VALUES ('" . $username . "','" . $password . "','" . $fullname . "')";
                                if (mysqli_query($conn, $sql_them_user)) {
                                    echo "<h4>Đăng ký thành công</h4>";
                                } else {
                                    echo ("Error description: " . mysqli_error($conn));
                                    echo "Không thêm tài khoản được";
                                }
                            } else {
                                foreach ($errors as $x)
                                    echo $x . "<br>";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>