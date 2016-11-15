<!DOCTYPE html>
<html>
<head>
	<title>Login Form Validation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h2>Login Form</h2>
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2">Username : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="username" placeholder="Enter your username">
				</div>
				<span></span>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Password : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="password" placeholder="Enter your password">
				</div>
				<span></span>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>