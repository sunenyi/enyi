<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <?php include("../css.php") ?>
  <?php include("ne-css.php") ?>

</head>

<body>
  <!-- header、aside -->
  <?php include("../dashboard-comm.php") ?>
  <main class="main-content p-3">
    <div class="d-flex justify-content-between">
      <h1>新增優惠券</h1>
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
        <a href="coupons.php?page=1&order=id_asc" class="btn btn-custom"><i class="fa-solid fa-arrow-left"></i>取消新增</a>
      </div>
      <form action="doCreateCoupon.php" method="post">
        <div class="mb-2">
          <label for="" class="form-label">優惠券名稱</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">優惠券代碼</label>
          <div class="input-group">
            <input type="text" class="form-control" name="code" id="coupon-code" required>
            <button type="button" class="btn btn-outline-secondary" onclick="fillRandomCode()">生成代碼</button>
          </div>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">優惠券種類</label>
          <!-- <select class="form-select" name="category">
            <option value="金額">金額折扣</option>
            <option value="百分比">百分比折扣</option>
          </select> -->
          <div class="d-flex">
            <div class="form-check col-2">
              <input class="form-check-input" type="radio" name="category" id="amount" value="金額" required>
              <label class="form-check-label" for="amount">
                金額
              </label>
            </div>
            <div class="form-check col-2">
              <input class="form-check-input" type="radio" name="category" id="percent" value="百分比" required>
              <label class="form-check-label" for="percent">
                百分比
              </label>
            </div>
          </div>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">折扣面額</label>
          <input type="text" class="form-control" name="discount" required>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">最低消費金額</label>
          <input type="text" class="form-control" name="min_spend_amount" required>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">優惠券數量</label>
          <input type="text" class="form-control" name="stock" required>
        </div>
        <!-- <div class="mb-2 ">
          <label for="" class="form-label">優惠券狀態</label>
          <div class="d-flex">
            <div class="form-check col-2">
              <input class="form-check-input" type="radio" name="status" id="useful" value="可使用">
              <label class="form-check-label" for="useful">
                可使用
              </label>
            </div>
            <div class="form-check col-2">
              <input class="form-check-input" type="radio" name="status" id="unuseful" value="已停用">
              <label class="form-check-label" for="unuseful">
                已停用
              </label>
            </div>
          </div>
        </div> -->
        <div class="d-flex mb-2 text-nowrap">
          <div class="row">
            <div class="col-6">
              <label for="" class="form-label m-2">開始時間</label>
              <input type="datetime-local" class="form-control" name="start_time" id="start_time" required>
            </div>
            <div class="col-6">
              <label for="" class="form-label m-2">結束時間</label>
              <input type="datetime-local" class="form-control" name="end_time" id="end_time" required>
            </div>


          </div>
        </div>

        <button class="btn btn-custom" type="submit">送出</button>
      </form>
    </div>

  </main>
  <?php include("../js.php") ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var startTimeInput = document.getElementById('start_time');
      console.log(startTimeInput);

      var endTimeInput = document.getElementById('end_time');

      // 设置开始时间的最小值为当前时间
      var now = new Date().toISOString().slice(0, 16);
      startTimeInput.min = now;

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