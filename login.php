<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <title>Login TastyFood</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_POST['login'])) {
        include 'connect.php';
        //Lấy dữ liệu nhập vào
        $username = ($_POST['username']);
        $password = ($_POST['password']);

        //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
        if (!$username || !$password) {
            echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }

        //Kiểm tra tên đăng nhập có tồn tại không
        $sql = "SELECT `username`, `password`, `fullname`, `isAdmin` 
                FROM `users` 
                WHERE `users`.`username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }

        //Lấy mật khẩu trong database ra
        $row = mysqli_fetch_array($result);
        
        //So sánh 2 mật khẩu có trùng khớp hay không
        if ($password != $row['password']) {
            echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }

        // if (isset($_POST['login'])) {
        //     // Lưu Session
        //     $_SESSION['name'] = $_POST['username'];
        // }
        //Lưu tên đăng nhập
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $row[2];
        $_SESSION['isAdmin'] = $row[3];
        
        echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='/'>Về trang chủ</a>";

        if ($row['isAdmin'] == 1) {
            header('location:' . 'http://localhost:8080/learnphp/Internship_TastyFood/admin.php');
            $_SESSION['isLogin'] = true;
        } else {
            header('location:' . 'http://localhost:8080/learnphp/Internship_TastyFood/index.php');
            $_SESSION['isLogin'] = true;
        }
    }
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
                            <input type="text" name="username" class="form-control input_user" value="" placeholder="tài khoản">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" placeholder="mật khẩu">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Ghi nhớ đăng nhập</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="login" class="btn login_btn">Đăng nhập</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Chưa có tài khoản? <a href="http://localhost:8080/learnphp/Internship_TastyFood/signup.php" class="ml-2" target="_blank">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>