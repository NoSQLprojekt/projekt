<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/messages_pl.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>
	$(document).ready(function () {
		$('#register').validate({
			rules: {
				haslo2: {
					equalTo: "#password"
				}
			}
		});
	});
	
</script>

<div id="content">
	<div class="post">
		
		
			
			<div class="entry">
				<?php if(isset($_GET['bad'])): ?><center><h1 style="color:red">Podany login istnieje</h1></center><? endif; ?>
					<h2 class="title">Rejestracja</h2>
								<form method="post" action="index.php?save&addUser" id="register">
									<div id="adduser">
										
										<label for="login"><p>Login:</p></label>
										<input id="login" type="text" name="login" id="login-text" value="" required /><br>
										<label for="email"><p>Email:</p></label>
										<input id="email" type="email" name="email" id="login-text" value="" required /><br>
										<label for="password"><p>Hasło:</p></label>
										<input id="password" type="password" name="haslo" id="login-text" value="" required /><br>
										<label for="password2"><p>Powtórz hasło:</p></label>
										<input id="password2" type="password" name="haslo2" id="login-text" value="" required /><br>
										
										
										<p class="submit">  
											<input type="submit" name="submit" value="Zarejestruj" />  
										</p>
									</div>
								</form>
							
			</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->
<div id="sidebar3">
	<img src="img/icon-512.png" width="400" height="400" alt="" />
</div>
<!-- end #sidebar -->
<div style="clear: both;">&nbsp;</div>