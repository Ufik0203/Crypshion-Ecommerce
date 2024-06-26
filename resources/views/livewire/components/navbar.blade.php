<header class="flex flex-wrap w-full py-4 text-sm bg-white sm:justify-start sm:flex-nowrap">
  <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between"
    aria-label="Global">
    <a class="flex-none text-xl font-semibold sm:order-1 dark:text-white" href="#">
      <img src="/img/logo/secon-logo.png" alt="Logo" class="w-32">
    </a>
    <div class="flex items-center sm:order-3 gap-x-2">

      <div class="flex items-center">
        @guest
          <a href="/login" wire:navigate class="hidden mb-2 font-semibold lg:block">Login</a>
        @endguest



        {{-- Notification start --}}
        <div class="relative inline-flex mb-1 hs-dropdown ">
          <button id="hs-dropdown-with-icons" type="button"
            class="inline-flex items-center text-xl font-medium ms-3 hs-dropdown-toggle gap-x-2 disabled:opacity-50 disabled:pointer-events-none ">
            <iconify-icon icon="tdesign:notification"></iconify-icon>
          </button>

          <div
            class="hs-dropdown-menu scrollbar-menu z-10 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 h-64 overflow-auto hidden w-full md:w-96 bg-white shadow-md rounded-lg p-2 mt-2 divide-y divide-gray-200"
            aria-labelledby="hs-dropdown-with-icons">
            @auth
              <div class="py-2 first:pt-0 last:pb-0">
                @foreach ($notification as $notif)
                  @if ($notif->status == 'Packaged')
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 "
                      href="#">
                      <div class="flex items-center">
                        <iconify-icon icon="ph:package" class="text-4xl text-blue-500"></iconify-icon>
                        <div class="ms-3">
                          <h4 class="font-semibold">{{ $notif->status }}</h4>
                          Your order has been packed by the seller <br>
                          <small class="text-xs">{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                      </div>
                    </a>
                  @elseif($notif->status == 'Delivered')
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 "
                      href="#">
                      <div class="flex items-center">
                        <iconify-icon icon="hugeicons:truck-delivery" class="text-4xl text-purple-500"></iconify-icon>
                        <div class="ms-3">
                          <h4 class="font-semibold">{{ $notif->status }}</h4>
                          Your order is being delivered <br>
                          <small class="text-xs">{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                      </div>
                    </a>
                  @elseif ($notif->status == 'Completed')
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 "
                      href="#">
                      <div class="flex items-center">
                        <iconify-icon icon="gg:check-o" class="text-4xl text-green-500"></iconify-icon>
                        <div class="ms-3">
                          <h4 class="font-semibold">{{ $notif->status }}</h4>
                          Your order has arrived at its destination <br>
                          <small class="text-xs">{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                      </div>
                    </a>
                  @endif
                @endforeach

              </div>
            @endauth


            @guest
              <div class="flex items-center justify-center py-2 first:pt-0 last:pb-0">
                <div class="mt-10 text-center text-slate-500">
                  <iconify-icon icon="hugeicons:notification-off-01" class="text-3xl"></iconify-icon>
                  <p class="">Nothing Notification</p>
                </div>
              </div>
            @endguest


          </div>
        </div>
        {{-- Notification end --}}


        {{-- Cart icon start --}}
        <a href="/cart" {{-- wire:navigate --}} class="relative inline-block ms-3">
          <iconify-icon icon="tdesign:cart" class="text-xl"></iconify-icon>
          @if ($cartCount > 0)
            <span
              class="absolute top-0 end-0 inline-flex items-center py-0.3 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white">
              {{ $cartCount }}
            </span>
          @endif

        </a>
        {{-- Cart icon end --}}


        {{-- Avatar start --}}
        @auth
          <div class="relative inline-flex mb-1 ms-3 hs-dropdown">
            <button id="hs-dropdown-with-header" type="button"
              class="inline-flex items-center overflow-hidden text-sm font-medium text-gray-800 bg-white rounded-full shadow-sm w-7 h-7 hs-dropdown-toggle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
              <img src="{{ asset('storage/file/avatar/' . Auth::user()->avatar) }}" alt="avatar" class="w-full">
            </button>

            <div
              class="hs-dropdown-menu z-10 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 "
              aria-labelledby="hs-dropdown-with-header">
              <div class="px-5 py-3 -m-2 bg-gray-200 rounded-t-lg">
                <p class="text-sm text-gray-500">Signed in as</p>
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</p>
              </div>
              <div class="py-2 mt-2 first:pt-0 last:pb-0">
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                  href="/profile" wire:navigate>
                  <iconify-icon icon="ph:user-bold" class="text-lg"></iconify-icon>
                  Profile
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                  href="/orders" wire:navigate>
                  <iconify-icon icon="mdi:shopping-outline" class="text-lg"></iconify-icon>
                  My Orders
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                  href="/order-history" wire:navigate>
                  <iconify-icon icon="system-uicons:box-open" class="text-lg"></iconify-icon>
                  Order History
                </a>
                {{-- <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                  href="/profile/settings" wire:navigate>
                  <iconify-icon icon="ant-design:setting-outlined" class="text-lg"></iconify-icon>
                  Settings
                </a> --}}
                <form action="/logout"
                  class="px-3 py-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                  <button type="submit" class="flex w-full items-center gap-x-3.5 ">
                    <iconify-icon icon="material-symbols:logout" class="text-lg"></iconify-icon>
                    Logout
                  </button>

                </form>
              </div>
            </div>
          </div>
        @endauth
        {{-- Avatar end --}}

      </div>
      <button type="button"
        class="sm:hidden hs-collapse-toggle p-2.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:hover:bg-white/10"
        data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
          height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="3" x2="21" y1="6" y2="6" />
          <line x1="3" x2="21" y1="12" y2="12" />
          <line x1="3" x2="21" y1="18" y2="18" />
        </svg>
        <svg class="flex-shrink-0 hidden hs-collapse-open:block size-4" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <div id="navbar-alignment"
      class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
      <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
        <a class="font-medium text-slate-600" href="/" wire:navigate aria-current="page">Home</a>

        <div class="hs-dropdown [--trigger:hover] relative inline-flex">
          <button id="hs-dropdown-hover-event" type="button"
            class="inline-flex items-center text-sm font-medium text-slate-600 hs-dropdown-toggle disabled:opacity-50 disabled:pointer-events-nonedark:border-neutral-700 ">
            Shop
            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
          <div
            class="hs-dropdown-menu transition-[opacity,margin] z-10 duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
            aria-labelledby="hs-dropdown-hover-event">
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 1 }}" wire:navigate>
              Clothes
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 2 }}" wire:navigate>
              Trousers
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 3 }}" wire:navigate>
              Shoe
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 4 }}" wire:navigate>
              Jacket
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 5 }}" wire:navigate>
              Hat
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
              href="/category/{{ 6 }}" wire:navigate>
              Bag
            </a>
          </div>
        </div>
        <a class="font-medium text-slate-600 hover:text-gray-400" href="/products" wire:navigate>Product</a>
        <a class="font-medium text-slate-600 hover:text-gray-400" href="/about" wire:navigate>About</a>
        <a class="font-medium text-slate-600 hover:text-gray-400" href="/contact" wire:navigate>Contact</a>
        @guest
          <a class="font-medium text-slate-600 hover:text-gray-400 lg:hidden" href="/login" wire:navigate>Login</a>
        @endguest
      </div>
    </div>
  </nav>
</header>
