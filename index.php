<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="indexStyle.css">
    <title>Tasty Food</title>
</head>

<body>
    <?php include 'connect.php';
    session_start()?>

    <!-- header -->
    <div class="container-header">
        <a href="http://localhost:8080/learnphp/Internship_TastyFood/index.php"><img class=" logo" src="logo.png" alt="Hình ảnh logo"></a>
        <h1 class="title">Tìm kiếm địa điểm ẩm thực bạn ưa thích</h1>
        <?php
        // Kiểm tra đã có đăng nhập hay chưa để show button
        if (!empty($_SESSION['username'])){
            echo "<a class='btn btn-warning' href='http://localhost:8080/learnphp/Internship_TastyFood/admin.php' role='button'>" . $_SESSION['fullname'] . "</a>";
            echo "<form action='logout.php'>
                    <button type='submit' class='btn btn-warning'>Đăng xuất</button>
                </form>";
        }else {
            echo "
                <a class='btn btn-warning' href='http://localhost:8080/learnphp/Internship_TastyFood/login.php' role='button'><b>Đăng nhập</b></a>
                <a class='btn btn-warning' href='http://localhost:8080/learnphp/Internship_TastyFood/signup.php' role='button'><b>Đăng ký</b></a>
                ";
        }
        ?>
    </div>

    <!-- slider -->
    <div class="slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./image/slider1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./image/slider2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./image/slider3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./image/slider4.jpg" alt="Fourth slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <form class="container-search">
        <select class="custom-select" name="danhmuc">
            <?php
            $danhmuc = isset($_GET['danhmuc']) ? $_GET['danhmuc'] : '';
            $sql = "SELECT * FROM danh_muc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option " . ($danhmuc == $row[0] ? 'selected' : '') . " value=" . $row[0] . ">" . $row[1] . "</option>";
                }
            }
            ?>
        </select>
        <select class="custom-select" name="amthuc">
            <?php
            $amthuc = isset($_GET['amthuc']) ? $_GET['amthuc'] : '';
            $sql = "SELECT * FROM am_thuc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option " . ($amthuc == $row[0] ? 'selected' : '') . " value=" . $row[0] . ">" . $row[1] . "</option>";
                }
            }
            ?>
        </select>
        <select class="custom-select" name="xaphuong">
            <?php
            $xaphuong = isset($_GET['xaphuong']) ? $_GET['xaphuong'] : '';
            $sql = "SELECT * FROM xa_phuong";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option " . ($xaphuong == $row[0] ? 'selected' : '') . " value=" . $row[0] . ">" . $row[1] . "</option>";
                }
            }
            ?>
        </select>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm... " name="inputname" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" id="button-addon2">Tìm Kiếm</button>
            </div>
        </div>
    </form>

    <div class="container-main">
        <?php
        $sql = "SELECT * FROM mon_an";
        $result = mysqli_query($conn, $sql);
        $i = 0;
        $danhmuc = 'DM01';
        $amthuc = 'AT01';
        $xaphuong = 'XP01';
        $inputname = '';
        if (mysqli_num_rows($result) != 0) {
            if (isset($_GET['danhmuc'])) {
                $danhmuc = $_GET['danhmuc'];
            }
            if (isset($_GET['amthuc'])) {
                $amthuc = $_GET['amthuc'];
            }
            if (isset($_GET['xaphuong'])) {
                $xaphuong = $_GET['xaphuong'];
            }
            if (isset($_GET['inputname'])) {
                $inputname = $_GET['inputname'];
            }
            while ($row = mysqli_fetch_array($result)) {
                if (($inputname == '' || strpos(strtolower($row[1]), strtolower($inputname)) != false)) {
                    if ($row[8] === $danhmuc || $danhmuc === "DM01") {
                        if ($row[9] === $amthuc || $amthuc === "AT01") {
                            if ($row[10] === $xaphuong || $xaphuong === "XP01") {
                                if ($i == 5) {
                                    $i = 0;
                                    echo "</div>";
                                }
                                $card = "<div class='card' style='width: 15rem;'>
                                            <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $row[0] . "' ><img src='./image/" . $row[5] . "' class='card-img-top' alt='...'></a>
                                            <div class='card-body'>
                                                <h5 class='card-title'>" . $row[1] . "</h5>
                                                <p class='card-address'>" . "<b>Địa chỉ: </b>" . $row[2] . "</p>
                                                <p class='card-price'>" . "<b>Giá: </b>" . $row[3] . "</p>
                                                <p class='card-phone'>" . "<b>Số Điện Thoại: </b>" . $row[4] . "</p>
                                                <p class='card-text'>" . "<b>Đánh giá: </b>" . $row[6] . " sao" . "</p>
                                                <a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $row[0] . "'  class='btn btn-warning'>Thông tin chi tiết</a>
                                            </div>
                                        </div>
                                    ";
                                if ($i == 0) {
                                    $i = 0;
                                    echo "<div class='container-card w-100'>";
                                    echo $card;
                                } else {
                                    echo $card;
                                }
                                $i++;
                            }
                        }
                    }
                }
            }
        }
        ?>
    </div>
    <?php
    mysqli_close($conn);
    ?>

    <hr>
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
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
</body>

</html>