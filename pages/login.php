<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/messages_pl.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>
	$(document).ready(function () {
		$('#login').validate();
	});
	
</script>
<div id="content">
	<div class="post">
		
		
			
			<div class="entry">
				<?php if(isset($_GET['bad'])): ?><center><h1 style="color:red">Zły login lub hasło !!!</h1></center><?php endif; ?>
				<?php if(isset($_GET['good'])): ?><center><h1>Zarejestrowano poprawnie, zaloguj się</h1></center><?php endif; ?>
					<h2 class="title">Logowanie</h2>
								<form method="post" action="index.php?save&login" id="login">
									<div id="login">
										
										<label for="login"><p>Login:</p></label>
										<input type="text" name="login" id="login" value="" required />
										<label for="haslo"><p>Hasło:</p></label>
										<input type="password" name="haslo" id="haslo" value="" required />
										<p><a href="?register">zarejestruj się</a></p>
										<p class="submit">  
											 <input type="submit" name="submit" value="Zaloguj" />
										</p>
									</div>
								</form>
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->
<div id="sidebar2">
	<img src="img/icon_client_login.png" width="400" height="400" alt="" />
</div>
<!-- end #sidebar -->
<div style="clear: both;">&nbsp;</div>
