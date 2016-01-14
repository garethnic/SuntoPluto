<h3>Hello, {{ $user->first_name }}</h3>

<p>You have registered on SuntoPluto.</p>

<p>Please click the following <a href="{{ route('confirm_user', ['username' => $user->username, 'token' => $user->token]) }}">link</a> to confirm</p>

<p>Thank you</p>