<!DOCTYPE html>
<html>
<head>
 <title>VanderHouwen Subscription Mail</title>
</head>
<body>
 
	<h1>A new user subscribed to Job Alerts</h1>
	<p>Below is the attached details:</p>

	<p>Subject: VanderHouwen Job Alert</p>
	<p></p>
	<p></p>

	<p>Subscribed for: {{ $details['subFor'] }}</p>

	<p>{{ $details['fname'] }} {{ $details['lname'] }}</p>
	<p></p>
	<p>{{ $details['email'] }}</p>
	
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p>Thank You!</p>

</body>
</html> 