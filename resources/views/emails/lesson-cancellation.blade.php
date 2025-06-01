<!DOCTYPE html>
<html>
<body>
    <h2>Les Annulering</h2>
    
    <p>Beste {{ $data['student_name'] }},</p>

    @if($data['reason'] === 'illness')
        <p>Helaas moet ik u informeren dat uw les van {{ $data['lesson_date'] }} om {{ $data['lesson_time'] }} 
        geannuleerd moet worden wegens ziekte van uw instructeur {{ $data['instructor_name'] }}.</p>
    @else
        <p>Helaas moet ik u informeren dat uw les van {{ $data['lesson_date'] }} om {{ $data['lesson_time'] }} 
        geannuleerd moet worden wegens slechte weersomstandigheden (windkracht > 10).</p>
    @endif

    <p>We zullen zo spoedig mogelijk contact met u opnemen om een nieuwe afspraak in te plannen.</p>

    <p>Met vriendelijke groet,<br>
    KiteSurfschool Windkracht-12</p>
</body>
</html>
