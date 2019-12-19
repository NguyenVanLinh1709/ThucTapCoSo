<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Tasty Food</title>
</head>

<body>
    <?php
    // kết nối csdl
    $conn = mysqli_connect('localhost', 'root', '', 'intership_food')
        or die('Không thể kết nối tới database' . mysqli_connect_error());
    mysqli_set_charset($conn, 'UTF8');
    ?>

    <div class="container-header">
        <img class="logo" src="logo.png" alt="Hình ảnh logo">
        <h1 class="title">Tìm kiếm và đặt ngay món ăn bạn ưa thích</h1>
    </div>

    <hr>

    <form class="container-search">
        <select class="custom-select" name="danhmuc">
            <?php
            $sql = "SELECT * FROM danh_muc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
                }
            }
            ?>
        </select>
        <select class="custom-select" name="amthuc">
            <?php
            $sql = "SELECT * FROM am_thuc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
                }
            }
            ?>
        </select>
        <select class="custom-select" name="xaphuong">
            <?php
            $sql = "SELECT * FROM xa_phuong";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
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

    <hr>

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
                if (($inputname == '' || strpos(strtolower($row[1]), strtolower($inputname)) != false)){
                    if ($row[8] === $danhmuc || $danhmuc === "DM01") {
                        if ($row[9] === $amthuc || $amthuc === "AT01") {
                            if ($row[10] === $xaphuong || $xaphuong === "XP01") {
                                if ($i == 5) {
                                    $i = 0;
                                    echo "</div>";
                                }
                                $card = "<div class='card' style='width: 15rem;'>
                                            <img src='./image/" . $row[5] . "' class='card-img-top' alt='...'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>" . $row[1] . "</h5>
                                                <p class='card-address'>" . "<b>Địa chỉ: </b>" . $row[2] . "</p>
                                                <p class='card-price'>" . "<b>Giá: </b>" . $row[3] . "</p>
                                                <p class='card-phone'>" . "<b>Số Điện Thoại: </b>" . $row[4] . "</p>
                                                <p class='card-text'>" . "<b>Đánh giá: </b>" . $row[6] . " sao" . "</p>
                                                <a href='#' class='btn btn-primary'>Thông tin chi tiết</a>
                                            </div>
                                        </div>
                                    ";
                                if ($i == 0) {
                                    $i = 0;
                                    echo "<div class='d-flex justify-content-between w-100'>";
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>