<table class="table table-bordered">
    <thead>
    <tr>
        <th>Day</th>
        <th>0:00 - 24:00</th>
    </tr>
    </thead>
    <tbody>
    @php
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp
    @foreach($days as $dayIndex => $day)
        <tr>
            <td>{{ $day }}</td>
            <td>
                @if(isset($availability[$dayIndex]))
                    @foreach($availability[$dayIndex] as $timeSlot)
                        <div class="time-slot {{ $timeSlot['booking_type'] == 'booking' ? 'bg-danger' : 'bg-success' }}">
                            {{ $timeSlot['start_time'] }} - {{ $timeSlot['end_time'] }}
                        </div>
                    @endforeach
                @else
                    <div class="time-slot bg-success">
                        Available all day
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
