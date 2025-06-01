<!DOCTYPE html>
<html>
<body>
    <h2>Les Annulering - KiteSurfschool Windkracht-12</h2>
    <p>Beste {{ $data['student_name'] }},</p>

    @if($data['type'] === 'weather')
        <p>Vanwege de hoge windkracht (>10) kan uw les op {{ $data['lesson_date'] }} 
           om {{ $data['lesson_time'] }} helaas niet doorgaan.</p>
    @else
        <p>Vanwege ziekte van uw instructeur {{ $data['instructor_name'] }} kan uw les op 
           {{ $data['lesson_date'] }} om {{ $data['lesson_time'] }} helaas niet doorgaan.</p>
    @endif

    <p>We nemen binnenkort contact met u op om een nieuwe afspraak in te plannen.</p>

    <p>Met vriendelijke groet,<br>
    KiteSurfschool Windkracht-12</p>
</body>
</html>
