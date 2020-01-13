<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Admin</title>
</head>

<body>
    <?php include 'connect.php';
    session_start();
    if ($_SESSION['isAdmin'] == 0){
        header('location:' . 'http://localhost:8080/learnphp/Internship_TastyFood/index.php');
    }
    ?>
    <div class="container-header">
        <a href="http://localhost:8080/learnphp/Internship_TastyFood/index.php"><img class=" logo" src="logo.png" alt="Hình ảnh logo"></a>
        <h1 class="title">Quản lý thông tin địa điểm ẩm thực</h1>
        
        <a class="btn btn-primary" href="http://localhost:8080/learnphp/Internship_TastyFood/addadmin.php" role="button"><b>Thêm Mới</b></a>
        <?php
        if (!empty($_SESSION['username'])){
            echo "<a class='btn btn-warning' role='button'>" . $_SESSION['fullname'] . "</a>";
            echo "<form action='logout.php'>
                    <button type='submit' class='btn btn-warning'>Đăng xuất</button>
                </form>";
        }
        ?>
    </div>

    <div class="container-main">
        <table class="table table-striped">
            <?php
            $sql = "SELECT * FROM mon_an";
            $result = mysqli_query($conn, $sql);
            ?>
            <thead>
                <tr>
                    <th scope="col">Mã món ăn</th>
                    <th scope="col">Tên món ăn</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Mã Danh Mục</th>
                    <th scope="col">Mã Ẩm Thực</th>
                    <th scope="col">Mã Phường</th>
                    <th scope="col">Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                    <td>" . $row[0] . "</td>
                    <td class='td-tenmonan'><a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $row[0] . "' >" . $row[1] . "</a></td>
                    <td>" . $row[3] . "</td>
                    <td><a href='http://localhost:8080/learnphp/Internship_TastyFood/detail.php?id=" . $row[0] . "' ><img src='./image/" . $row[5] . "' class='card-img-top fix-size' alt='...'></a></td>
                    <td>" . $row[8] . "</td>
                    <td>" . $row[9] . "</td>
                    <td>" . $row[10] . "</td>
                    <td>
						<a class='btn btn-primary' href='http://localhost:8080/learnphp/Internship_TastyFood/updateAdmin.php?MaMonAn=$row[0]'>Sửa</a>
						<a class='btn btn-danger' href='http://localhost:8080/learnphp/Internship_TastyFood/deleteAdmin.php?MaMonAn=$row[0]'>Xóa</a>
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    mysqli_close($conn);
    ?>

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