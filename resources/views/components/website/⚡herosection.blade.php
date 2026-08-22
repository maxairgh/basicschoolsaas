<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
   <!-- ========================= HERO ========================= -->

<section class="pt-36 pb-24">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-20 items-center">

            <!-- LEFT -->

            <div>

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">

                    🚀 Built for Ghanaian Basic Schools

                </span>

                <h1 class="mt-8 text-5xl lg:text-6xl font-extrabold leading-tight">

                    Manage Your School

                    <span class="text-blue-600">

                        Smarter,

                    </span>

                    Not Harder.

                </h1>

                <p class="mt-8 text-lg text-slate-600 leading-8">

                    A complete cloud-based School Management System for
                    Preschool, KG, Lower Primary, Upper Primary and JHS.

                    Digitize admissions, assessments, report cards,
                    attendance, fee management, parent communication,
                    and much more from one secure platform.

                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="{{ route('schoolsignup') }}"
                       class="px-8 py-4 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-xl">

                        Create School Account

                    </a>

                    <a href="{{ route('filament.school.auth.login') }}"
                       class="px-8 py-4 rounded-xl border border-slate-300 hover:bg-white transition">

                        School Login

                    </a>

                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mt-12">

                    <div>

                        <h2 class="font-bold text-2xl text-blue-600">
                            Cloud
                        </h2>

                        <p class="text-sm text-slate-500">
                            Secure Hosting
                        </p>

                    </div>

                    <div>

                        <h2 class="font-bold text-2xl text-blue-600">
                            24/7
                        </h2>

                        <p class="text-sm text-slate-500">
                            Access Anywhere
                        </p>

                    </div>

                    <div>

                        <h2 class="font-bold text-2xl text-blue-600">
                            100%
                        </h2>

                        <p class="text-sm text-slate-500">
                            Mobile Friendly
                        </p>

                    </div>

                    <div>

                        <h2 class="font-bold text-2xl text-blue-600">
                            Safe
                        </h2>

                        <p class="text-sm text-slate-500">
                            Automatic Backups
                        </p>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div>

                <div class="rounded-3xl bg-white shadow-2xl border border-slate-200 overflow-hidden">

                    <div class="bg-blue-600 p-5">

                        <h2 class="text-white font-semibold text-lg">

                            School Dashboard

                        </h2>

                    </div>

                    <div class="p-8">

                        <div class="grid grid-cols-2 gap-5">

                            <div class="rounded-2xl bg-blue-50 p-5">

                                <p class="text-slate-500 text-sm">
                                    Students
                                </p>

                                <h2 class="mt-2 text-3xl font-bold">
                                    1,284
                                </h2>

                            </div>

                            <div class="rounded-2xl bg-green-50 p-5">

                                <p class="text-slate-500 text-sm">
                                    Teachers
                                </p>

                                <h2 class="mt-2 text-3xl font-bold">
                                    52
                                </h2>

                            </div>

                            <div class="rounded-2xl bg-yellow-50 p-5">

                                <p class="text-slate-500 text-sm">
                                    Attendance
                                </p>

                                <h2 class="mt-2 text-3xl font-bold">
                                    97%
                                </h2>

                            </div>

                            <div class="rounded-2xl bg-red-50 p-5">

                                <p class="text-slate-500 text-sm">
                                    Fee Collection
                                </p>

                                <h2 class="mt-2 text-3xl font-bold">
                                    GHS 84K
                                </h2>

                            </div>

                        </div>

                        <div class="mt-8 rounded-2xl bg-slate-100 p-6">

                            <h3 class="font-semibold mb-4">

                                Recent Activity

                            </h3>

                            <ul class="space-y-4">

                                <li class="flex justify-between">

                                    <span>New Admission</span>

                                    <span class="text-blue-600">
                                        Today
                                    </span>

                                </li>

                                <li class="flex justify-between">

                                    <span>Results Published</span>

                                    <span class="text-green-600">
                                        Completed
                                    </span>

                                </li>

                                <li class="flex justify-between">

                                    <span>Parent Login</span>

                                    <span class="text-slate-500">
                                        124 Today
                                    </span>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
</div>