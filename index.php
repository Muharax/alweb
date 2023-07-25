<?php
	
	include('session.php');
	include('header.php');
	
?>


<div class="main">
	<div class="w1">
		<div class="div logo min-w">
			<div class="div">
				<a href="<?php echo URL;?>index.php">
					<img src="img/skynet.png" alt="SKYNET" class="logo-img">
				</a>
			</div>
		</div>
		
		
		<div class="div navbar">
			<div class="search-bar">
				<div class="search-bar-SVG">
					<svg focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path><path d="M0,0h24v24H0V0z" fill="none"></path></svg>
				</div>
				<div class="search-bar-INPUT">
					<input type="text" class="search">	
				</div>
			</div>
			
		</div>
		
		
		<div class="div logout">
			<button class="btn-1" id="logout">X</button>
		</div>
		
		
		
		
	</div>
	
	
	
	

	<div class="w2">
		
		<div class="div menu min-w">
			<div class="div menu item">
				<div class="links-SVG">
					<!---->
				</div>
				<div class="links">
					<a href="#" id="uzytkownicy">Użytkownicy</a>
				</div>
			</div>

			<div class="div menu item">
				<div class="links-SVG">
					<!---->
				</div>
				<div class="links">
					<a href="#" id="uzytkownicy">Finanse</a>
				</div>
			</div>

			<div class="div menu item">
				<div class="links-SVG">
					<!---->
				</div>
				<div class="links">
					<a href="#" id="uzytkownicy">Faktury</a>
				</div>
			</div>

		</div>
		
		
		<div class="div e-window">
			<div class="window"></div>
		</div>

	</div>
</div>

<?php 
	include ('footer.php');
?>

<script>
$(document).on("click", '#uzytkownicy', function() {
	$(".window").load(URL+'/admin/uzytkownicy/panel.php');
});

$(document).on("click", '#logout', function() {
	$.confirm({
		boxWidth: '30%',
    	useBootstrap: false,
		title: 'Zamykanie sesji',
		content: 'Jesteś pewny?',
		type: 'red',
		typeAnimated: true,
		buttons: {
			tryAgain: {
				text: 'TAK',
				btnClass: 'btn-red',
				action: function(){
					$.ajax({
						type: "POST",
						url: URL+'/logout.php',
						dataType:'text',
						success: function(){
								window.location.href = URL+'/index.php'
						},
					})	
				}
			},
			close: function () {
			}
		}
	});
});
</script>



