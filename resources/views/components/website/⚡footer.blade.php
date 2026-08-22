<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
  <!-- ===========================================
Footer
=========================================== -->

<footer id="contact" class="bg-slate-900 text-slate-300">

    <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

        <div class="grid gap-12 lg:grid-cols-4">

            <!-- Company -->

            <div>

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-xl font-bold text-white">

                        H

                    </div>

                    <div>

                        <h3 class="text-xl font-bold text-white">
                            Penonline
                        </h3>

                        <p class="text-sm text-slate-400">
                            By Highrise Digital Solutions
                        </p>

                    </div>

                </div>

                <p class="mt-6 leading-7 text-slate-400">

                    A modern cloud-based School Management System built
                    specifically for Preschool, KG, Primary and Junior High Schools.

                </p>

                <div class="mt-6 flex gap-4">

                   

                </div>

            </div>


            <!-- Product -->

            <div>

                <h4 class="text-lg font-semibold text-white">
                    Product
                </h4>

                <ul class="mt-6 space-y-3">

                    <li>
                        <a href="https://www.hrdsystems.net"
                       target="_blank"
                       class="text-blue-400 hover:text-white">

                        🌐 Main Website

                    </a>              
                    </li>
                   
                    <li>
                        <a href="https://www.rexonline.hrdsystems.net"
                       target="_blank"
                       class="text-blue-400 hover:text-white">

                        🌐 Rexonline - SHS Portal

                    </a>              
                    </li>

                    <li>
                        <a href="{{ url('/#benefits') }}" class="hover:text-white">
                            Benefits
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/#parents') }}" class="hover:text-white">
                            Parent Portal
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/#contact') }}" class="hover:text-white">
                            Free Trial
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Quick Links -->

            <div>

                <h4 class="text-lg font-semibold text-white">
                    Quick Links
                </h4>

                <ul class="mt-6 space-y-3">

                    <li>

                        <a href="{{ route('filament.school.auth.login') }}" class="hover:text-white">

                            School Login

                        </a>

                    </li>

                    <li>

                        <a href="{{ route('filament.parent.auth.login') }}" class="hover:text-white">
                            Parent Login
                        </a>

                    </li>

                     <li>

                        <a href="{{ route('filament.admin.auth.login') }}" class="hover:text-white">
                            Admin Login
                        </a>

                    </li>

                    <li>

                        <a href="#"

                           class="hover:text-white">

                            Privacy Policy

                        </a>

                    </li>

                    <li>

                        <a href="#"

                           class="hover:text-white">

                            Terms & Conditions

                        </a>

                    </li>

                </ul>

            </div>


            <!-- Contact -->

            <div>

                <h4 class="text-lg font-semibold text-white">
                    Contact Us
                </h4>

                <div class="mt-6 space-y-5">

                    <div>

                        <p class="text-sm uppercase tracking-wide text-slate-500">

                            Phone

                        </p>

                        <a href="tel:+233552747070"
                           class="text-white hover:text-blue-400">

                            +233 55 274 7070

                        </a>

                    </div>

                    <div>

                        <p class="text-sm uppercase tracking-wide text-slate-500">

                            Email

                        </p>

                        <a href="mailto:info@hrdsystems.net"
                           class="text-white hover:text-blue-400">

                            info@hrdsystems.net

                        </a>

                    </div>

                    <div>

                        <p class="text-sm uppercase tracking-wide text-slate-500">

                            Website

                        </p>

                        <a href="https://www.hrdsystems.net"
                           target="_blank"
                           class="text-white hover:text-blue-400">

                            www.hrdsystems.net

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- Divider -->

        <div class="my-12 border-t border-slate-800"></div>

        <!-- Bottom Footer -->

        <div class="flex flex-col items-center justify-between gap-6 text-sm text-slate-500 md:flex-row">

            <p>

                © {{ date('Y') }}
                Highrise Digital Solutions.
                All rights reserved.

            </p>

            <div class="flex flex-wrap items-center gap-6">

                <a href="#"
                   class="hover:text-white">

                    Privacy Policy

                </a>

                <a href="#"
                   class="hover:text-white">

                    Terms of Service

                </a>

                <a href="https://www.hrdsystems.net"
                   target="_blank"
                   class="hover:text-white">

                    Visit Main Website

                </a>

            </div>

        </div>

    </div>

</footer>
</div>