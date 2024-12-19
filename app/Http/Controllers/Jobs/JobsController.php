<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function joblist()
    {
        return view('screens.Jobs.joblist');
    }
    public function jobs()
    {
        $jobs = [
            [
                'id' => 1,
                'title' => 'ReactJS Developer',
                'company' => 'CyberPoint Pvt. Ltd',
                'location' => 'Gurugram, Haryana',
                'salary' => '₹45,000 - ₹60,000 a month',
                'type' => 'Full-time',
                'schedule' => 'Monday to Friday',
            ],
            [
                'id' => 2,
                'title' => 'Software Engineer',
                'company' => 'Vujis',
                'location' => 'Hyderabad, Telangana',
                'salary' => '₹50,000 - ₹70,000 a month',
                'type' => 'Part-time',
                'schedule' => 'Flexible hours',
            ],
            [
                'id' => 1,
                'title' => 'ReactJS Developer',
                'company' => 'CyberPoint Pvt. Ltd',
                'location' => 'Gurugram, Haryana',
                'salary' => '₹45,000 - ₹60,000 a month',
                'type' => 'Full-time',
                'schedule' => 'Monday to Friday',
            ],
            [
                'id' => 2,
                'title' => 'Software Engineer',
                'company' => 'Vujis',
                'location' => 'Hyderabad, Telangana',
                'salary' => '₹50,000 - ₹70,000 a month',
                'type' => 'Part-time',
                'schedule' => 'Flexible hours',
            ],
        ];

        return view('screens.Jobs.jobs', compact('jobs'));
    }

}
