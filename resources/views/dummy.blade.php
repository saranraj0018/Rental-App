$(function () {
'use strict';
$(document).ready(function() {
let currentWeekOffset = 0; // Track the current week offset

$('#car_available_model').on('change', function () {
loadWeekData();
});

$('#next-week').on('click', function() {
currentWeekOffset++;
loadWeekData();
});

$('#prev-week').on('click', function() {
if (currentWeekOffset > 0) {
currentWeekOffset--;
loadWeekData();
}
});

function loadWeekData() {
$.ajax({
url: '/admin/check-available',
method: 'GET',
data: {
model_id: $('#car_available_model').val(),
city_code: $('#hub_available').val(),
week_offset: currentWeekOffset // Send the current week offset
},
success: function(response) {
const $tbody = $('#registration-numbers-body');
$tbody.empty(); // Clear previous data
generateTableHeaders(); // Generate table headers when data is fetched

// Ensure you're accessing response.bookings correctly
const bookings = response.bookings; // Check if this is an array

if (!Array.isArray(bookings)) {
console.error('Expected bookings to be an array:', bookings);
return; // Exit if it's not an array
}

const bookingsMap = {};

bookings.forEach(function (booking) {
const registerNumber = booking.register_number;
const startDate = new Date(booking.start_date);
const endDate = new Date(booking.end_date);
const bookingType = booking.booking_type;

if (!bookingsMap[registerNumber]) {
bookingsMap[registerNumber] = new Array(7).fill().map(() => new Array(48).fill('green'));
}

// Determine the color based on the booking type
const color = (bookingType === '1') ? 'red' : (bookingType === '2') ? 'blue' : 'green';

// Iterate through each day of the booking range
let currentDate = new Date(startDate); // Start from the booking's start date
while (currentDate <= endDate) {
// Calculate the day index (0 = Sunday, 6 = Saturday)
const dayIndex = Math.floor((currentDate - new Date()) / (1000 * 60 * 60 * 24)) + currentWeekOffset * 7;

if (dayIndex >= 0 && dayIndex < 7) { // Ensure the day is within the current week
let hourStart = 0;
let hourEnd = 48;

if (currentDate.toDateString() === startDate.toDateString()) {
hourStart = Math.floor(startDate.getHours() * 2 + startDate.getMinutes() / 30);
}
if (currentDate.toDateString() === endDate.toDateString()) {
hourEnd = Math.ceil(endDate.getHours() * 2 + endDate.getMinutes() / 30) + 1;
}

// Update the bookingsMap for this day
for (let h = hourStart; h < hourEnd; h++) {
if (h < 48) {
bookingsMap[registerNumber][dayIndex][h] = color;
}
}

// Debugging log
console.log(
`Register: ${registerNumber}, Day: ${dayIndex}, Current: ${currentDate.toDateString()}, Start: ${hourStart}, End: ${hourEnd}`
);
}

// Move to the next day
currentDate.setDate(currentDate.getDate() + 1);
}
});

// Populate the table
for (const registerNumber in bookingsMap) {
let rowHtml = `<tr style="border: 1px solid #000;"> <td style="border: 1px solid #000;">${registerNumber}</td>`;
    for (let d = 0; d < 7; d++) {
    for (let h = 0; h < 48; h++) {
    const color = bookingsMap[registerNumber][d][h];
    rowHtml += `<td style="background-color: ${color}; border: 1px solid #000;"></td>`;
    }
    }
    rowHtml += `</tr>`;
$tbody.append(rowHtml);
}

$('#car-details-table').show();


},

error: function(xhr) {
console.error('Error fetching data:', xhr);
alert('An error occurred while fetching registration numbers.');
}
});
}

function generateTableHeaders() {
let startDate = new Date();
startDate.setDate(startDate.getDate() + currentWeekOffset * 7);

const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
let dateHeaderRow = '';
let hoursHeaderRow = '<th>Reg No</th>';

for (let i = 0; i < 7; i++) {
let date = new Date(startDate);
date.setDate(startDate.getDate() + i);

const dayName = daysOfWeek[date.getDay()];
const month = date.toLocaleString('default', { month: 'long' });
dateHeaderRow += `<th colspan="48">${dayName}, ${month} ${date.getDate()}, ${date.getFullYear()}</th>`;

for (let hour = 0; hour < 24; hour++) {
hoursHeaderRow += `<th>${hour}:00</th><th>${hour}:30</th>`;
}
}

$('#date-header').html(dateHeaderRow);
$('#hours-header').html(hoursHeaderRow);
}


$('#hub_available').change(function() {
let hub_id = $(this).val();
if (hub_id) {
$.ajax({
url: '/admin/get-car-models',
method: 'GET',
data: { hub_id: hub_id },
success: function(response) {
let carModelSelect = $('#car_available_model');
carModelSelect.empty(); // Clear current options
carModelSelect.append('<option selected disabled>Choose a Car Model</option>');
if (response.carModels.length > 0) {
response.carModels.forEach(function(model) {
carModelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
});
}
},
error: function() {
alertify.error('Error fetching car models.');
}
});
}
});
});
});
