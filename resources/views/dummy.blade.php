$query = Booking::with(['user', 'details', 'comments', 'user.bookings'])
->where('status', 1)
->where(function ($query) use ($timeLimit) {
$query->where('risk', 2)
->where(function ($query) use ($timeLimit) {
$query->where(function ($query) use ($timeLimit) {
$query->where('booking_type', 'delivery')
->whereBetween('start_date', [now(), $timeLimit]);
})->orWhere(function ($query) use ($timeLimit) {
$query->where('booking_type', 'pickup')
->whereBetween('end_date', [now(), $timeLimit]);
});
})
->orWhere(function ($query) {
$query->where('risk', 1);
});
})
->orWhere(function ($query) {
$query->where('risk', 1)
->where('status', 1);
})
;
