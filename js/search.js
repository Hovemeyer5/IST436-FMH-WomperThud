$(document).ready(function(){
			$('#search').keyup(function(){
				var searchData = $(this).val();
				$.ajax({
						type: "POST",
						url: "aj.php",
						data: {search: searchData, action: 'searchInput'},
						success: function(data){
							$("#contactListing").html(data);
							console.log(data);
						}
					});  
			});
		});