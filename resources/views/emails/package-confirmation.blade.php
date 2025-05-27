<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #2563eb;">Bedankt voor je aankoop!</h1>
        
        <p>Beste {{ $packageData['userName'] }},</p>
        
        <h2>Je pakket details:</h2>
        <ul>
            <li>Pakket: {{ $packageData['packageName'] }}</li>
            <li>Prijs: €{{ number_format($packageData['price'], 2, ',', '.') }}</li>
            <li>Locatie: {{ $packageData['locationName'] }}</li>
            <li>Datum: {{ $packageData['date'] }}</li>
            <li>Tijdslot: {{ $packageData['timeslot'] }}</li>
        </ul>

        <h2>Betalingsinformatie:</h2>
        <p>Maak het bedrag van €{{ number_format($packageData['price'], 2, ',', '.') }} over naar:</p>
        <ul>
            <li>IBAN: NL91 INGB 0123 4567 89</li>
            <li>T.n.v.: KiteSurfschool Windkracht-12</li>
            <li>Onder vermelding van: Reservering #{{ $packageData['orderId'] }}</li>
        </ul>

        <p style="margin-top: 30px;">
            Met vriendelijke groet,<br>
            Team KiteSurfschool Windkracht-12
        </p>
    </div>
</body>
</html>
