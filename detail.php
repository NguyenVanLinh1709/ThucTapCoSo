<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="detailStyle.css">
    <title>Detail Tasty Food</title>
</head>

<body>
    <?php include 'connect.php';
    session_start() ?>

    <div class="container-header">
        <a href="http://localhost:8080/learnphp/Internship_TastyFood/index.php"><img class=" logo" src="logo.png" alt="Hình ảnh logo"></a>
        <h1 class="banner-title">Thông tin chi tiết địa điểm ẩm thực</h1>
        <?php
        if (!empty($_SESSION['username'])) {
            echo "<a class='btn btn-warning' style='height:38px; padding-right: 20p' role='button'>" . $_SESSION['fullname'] . "</a>";
            echo "<form action='logout.php'>
                    <button type='submit' class='btn btn-warning'>Đăng xuất</button>
                </form>";
        } else {
            echo "
            <a class='btn btn-warning' style='height:38px; margin-right: 20px' href='http://localhost:8080/learnphp/Internship_TastyFood/login.php' role='button'><b>Đăng nhập</b></a>
            <a class='btn btn-warning' style='height:38px; href='http://localhost:8080/learnphp/Internship_TastyFood/signup.php' role='button'><b>Đăng ký</b></a>
            ";
        }
        ?>
    </div>

    <hr>

    <div class="container-main">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM mon_an 
                LEFT JOIN danh_muc ON mon_an.MaDanhMuc = danh_muc.MaDanhMuc 
                LEFT JOIN am_thuc ON mon_an.MaAmThuc = am_thuc.MaAmThuc 
                LEFT JOIN xa_phuong ON mon_an.MaPhuong = xa_phuong.MaPhuong
                WHERE MaMonAn = '$id' 
                ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo "Don't write on URL please!!!";
        } else {
            $row = mysqli_fetch_array($result);
            echo "
            <div class='img'>
                <img src='./image/" . $row[5] . "' class='main-img' alt=''>
            </div>
            <div class='detail'>
                <h4 class='title clmargin-40'>" . $row[1] . "</h4>
                <p class='address clmargin-10'><b>Địa chỉ: </b>" . $row[2] . "</p>
                <p class='gia clmargin-10'><b>Giá: </b>" . $row[3] . "</p>
                <p class='sodienthoai clmargin-10'><b>Số điện thoại: </b>" . $row[4] . "</p>
                <p class='danhgia clmargin-10'><b>Đánh giá: </b>" . $row[6] . " sao" . "</p>
                <p class='mota clmargin-10'><b>Mô tả: </b>" . $row[7] . "</p>
            </div>
            ";
        }
        ?>
    </div>
    <div class="comment">
        <?php
        if (!empty($_SESSION['username']) && $_SESSION['isAdmin'] == '0') {
            echo "
                <form method='POST' enctype='multipart/form-data'>
                <div class='form-group'>
                    <textarea class='form-control' id='exampleFormControlTextarea1' name='nhanxet' placeholder='Thêm nhận xét...' rows='2'></textarea>
                    <button type='submit' class='btn btn-warning'>Thêm nhận xét</button>
                </div>
            ";
            $nhanxet = '';
            $username = $_SESSION['username'];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nhanxet = trim($_POST['nhanxet']);
                $sql_them_cmt = "INSERT INTO `nhan_xet`(`nhan_xet`, `MaMonAn`, `username`) 
                                    VALUES ('$nhanxet', '$id', '$username')";
                mysqli_query($conn, $sql_them_cmt);
            }
        }
        ?>
        </form>
    </div>
    <hr>

    <h3 class="main-title fix-padding">Một số nhận xét của người dùng</h3>
    <div class="comment">
        <?php
        $sqlcmt = "SELECT * FROM nhan_xet
                    LEFT JOIN users
                    ON nhan_xet.username = users.username
                    WHERE MaMonAn = '$id'";
        $resultcmt = mysqli_query($conn, $sqlcmt);
        while ($rowcmt = mysqli_fetch_array($resultcmt)) {
            echo $rowcmt[6] . ": " . $rowcmt[1] . "<br>";
        }
        ?>
    </div>
    <hr>

    <h3 class="main-title fix-padding">Một số gợi ý thêm cho bạn</h3>
    <br>

    <div class="container-more">
        <h4 class="main-title">Theo Danh Mục</h4>
        <div class='container-danhmuc'>
            <?php
            $sqldanhmuc = "SELECT * FROM mon_an
                            WHERE MaDanhMuc = '$row[11]'";
            $resultdanhmuc = mysqli_query($conn, $sqldanhmuc);
            $rowdanhmuc = mysqli_fetch_array($resultdanhmuc);
            while ($rowdanhmuc = mysqli_fetch_array($resultdanhmuc)) {
                echo "<div class='card' style='width: 15rem;'>
                        <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowdanhmuc[0] . "'><img src='./image/" . $rowdanhmuc[5] . "' class='card-img-top' alt='...'></a>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $rowdanhmuc[1] . "</h5>
                                <p class='card-address'>" . "<b>Địa chỉ: </b>" . $rowdanhmuc[2] . "</p>
                                <p class='card-price'>" . "<b>Giá: </b>" . $rowdanhmuc[3] . "</p>
                                <p class='card-phone'>" . "<b>Sđt: </b>" . $rowdanhmuc[4] . "</p>
                                <p class='card-text'>" . "<b>Đánh giá: </b>" . $rowdanhmuc[6] . " sao" . "</p>
                                <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowdanhmuc[0] . "' class='btn btn-warning'>Thông tin chi tiết</a>
                            </div>
                    </div>
                ";
            }
            ?>
        </div>
        <br>
        <h4 class="main-title">Theo Ẩm Thực</h4>
        <div class="container-amthuc">
            <?php
            $sqlamthuc = "SELECT * FROM mon_an
                            WHERE MaAmThuc = '$row[13]'";
            $resultamthuc = mysqli_query($conn, $sqlamthuc);
            $rowamthuc = mysqli_fetch_array($resultamthuc);
            while ($rowamthuc = mysqli_fetch_array($resultamthuc)) {
                echo "<div class='card' style='width: 15rem;'>
                        <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowamthuc[0] . "' ><img src='./image/" . $rowamthuc[5] . "' class='card-img-top' alt='...'></a>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $rowamthuc[1] . "</h5>
                                <p class='card-address'>" . "<b>Địa chỉ: </b>" . $rowamthuc[2] . "</p>
                                <p class='card-price'>" . "<b>Giá: </b>" . $rowamthuc[3] . "</p>
                                <p class='card-phone'>" . "<b>Sđt: </b>" . $rowamthuc[4] . "</p>
                                <p class='card-text'>" . "<b>Đánh giá: </b>" . $rowamthuc[6] . " sao" . "</p>
                                <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowamthuc[0] . "'  class='btn btn-warning'>Thông tin chi tiết</a>
                            </div>
                        </div>
                    ";
            }
            ?>
        </div>
        <br>
        <h4 class="main-title">Theo Xã Phường</h4>
        <div class="container-xaphuong">
            <?php
            $sqlxaphuong = "SELECT * FROM mon_an
                            WHERE MaPhuong = '$row[15]'";
            $resultxaphuong = mysqli_query($conn, $sqlxaphuong);
            $rowxaphuong = mysqli_fetch_array($resultxaphuong);
            while ($rowxaphuong = mysqli_fetch_array($resultxaphuong)) {
                echo "<div class='card' style='width: 15rem;'>
                        <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowxaphuong[0] . "' ><img src='./image/" . $rowxaphuong[5] . "' class='card-img-top' alt='...'></a>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $rowxaphuong[1] . "</h5>
                                <p class='card-address'>" . "<b>Địa chỉ: </b>" . $rowxaphuong[2] . "</p>
                                <p class='card-price'>" . "<b>Giá: </b>" . $rowxaphuong[3] . "</p>
                                <p class='card-phone'>" . "<b>Sđt: </b>" . $rowxaphuong[4] . "</p>
                                <p class='card-text'>" . "<b>Đánh giá: </b>" . $rowxaphuong[6] . " sao" . "</p>
                                <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $rowxaphuong[0] . "'  class='btn btn-warning'>Thông tin chi tiết</a>
                            </div>
                        </div>
                    ";
            }
            ?>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
    <br>

    <div class="container-footer">
        <!-- Footer -->
        <footer class="page-footer font-small mdb-color pt-4">
            <!-- Footer Links -->
            <div class="container text-center text-md-left">
                <!-- Footer links -->
                <div class="row text-center text-md-left mt-3 pb-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">TastyFood</h6>
                        <p>Giúp việc lựa chọn món ăn của bạn trở nên một cách dễ dàng và tiện lợi hơn,
                            phù hợp với tất cả sở thích từ những người dễ đến những người khó tính nhất.
                        </p>
                    </div>
                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none">
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Một số trang Web khác</h6>
                        <p>
                            <a href="https://www.foody.vn/" target="_blank">Foody.vn</a>
                        </p>
                        <p>
                            <a href="https://www.now.vn/" target="_blank">Now.vn</a>
                        </p>
                        <p>
                            <a href="http://matsuya.vn/" target="_blank">Matsuya.vn</a>
                        </p>
                        <p>
                            <a href="https://lozi.vn/" target="_blank">Lozi.vn</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Chia sẻ cho bạn bè</h6>
                        <p>
                            <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                        </p>
                        <p>
                            <a href="https://www.instagram.com/" target="_blank">Instagram</a>
                        </p>
                        <p>
                            <a href="https://twitter.com/" target="_blank">Twitter</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none">
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Thông tin liên hệ</h6>
                        <p>
                            <i class="fas fa-home mr-3"></i>Tp.Nha Trang, Khánh Hoà</p>
                        <p>
                            <i class="fas fa-envelope mr-3"></i>vanlinh.58th1@gmail.com</p>
                        <p>
                            <i class="fas fa-phone mr-3"></i>0935831360</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Footer links -->
                <hr>
                <!-- Grid row -->
                <div class="row d-flex align-items-center">

                    <!-- Grid column -->
                    <div class="col-md-7 col-lg-8">

                        <!--Copyright-->
                        <p class="text-center text-md-left">© 2020 Copyright:
                            <a href="https://www.foody.vn/" target="_blank">
                                <strong>Foody.com</strong>
                            </a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-5 col-lg-4 ml-lg-0">
                        <!-- Social buttons -->
                        <div class="text-center text-md-right">
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
            <!-- Footer Links -->
        </footer>
        <!-- Footer -->
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>