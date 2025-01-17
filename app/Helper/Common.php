<?php


use Carbon\Carbon;
use Twilio\Rest\Client;


function hubList(): array
{
    return ['632' => 'coimbatore'];
}

function formDate($date, $format = 'Y-m-d')
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}
function formDateTime($date, $format = 'Y-m-d H:i')
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

function block_type(): array
{
    return ['0' => 'Maintenance','1' => 'Discretionary','2' => 'Availability Type','3' => 'U-refurbish',
        '4' => 'U-recovery','5' => 'It-reserve'
        ];
}

function reason_type(): array
{
    return ['0' => 'Major Repair','1' => 'Accident','2' => 'Running Repair','3' => 'Service',
        '4' => 'Others','5' => 'Buffer','6' => 'GPS-Issue','7' => 'Forced-Extension','8' => 'Others'
    ];
}

function getAdminPermissions()
{
    static $permissions = null;

    if ($permissions === null) {
        $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        $role = !empty($admin->role) ? \App\Models\Role::find($admin->role) : null;
        $permissions = !empty($role->permissions) ? json_decode($role->permissions) : [];
    }

    return $permissions;
}

function showDateTime($date, $format = 'd/m/Y h:i:s A')
{
    return Carbon::parse($date)->format($format);
}

function showDateformat($date, $format = 'd-m-Y H:i')
{
    return Carbon::parse($date)->format($format);
}

function showDate($date, $format = 'd/m/Y')
{
    return Carbon::parse($date)->format($format);
}


if (!function_exists('twilio')) {
    /**
     * Initialize the Twilio Client and provide a fluent API.
     *
     * @return object
     */
    function twilio() {
        $client = app('twilio');

        return new class ($client) {
            protected $client;
            protected $message;
            protected $to;

            public function __construct(Client $client) {
                $this->client = $client;
            }

            public function send(string $message) {
                $this->message = $message;
                return $this;
            }

            public function to(string $recipient) {
                $this->to = $recipient;

                return $this->client->messages->create($this->to, [
                    'from' => config('twilio.phone_number'),
                    'body' => $this->message,
                ]);
            }
        };
    }
}

