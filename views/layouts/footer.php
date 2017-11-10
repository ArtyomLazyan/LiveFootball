<footer id="footer">
  <div class="footer_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="single_footer_top wow fadeInLeft">
            <h2>Flicker Images</h2>
            <ul class="flicker_nav">
              <li><a href="http://livefootball.pro/articles/2"><img src="/includes/img/league_icons/premierliga-min.png" alt="premierliga"></a></li>
              <li><a href="http://livefootball.pro/articles/3"><img src="/includes/img/league_icons/bundesliga-min.png" alt="bundesliga"></a></li>
              <li><a href="http://livefootball.pro/articles/1"><img src="/includes/img/league_icons/laliga-min.png" alt="laliga"></a></li>
              <li><a href="http://livefootball.pro/articles/4"><img src="/includes/img/league_icons/liga1-min.png" alt="liga1"></a></li>
              <li><a href="http://livefootball.pro/articles/5"><img src="/includes/img/league_icons/seriaa-min.jpg" alt="seriaa"></a></li>
              <li><a href="http://livefootball.pro/articles/9"><img src="/includes/img/league_icons/armenia-min.png" alt="armenia"></a></li>
              <li><a href="http://livefootball.pro/articles/6"><img src="/includes/img/league_icons/championsleague-min.png" alt="championsleague"></a></li>
              <li><a href="http://livefootball.pro/articles/7"><img src="/includes/img/league_icons/europealeague-min.png" alt="europealeague"></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="single_footer_top wow fadeInDown">
            <h2>Labels</h2>
            <ul class="labels_nav">
                <?php foreach($categoryList as $category) : ?>
                    <li><a href="/articles/<?=$category["id"]; ?>"><?=$category["title"]; ?></a></li>
                <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="single_footer_top wow fadeInRight">
            <h2>LiveFootball.pro</h2>
            <p>Դիտեք ֆուտբոլային հանդիպումները ուղիղ եթերում</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="footer_bottom_left">
            <p>Copyright &copy; 2017 LiveFootball.pro</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="footer_bottom_right">
            <p>Developed BY LiveFootballTeam</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<script
        src="https://code.jquery.com/jquery-1.11.1.min.js"
        integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE="
        crossorigin="anonymous" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.min.js" defer></script>
<script src="/includes/js/custom.js" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script id="dsq-count-scr" src="//armprogramming-1.disqus.com/count.js" async></script>
</body>
</html>
