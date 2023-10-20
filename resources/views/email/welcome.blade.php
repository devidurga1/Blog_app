{{--@component('mail::message')
  Hello... Welcome to dashoard
      
Name: {{ $mailData['name'] }}<br/>
Email: {{ $mailData['email'] }}
      
Thanks,<br/>
{{ config('app.name') }}
@endcomponent--}}



{{--<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
Your registered email-id is {{$user['email']}}
</body>

</html>--}}


<!-- resources/views/emails/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head></head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Welcome to our service! This is the welcome email content.</p>
</body>
</html>