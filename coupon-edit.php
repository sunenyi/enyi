<?php

if (!isset($_GET["id"])) {
    $id = 1;  //就算沒資料也會預設id=1 (帶第一筆資料)
} else {
    $id = $_GET["id"];
}
require_once("../db_connect.php");

$sql = "SELECT * FROM coupons WHERE id=$id ";
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
            <h1>編輯優惠券</h1>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        </div>
        <hr>
        <!---------------------------------------------這裡是內容 ------------------------------------->

        <div class="container">
            <div class="py-2">
                <a class="btn btn-custom" href="coupon.php?id=<?= $id ?>"><i class="fa-solid fa-arrow-left"></i>取消</a>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-12">
                    <?php if ($couponExit) : ?>
                        <form action="doUpdateCoupon.php" method="post">
                            <table class="table table-bordered table-coupon align-middle">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <tr>
                                    <th>ID</th>
                                    <td><?= $row["id"] ?></td>
                                </tr>
                                <tr>
                                    <th>優惠券名稱</th>
                                    <td>
                                        <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>優惠券代碼</th>
                                    <td>
                                        <input type="text" class="form-control" name="code" id="coupon-code" value="<?= $row["code"] ?>">

                                        <button type="button" class="btn btn-outline-secondary" onclick="fillRandomCode()">生成代碼</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>優惠券種類</th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="amount" value="金額" <?php if ($row["category"] == "金額") : ?>checked<?php endif ?>>
                                            <label class="form-check-label" for="amount">
                                                金額
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="percent" value="百分比" <?php if ($row["category"] == "百分比") : ?>checked<?php endif ?>>
                                            <label class="form-check-label" for="percent">
                                                百分比
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>折扣面額</th>
                                    <td>
                                        <input type="text" class="form-control" name="discount" value="<?= $row["discount"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>最低消費金額</th>
                                    <td>
                                        <input type="text" class="form-control" name="min_spend_amount" value="<?= $row["min_spend_amount"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>優惠券數量</th>
                                    <td>
                                        <input type="text" class="form-control" name="stock" value="<?= $row["stock"] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <th>開始時間</th>
                                    <td>
                                        <input type="datetime-local" class="form-control" name="start_time" id="start_time" value="<?= $row["start_time"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>結束時間</th>
                                    <td>
                                        <input type="datetime-local" class="form-control" name="end_time" id="end_time" value="<?= $row["end_time"] ?>">
                                    </td>
                                </tr>

                            </table>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-custom" type="submit">確認修改</button>

                            </div>
                        </form>
                    <?php else : ?>
                        <h1>優惠券不存在</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>



    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startTimeInput = document.getElementById('start_time');
            //   console.log(startTimeInput);
            var endTimeInput = document.getElementById('end_time');

            // 设置开始时间的最小值为当前时间
            var now = new Date().toISOString().slice(0, 16);
            //   startTimeInput.min = now;
            endTimeInput.min = startTimeInput.value;

            startTimeInput.addEventListener('change', function() {
                endTimeInput.min = startTimeInput.value;

            });
        });

        function generateRandomCode() {
            let code = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            const charactersLength = characters.length;

            for (let i = 0; i < 6; i++) {
                const randomIndex = Math.floor(Math.random() * charactersLength);
                code += characters.charAt(randomIndex);
            }

            return code;
        }

        function fillRandomCode() {
            document.getElementById('coupon-code').value = generateRandomCode();
        }

        console.log(generateRandomCode());
    </script>
</body>

</html>