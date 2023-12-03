<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <title>Online Attendance</title>
      </head>
      <body class="h-full">
      <x-notification />
      <div class="min-h-full">
        <div class="bg-gray-800 pb-32">
          <nav
            x-data="{
              showMenu: false
            }"
            class="bg-gray-800"
          >
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
              <div class="border-b border-gray-700">
                <div class="flex h-16 items-center justify-between px-4 sm:px-0">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <img class="h-12 w-12" src="{{ url('/images/pnu-logo.png') }}" alt="PNU Logo">
                    </div>
                    <div class="hidden md:block">
                      <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logs</a>
                      </div>
                    </div>
                  </div>
                  <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                      <!-- Profile dropdown -->
                      <div
                        x-data="{
                          open: false,
                          toggle() {
                            this.open = this.open ? this.close() : true
                          },
                          close() {
                            this.open = false
                          }
                        }"
                        @keydown.escape.prevent.stop="close()"
                        class="relative ml-3"
                      >
                        <div>
                          <button
                            @click="toggle()"
                            @click.outside="close()"
                            type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar }}" alt="">
                          </button>
                        </div>
      
                        <!--
                          Dropdown menu, show/hide based on menu state.
      
                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div
                          x-show="open"
                         class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: none">
                          <!-- Active: "bg-gray-100", Not Active: "" -->
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                          <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button @click = "showMenu = ! showMenu" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                      <span class="absolute -inset-0.5"></span>
                      <span class="sr-only">Open main menu</span>
                      <!-- Menu open: "hidden", Menu closed: "block" -->
                      <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                      </svg>
                      <!-- Menu open: "block", Menu closed: "hidden" -->
                      <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
      
            <!-- Mobile menu, show/hide based on menu state. -->
            <div
              x-show="showMenu"
              class="border-b border-gray-700 md:hidden" id="mobile-menu">
              <div class="space-y-1 px-2 py-3 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Logs</a>
              </div>
              <div class="border-t border-gray-700 pb-3 pt-4">
                <div class="flex items-center px-5">
                  <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->avatar }}" alt="">
                  </div>
                  <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                  </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                  <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                  <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</button>
                  </form>
                </div>
              </div>
            </div>
          </nav>
          <header class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              <h1 class="text-3xl font-bold tracking-tight text-white">Hi, {{ auth()->user()->name }}!</h1>
            </div>
          </header>
        </div>
      
        <main class="-mt-24 pb-8">
          <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Page title</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-3 lg:gap-8">
              <!-- Left column -->
              <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                <section aria-labelledby="section-1-title">
                  <h2 class="sr-only" id="section-1-title">DateTime Display</h2>
                  <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-6 flex justify-around items-center">
                      <!-- Your content -->
                      <div class="flex flex-col space-y-3">
                        <p class="mx-auto font-sans text-3xl font-bold" id="date"></p>
                        <p class="mx-auto font-sans text-2xl" id="time"></p>
                      </div>
                      <div>
                        <form action="/logs-process" method="POST">
                          @csrf
                          <input type="hidden" name="google_id" value="{{ auth()->user()->google_id }}" readonly>
                          @if (count($logs) % 2 == 0)
                            <button type="submit" class="mx-auto bg-blue-800 hover:bg-blue-700 text-white font-semibold py-4 px-4 border border-blue-900 rounded shadow">
                              CLOCK IN
                            </button>
                          @else
                            <button type="submit" class="mx-auto bg-blue-800 hover:bg-blue-700 text-white font-semibold py-4 px-4 border border-blue-900 rounded shadow">
                              CLOCK OUT
                            </button>
                          @endif
                        </form>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <!-- Right column -->
              <div class="grid grid-cols-1 gap-4">
                <section aria-labelledby="section-2-title">
                  <h2 class="sr-only" id="section-2-title">LOGS</h2>
                  <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-6">
                      <!-- Your content -->
                      <p class="font-sans mb-2">LOGS TODAY {{--{{ \Carbon\Carbon::now()->format('F j, Y') }}--}}</p>
                      <ul>
                        @foreach ($logs as $log)
                          @if ($loop->odd)
                            <li class="bg-green-100 p-2"><span>{{ \Carbon\Carbon::parse($log->time)->format('h:i:s A') }}</span> <span class="float-right">IN</span></li>
                          @else
                          <li class="bg-red-100 p-2"><span>{{ \Carbon\Carbon::parse($log->time)->format('h:i:s A') }}</span> <span class="float-right">OUT</span></li>
                          @endif
                        
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </main>
        <footer class="sticky top-[100vh]">
          <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="border-t border-gray-200 py-8 text-center text-sm text-gray-500 sm:text-left"><span class="block sm:inline">&copy; 2023 PHILIPPINE NORMAL UNIVERSITY | MANAGEMENT INFORMATION SYSTEM OFFICE</span></div>
          </div>
        </footer>
      </div>

        <script type="module">
          function showTime() {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var time = new Date();
            let month = months[time.getMonth()];
            let day = time.getDate();
            let year = time.getFullYear();
            var date = month + " " + day + ", " + year;

            $("#date").html(date);
            $("#time").html(time.toLocaleTimeString());
          }
        
          setInterval(showTime, 1000);
        </script>
    </body>
</html>
