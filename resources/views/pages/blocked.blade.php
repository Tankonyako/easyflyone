<h1>You has been blocked on EasyFly.One</h1>
<p>You can contact us support@easyfly.one</p>
<p>Your user is: </p>
<pre>
    ID: {{ $user->id }}
    Full Name: {{ $user->getFullName() }}
    EMail: {{ $user->contactEmail }}
    Phone: {{ $user->contactPhoneNumber }}
    IP: {{ $_SERVER['REMOTE_ADDR'] }}
    Registered from: {{ $user->created_at }}
</pre>

<p>
    EasyFly.One<br>
    Copyright 2021 EasyFly.One, Inc.<br><br>

    All rights reserved. Copyright is owned by EasyFly.One, Inc.
</p>
