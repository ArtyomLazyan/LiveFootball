<?php require ROOT . "/views/layouts/header.php"; ?>
<section id="mainContent">
<div class="content_bottom">
  <div class="col-lg-8 col-md-8">
    <div class="content_bottom_left">
        <div class="card">
          <div class="cabinet_logo">
              <img src="/includes/img/Live-Football.jpg">
          </div>
          <div class="card_wrapper">
            <h1><?=$user["name"]; ?></h1>
            <p class="title"><?=$user["email"]; ?></p>
            <p>LiveFootball.pro</p>
            <p><a href="/"><button>Գլխավոր</button></a></p>
          </div>
      </div>
        <div class="col-lg-6 col-md-6">
            <h5>Շնորհակալություն Գրանցման համար</h5>
        </div>
    </div>
  </div>
  <?php include ROOT . "/views/layouts/sidebar.php"; ?>
</div>
</section>
</div>
<?php require ROOT . "/views/layouts/footer.php"; ?>
