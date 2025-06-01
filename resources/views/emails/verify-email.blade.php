<!DOCTYPE html>
<html>
<body>
    <h2>Welkom bij KiteSurfschool Windkracht-12!</h2>
    <p>Klik op onderstaande link om je account te activeren en een wachtwoord in te stellen:</p>
    
    <a href="{{ url('/set-password/' . $user->verification_token) }}">
        Account Activeren
    </a>

    <p>Als de link niet werkt, kopieer dan deze URL:</p>
    <p>{{ url('/set-password/' . $user->verification_token) }}</p>
</body>
</html>
