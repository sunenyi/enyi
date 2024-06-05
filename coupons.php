<?php
require_once("../db_connect.php");

// 获取所有优惠券的总数
$sqlALL = "SELECT * FROM coupons WHERE valid=1";
$resultAll = $conn->query($sqlALL);
$allUserCount = $resultAll->num_rows;

// 默认分页和排序
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$perPage = 10;
$firstItem = ($page - 1) * $perPage;
$order = isset($_GET["order"]) ? $_GET["order"] : 'id_asc';
$type = isset($_GET["category"]) ? $_GET["category"] : '';
$pageCount = ceil($allUserCount / $perPage);

// 构建分类条件子句
$typeCondition = '';
if ($type === '金額') {
  $typeCondition = "AND category='金額'";
} elseif ($type === '百分比') {
  $typeCondition = "AND category='百分比'";
}


// 构建排序子句
switch ($order) {
  case "id_desc":
    $orderClause = "ORDER BY id DESC";
    break;
  case "id_asc":
    $orderClause = "ORDER BY id ASC";
    break;
  case "name_desc":
    $orderClause = "ORDER BY name DESC";
    break;
  case "name_asc":
    $orderClause = "ORDER BY name ASC";
    break;
  case "code_desc":
    $orderClause = "ORDER BY code DESC";
    break;
  case "code_asc":
    $orderClause = "ORDER BY code ASC";
    break;
  case "category_desc":
    $orderClause = "ORDER BY category DESC";
    break;
  case "category_asc":
    $orderClause = "ORDER BY category ASC";
    break;
  case "discount_desc":
    $orderClause = "ORDER BY discount DESC";
    break;
  case "discount_asc":
    $orderClause = "ORDER BY discount ASC";
    break;
  case "min_spend_amount_desc":
    $orderClause = "ORDER BY min_spend_amount DESC";
    break;
  case "min_spend_amount_asc":
    $orderClause = "ORDER BY min_spend_amount ASC";
    break;
  case "stock_desc":
    $orderClause = "ORDER BY stock DESC";
    break;
  case "stock_asc":
    $orderClause = "ORDER BY stock ASC";
    break;
  case "start_time_desc":
    $orderClause = "ORDER BY start_time DESC";
    break;
  case "start_time_asc":
    $orderClause = "ORDER BY start_time ASC";
    break;
  case "end_time_desc":
    $orderClause = "ORDER BY end_time DESC";
    break;
  case "end_time_asc":
    $orderClause = "ORDER BY end_time ASC";
    break;
  case "status_asc":
  case "status_desc":
    $orderClause = "ORDER BY status " . ($order == "status_asc" ? "ASC" : "DESC");
    break;
  default:
    $orderClause = "ORDER BY id ASC";
    break;
}



// 搜索处理
if (isset($_GET["search"])) {
  $search = $conn->real_escape_string($_GET["search"]);
  $sql = "SELECT *,
        CASE
            WHEN (STR_TO_DATE(start_time, '%Y-%m-%d %H:%i:%s')) < NOW() AND (STR_TO_DATE(end_time, '%Y-%m-%d %H:%i:%s')) > NOW() THEN '可使用'
            WHEN (STR_TO_DATE(start_time, '%Y-%m-%d %H:%i:%s')) > NOW() THEN '未開放'
            ELSE '已停用'
        END AS status
        FROM coupons
        WHERE (name LIKE '%$search%' OR code LIKE '%$search%') AND valid=1";
} else {
  // 分页和排序处理
  $sql = "SELECT *,
        CASE
            WHEN (STR_TO_DATE(start_time, '%Y-%m-%d %H:%i:%s')) < NOW() AND (STR_TO_DATE(end_time, '%Y-%m-%d %H:%i:%s')) > NOW() THEN '可使用'
            WHEN (STR_TO_DATE(start_time, '%Y-%m-%d %H:%i:%s')) > NOW() THEN '未開放'
            ELSE '已停用'
        END AS status
        FROM coupons
        WHERE valid=1 $typeCondition $orderClause
        LIMIT $firstItem, $perPage";
}

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$userCount = $result->num_rows;

if (!isset($_GET["search"]) && !isset($_GET["category"])) {
  $userCount = $allUserCount;
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
  <!-- fontawesome -->
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
      <h1>優惠券清單</h1>
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
      <div>
        <?php if (isset($_GET["search"])) : ?>
          <a href="coupons.php?page=1&order=id_asc"><button class="btn btn-custom "><i class="fa-solid fa-arrow-left"></i></button></a>
        <?php endif; ?>
      </div>

      <div class="d-flex pb-4">
        <form action="" class="me-3 flex-grow-1">
          <div class="input-group "> <!-- 搜尋框 -->

            <input type="text" class="form-control" placeholder="請輸入優惠券名稱或代碼" name="search">
            <button class="btn btn-custom " type="submit">
              <i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
        <div class="">
          <a class="btn btn-custom" href="create-coupon.php" title="增加優惠券"><i class="fa-solid fa-ticket "></i></a>
        </div>
      </div>
      <div class="pb-4 d-flex justify-content-between ">
        <div>
          共<?= $userCount ?>張
        </div>
        <!-- <?php if (isset($_GET["page"])) : ?>
          <div>

            排序：<div class="btn-group">
              <a href="?page=<?= $page ?>&order=1" class="btn btn-primary <?php if ($order == 1) echo "active" ?> ">id<i class="fa-solid fa-arrow-down-short-wide"></i></a>
              <a href="?page=<?= $page ?>&order=2" class="btn btn-primary <?php if ($order == 2) echo "active" ?>">id<i class="fa-solid fa-arrow-down-wide-short"></i></a>
            </div>
          </div>
        <?php endif; ?> -->
        <div>
          <!-- 😀😀 -->
          <form action="" method="GET" id="filter-form">
            <select name="category" class="form-select" onchange="filterCoupons()">
              <option value="">所有種類</option>
              <option value="金額">金額</option>
              <option value="百分比">百分比</option>
            </select>
          </form>
        </div>
      </div>
      <div class="">
        <table class="table table-striped text-nowrap ">
          <thead class="table-header">
            <!-- //⭐︎⭐︎⭐︎ 排序 -->
            <th>ID<a href="?page=<?= $page ?>&order=<?= $order == 'id_asc' ? 'id_desc' : 'id_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a></th>
            <th>優惠券名稱<a href="?page=<?= $page ?>&order=<?= $order == 'name_asc' ? 'name_desc' : 'name_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a></th>
            <th>代碼<a href="?page=<?= $page ?>&order=<?= $order == 'code_asc' ? 'code_desc' : 'code_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>種類<a href="?page=<?= $page ?>&order=<?= $order == 'category_asc' ? 'category_desc' : 'category_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>折扣面額<a href="?page=<?= $page ?>&order=<?= $order == 'discount_asc' ? 'discount_desc' : 'discount_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a></th>
            <th>低消金額<a href="?page=<?= $page ?>&order=<?= $order == 'min_spend_amount_asc' ? 'min_spend_amount_desc' : 'min_spend_amount_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>數量<a href="?page=<?= $page ?>&order=<?= $order == 'stock_asc' ? 'stock_desc' : 'stock_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>開始時間<a href="?page=<?= $page ?>&order=<?= $order == 'start_time_asc' ? 'start_time_desc' : 'start_time_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>結束時間<a href="?page=<?= $page ?>&order=<?= $order == 'end_time_asc' ? 'end_time_desc' : 'end_time_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>
            <th>狀態<a href="?page=<?= $page ?>&order=<?= $order == 'status_asc' ? 'status_desc' : 'status_asc' ?>"><i class="fa-solid fa-sort sort-icon"></i></a>
            </th>

            <th></th>
          </thead>
          <tbody class="status-colors">
            <?php foreach ($rows as $coupon) : ?>


              <?php
              // $status=$coupon['status'];
              $statusClass = '';
              switch ($coupon['status']) {
                case '可使用':
                  $statusClass = 'status-available';
                  break;
                case '未開放':
                  $statusClass = 'status-not-open';
                  break;
                case '已停用':
                  $statusClass = 'status-disabled';
                  break;
              }
              ?>
              <tr class="align-middle">
                <td><?= $coupon["id"] ?></td>
                <td><?= $coupon["name"] ?></td>
                <td><?= $coupon["code"] ?></td>
                <td><?= $coupon["category"] ?></td>
                <td><?= $coupon["discount"] ?></td>
                <td><?= $coupon["min_spend_amount"] ?></td>
                <td><?= $coupon["stock"] ?></td>
                <td><?= $coupon["start_time"] ?></td>
                <td><?= $coupon["end_time"] ?></td>

                <td>
                  <p id="<?= $statusClass ?>" class="status-custom"><?= $coupon["status"] ?></p>
                </td>

                <td>
                  <a class="btn " href="coupon.php?id=<?= $coupon["id"] ?>"><i class="fa-regular fa-eye eye-icon"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if (isset($_GET["page"])) : ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                <li class="page-item
                        <?php if ($i == $page) echo "active" ?>"><a class="page-link" href="?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
              <?php endfor; ?>
            </ul>
          </nav>
        <?php endif; ?>
      </div>
    </div>

  </main>
  <!-- 😀😀😀 -->
  <script>
  function filterCoupons() {
    const selectedCategory = document.getElementById('filter-form').category.value;

    // 检查是否选择了所有类别，如果是，则直接修改链接
    if (selectedCategory === '') {
      localStorage.setItem('selectedCategory', '');
      const currentPage = <?php echo $page; ?>;
      const currentOrder = '<?php echo $order; ?>';
      const filterLink = `coupons.php?page=${currentPage}&order=${currentOrder}`;
      window.location.href = filterLink;
    } else {
      localStorage.setItem('selectedCategory', selectedCategory);
      document.getElementById('filter-form').submit();
    }
  }

  window.onload = function() {
    const storedCategory = localStorage.getItem('selectedCategory');
    if (storedCategory !== null) {
      document.getElementById('filter-form').category.value = storedCategory;
    } else {
      document.getElementById('filter-form').category.value = '';
    }
  }
</script>




</body>

</html>