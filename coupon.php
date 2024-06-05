<?php

if (!isset($_GET["id"])) {
    $id = 1;  //就算沒資料也會預設id=1 (帶第一筆資料)
} else {
    $id = $_GET["id"];
}
require_once("../db_connect.php");

$sql = "SELECT * FROM coupons WHERE id=$id AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $couponExit = true;
} else {
    $couponExit = false;
}


?>
<!doctype html>
<html lang="en">


<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include("ne-css.php") ?>
    <style>
        :root {
            --aside-witch: 200px;
            --header-height: 50px;
        }

        .logo {
            width: var(--aside-witch);
        }

        .aside-left {
            padding-top: var(--header-height);
            width: var(--aside-witch);
            top: 20px;
            overflow: auto;
        }

        .main-content {
            margin: var(--header-height) 0 0 var(--aside-witch);
        }
    </style>
</head>

<body>
    <header class="main-header bg-dark d-flex fixed-top shadow justify-content-between align-items-center">
        <a href="" class="p-3 bg-black text-white text-decoration-none">
            tea
        </a>

        <div class="text-white me-3">
            Hi,adain
            <a href="" class="btn btn-dark">登入</a>
            <a href="" class="btn btn-dark">登出</a>
        </div>
    </header>
    <aside class="aside-left position-fixed bg-white border-end vh-100 ">
        <ul class="list-unstyled">
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-house-fill me-2"></i>首頁
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-cart4 me-2"></i></i>商品
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-cash me-2"></i>優惠券
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-flag me-2"></i>課程
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-clipboard2-data me-2"></i> 訂單
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-book me-2"></i> 文章管理
                </a>
            </li>
            <li>
                <a class="d-block p-2 px-3 text-decoration-none" href="">
                    <i class="bi bi-paypal me-2"></i> 付款方式
                </a>
            </li>

        </ul>
    </aside>
    <main class="main-content p-3">
        <div class="d-flex justify-content-between">
            <h1>優惠券資訊</h1>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        </div>
        <hr>
        <!---------------------------------------------這裡是內容 ------------------------------------->
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">刪除優惠券</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        確定要刪除嗎？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <a href="coupon-delete.php?id=<?= $row["id"] ?>" class="btn btn-danger">確認</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="py-2">
                <a class="btn btn-custom" href="coupons.php?page=1&order=id_asc"><i class="fa-solid fa-arrow-left"></i>優惠券列表</a>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-12">
                    <?php if ($couponExit) : ?>
                        <table class="table table-coupon table-bordered">
                            <tr >
                                <th >ID</th>
                                <td><?= $row["id"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券名稱</th>
                                <td><?= $row["name"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券代碼</th>
                                <td><?= $row["code"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券種類</th>
                                <td><?= $row["category"] ?></td>
                            </tr>
                            <tr>
                                <th>折扣面額</th>
                                <td><?= $row["discount"] ?></td>
                            </tr>
                            <tr>
                                <th>最低消費金額</th>
                                <td><?= $row["min_spend_amount"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券數量</th>
                                <td><?= $row["stock"] ?></td>
                            </tr>
                            <tr>
                                <th>優惠券狀態</th>
                                <td>
                                    <?php $starttime = strtotime($row["start_time"]);
                                    $endtime = strtotime($row["end_time"]);
                                    $now = time(); // 当前时间的时间戳
                                    if ($endtime - $now > 0 && $starttime - $now < 0) {
                                        // 當結束日期晚於今天 以及 開始日期早於今天
                                        $row["status"] = "可使用";
                                        echo "可使用";
                                    } elseif ($starttime - $now > 0) {
                                        // 開始日期晚於今天
                                        $row["status"] = "未開放";
                                        echo "未開放";
                                    } else {
                                        $row["status"] = "已停用";
                                        echo "已停用";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>開始時間</th>
                                <td><?= $row["start_time"] ?></td>
                            </tr>
                            <tr>
                                <th>結束時間</th>
                                <td><?= $row["end_time"] ?></td>
                            </tr>

                        </table>
                        <div class="py-2 d-flex justify-content-between ">
                            <a class="btn btn-custom " href="coupon-edit.php?id=<?= $row["id"] ?>" title="編輯優惠券"><i class="fa-solid fa-pen-to-square"></i></a>

                            <button class="btn btn-custom-d " title="刪除優惠券" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    <?php else : ?>
                        <h1>優惠券不存在</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>










    </main>
</body>

</html>