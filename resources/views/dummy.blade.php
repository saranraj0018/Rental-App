<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Moment.js is required by both plugins -->
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</head>
<body>
<div class="container">
    <br><br><br>
    <div class='col-sm-6'>
        <div class="form-group">
            <label for="">Date and Time</label>
            <div class='input-group date' id='datetime'>


                <input type="text" name="datetimes" class="form-control"/>
                <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerIncrement: 30,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            minDate: moment().startOf('day'),
            locale: {
                format: 'DD-MM-YYYY HH:mm'
            }
        });
    });
</script>
</body>
