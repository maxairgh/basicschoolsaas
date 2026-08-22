<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
   <!-- ========================= NAVBAR ========================= -->
<nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur border-b border-slate-200 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex items-center justify-between h-20">

            <a href="/" class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                    H
                </div>

                <div>
                    <h1 class="font-bold text-lg">
                         Penonline
                    </h1>

                    <p class="text-xs text-slate-500">
                        by Highrise Digital Solutions
                    </p>

                </div>

            </a>

            <div class="hidden lg:flex items-center gap-8">

                <a href="{{ url('/#features') }}" class="hover:text-blue-600 transition">
                    Features
                </a>

                <a href="{{ url('/#benefits') }}" class="hover:text-blue-600 transition">
                    Benefits
                </a>

                <a href="{{ url('/#parents') }}" class="hover:text-blue-600 transition">
                    Parent Portal
                </a>

                <a href="{{ url('/#contact') }}" class="hover:text-blue-600 transition">
                    Contact
                </a>

            </div>

            <div class="hidden lg:flex items-center gap-3">

                <a href="{{ route('filament.school.auth.login') }}"
                   class="px-5 py-2.5 rounded-lg border border-slate-300 hover:bg-slate-100 transition">
                    School Login
                </a>

                <a href="{{ route('filament.parent.auth.login') }}"
                   class="px-5 py-2.5 rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-50 transition">
                    Parent Login
                </a>

                <a href="{{ route('schoolsignup') }}"
                   class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-lg">
                    Start Free Trial
                </a>

            </div>

        </div>

    </div>
</nav>
</div>