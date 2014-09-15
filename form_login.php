<!DOCTYPE html>
<html>
    <head>
        <title>Authentication</title>
        <meta charset="utf-8">
    </head>
    <body>
		<form method=POST action="index.php?action=auth">
			<p>Please login:</p>
			<br/>
			login:<br/>
			<input name="login" /><br/>
			password:<br/>
			<input type="password" name="password" /><br/>
			<input type=submit value="Go!"/>
		</form>
    </body>
</html>