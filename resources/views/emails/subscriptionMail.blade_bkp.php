<!DOCTYPE html>
<html>
<head>
 <title>Vanderhouwen Subscription Mail</title>
</head>
<body>
 
	<h1>A new user subscribed the Job Alert</h1>
	<p>Below is the attached details:</p>

	<p>From: {{ $details['fname'] }} {{ $details['lname'] }}</p>
	<p>Subject: {{ $details['title'] }}</p>
	<p></p>
	<p>Message Body:</p>
	<p></p>

	<p>{{ $details['fname'] }} {{ $details['lname'] }}</p>
	<p></p>
	<p>{{ $details['email'] }}</p>
	<!-- <p>{{ $details['fname'] }} {{ $details['lname'] }}</p> -->
	<p></p>
	<p></p>
	<p>Thank You!</p>

</body>
</html> 