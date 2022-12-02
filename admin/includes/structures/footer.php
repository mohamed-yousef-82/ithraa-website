<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<script src="<?php echo"$js" ?>/jquery-3.1.1.min.js"></script>
<script src="<?php echo"$js" ?>/wow.js"></script>
<script src="<?php echo"$js" ?>/js.js"></script>
<script src="<?php echo"$js" ?>/scripts.js"></script>
<script>
  new WOW().init();
</script>
</body>
</html>
<?php
ob_end_flush();
?>
