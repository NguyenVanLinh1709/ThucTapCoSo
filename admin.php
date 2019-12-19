<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Tasty Food</title>
</head>

<body>
    <?php
    // kết nối csdl
    $conn = mysqli_connect('localhost', 'root', '', 'intership_food')
        or die('Không thể kết nối tới database' . mysqli_connect_error());
    mysqli_set_charset($conn, 'UTF8');
    ?>
    <?php
    $sql= "INSERT INTO 'mon_an'(
        'MaMonAn', 'TenMonAn', 'DiaChi', 'Gia', 'SoDienThoai', 
        'HinhAnh', 'DanhGia', 'MoTa', 'MaDanhMuc', 'MaAmThuc', 'MaPhuong') 
        VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])";
    $result = mysqli_query($conn, $sql);
    if (!$result){  
    die ('Câu truy vấn bị sai');
    }
    ?>
    <div class="container-header">
        <img class="logo" src="logo.png" alt="Hình ảnh logo">
        <h1 class="banner-title">Tìm kiếm và đặt ngay món ăn bạn ưa thích</h1>
    </div>

    <hr>

    <h1 class="main-title">Thêm mới thông tin món ăn </h1>

    <hr>

    <div class="container-main">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Mã món ăn</label>
                <div class="col-sm-10">
                    <input type="text" name="mamonan" class="form-control" id="inputEmail3" placeholder="Mã món ăn (MA)...">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Tên món ăn</label>
                <div class="col-sm-10">
                    <input type="text" name="tenmonan" class="form-control" id="inputPassword3" placeholder="Tên món ăn...">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Địa chỉ</label>
                <div class="col-sm-10">
                    <input type="text" name="diachi" class="form-control" id="inputPassword3" placeholder="Địa chỉ...">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Giá</label>
                <div class="col-sm-10">
                    <input type="number" name="gia" class="form-control" id="inputPassword3" placeholder="Giá...">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Số điện thoại</label>
                <div class="col-sm-10">
                    <input type="tel" name="sdt" class="form-control" id="inputPassword3" placeholder="Số điện thoại...">
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Đánh giá</legend>
                    <div class="col-sm-10">
                        <div class="form-check custom-control-inline">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                1 sao
                            </label>
                        </div>
                        <div class="form-check custom-control-inline">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                2 sao
                            </label>
                        </div>
                        <div class="form-check custom-control-inline">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                            <label class="form-check-label" for="gridRadios3">
                                3 sao
                            </label>
                        </div>
                        <div class="form-check custom-control-inline">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option4">
                            <label class="form-check-label" for="gridRadios3">
                                4 sao
                            </label>
                        </div>
                        <div class="form-check custom-control-inline">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option5">
                            <label class="form-check-label" for="gridRadios3">
                                5 sao
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="form-group custom-control-inline">
                <label for="exampleFormControlFile1" class="text-select-image">Chọn hình ảnh</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Mô tả</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="container-search">
                <select class="custom-select">
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
                <select class="custom-select">
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
                <select class="custom-select">
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
            </div>

            <div class="form-group row custom-control-inline">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>

            <div class="form-group row custom-control-inline">
                <div class="col-sm-10">
                    <button type="reset" class="btn btn-primary">Nhập lại</button>
                </div>
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>