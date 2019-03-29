<!DOCTYPE HTML>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function() {

$("#search_box").keyup(function() {
    var search_word = $("#search_box").val();
    var dataString = 'search_word='+ search_word;
	if(search_word=='')
	{
	}
	else
	{
	$.ajax({
	type: "GET",
    url: "cari_status.php",
    data: dataString,
    cache: false,
    beforeSend: function(html) {
   
	document.getElementById("insert_search").innerHTML = ''; 
	$("#flash").show();
	$("#searchword").show();
	$(".searchword").html(search_word);
	$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
	               
            },
    success: function(html){
   $("#insert_search").show();
   $("#insert_search").append(html);
   $("#flash").hide();
  }
});
		
	}
		

    return false;
	});



});

</script>
	<![endif]-->

								<form method="get"   id="fh5co-header-subscribe">
									<div class="col-md-8 col-md-offset-2">
										<div class="form-group">
										<div >Shipment Info</div>
											<input type="text" class="form-control"  name="search" id="search_box" placeholder="Please enter your delivery note">
										
											  <table id="insert_search" class="update" cellpadding=0 cellspacing=0 border=1 width=100%>
				
			  </table>
										</div>
										</div>
									</div>
								</form>
		
<body>
</body>
</html>
