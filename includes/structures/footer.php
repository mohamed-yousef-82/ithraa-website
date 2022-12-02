<footer>
    <div class="footer-bottom">
      <div class="row row-medium">
      <div class="container">
        <div class="box box-1">
          <p>
            © جميع الحقوق محفوظة لموقع ديوانية اثراء 2017
          </p>
        <a href="http://www.lamsa.esy.es"> <img src="layout/img/lamsa.png" /></a>
        </div>
      </div>
    </div>
    </div>
</footer>

</div>
</main>
</div>
</body>
</html>
<script src="<?php echo"$js" ?>/jquery-3.1.1.min.js"></script>
<script src="<?php echo"$js" ?>/scripts.js"></script>
<script src="<?php echo"$js" ?>/wow.js"></script>
<script>
  new WOW().init();
</script>
<script>
$(".goto").click(function() {
    $('html, body').animate({
        scrollTop: $(".contact").offset().top
    }, 2000);
});
</script>
<?
ob_end_flush();
?>
