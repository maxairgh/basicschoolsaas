<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
   <!-- ===========================================
Call To Action
=========================================== -->
<section class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 py-24">

    <!-- Decorative Circles -->
    <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-white/10"></div>
    <div class="absolute -bottom-32 -right-24 h-96 w-96 rounded-full bg-white/10"></div>

    <div class="relative mx-auto max-w-5xl px-6 text-center">

        <span
            class="inline-flex items-center rounded-full bg-white/20 px-5 py-2 text-sm font-semibold text-white">
            🚀 Start Your Digital Transformation Today
        </span>

        <h2 class="mt-8 text-4xl font-extrabold leading-tight text-white md:text-5xl">

            Ready to Transform

            <span class="text-yellow-300">
                Your School?
            </span>

        </h2>

        <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-blue-100">

            Join schools using our cloud-based School Management System to
            simplify administration, improve communication, automate report
            cards, manage fees, monitor attendance and keep parents informed.

        </p>

        <div class="mt-12 flex flex-wrap justify-center gap-5">

            <a href="{{ route('schoolsignup') }}"
               class="rounded-xl bg-white px-8 py-4 text-lg font-semibold text-blue-700 shadow-xl transition hover:scale-105 hover:bg-slate-100">

                Create School Account

            </a>

            <a href="#"
               class="rounded-xl border border-white px-8 py-4 text-lg font-semibold text-white transition hover:bg-white hover:text-blue-700">

                School Login

            </a>

        </div>

        <div class="mt-12 grid gap-6 text-left md:grid-cols-3">

            <div class="rounded-2xl bg-white/10 p-6 backdrop-blur">

                <h4 class="font-semibold text-white">
                    ✔ Free School Setup
                </h4>

                <p class="mt-2 text-sm text-blue-100">
                    Register your school and complete the setup in just a few minutes.
                </p>

            </div>

            <div class="rounded-2xl bg-white/10 p-6 backdrop-blur">

                <h4 class="font-semibold text-white">
                    ✔ Secure Cloud Platform
                </h4>

                <p class="mt-2 text-sm text-blue-100">
                    Your data is encrypted, backed up regularly and accessible anywhere.
                </p>

            </div>

            <div class="rounded-2xl bg-white/10 p-6 backdrop-blur">

                <h4 class="font-semibold text-white">
                    ✔ Dedicated Support
                </h4>

                <p class="mt-2 text-sm text-blue-100">
                    Our support team is ready to assist your school whenever needed.
                </p>

            </div>

        </div>

    </div>

</section>
</div>