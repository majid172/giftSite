      <aside id="layout-sidebar"
          class="overlay overlay-open:translate-x-0 drawer drawer-start sm:w-75 inset-y-0 start-0 hidden h-full [--auto-close:lg] lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
          aria-label="Sidebar" tabindex="-1">

          <div class="drawer-body border-base-content/20 h-full border-e p-0">

              <div class="flex h-full max-h-full flex-col">

                  <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden"
                      aria-label="Close" data-overlay="#layout-sidebar">

                      <span class="icon-[tabler--x] size-4.5"></span>

                  </button>

                  <div class="flex flex-col items-center justify-center gap-3  px-6 py-10 bg-base-200/30">
                      <a href="{{ url('/dashboard') }}" class="transition-all duration-300 hover:opacity-80">
                          <img src="{{ asset('/assets/images/logo.png') }}" alt="Pix Clipping"
                              class="h-16 w-20 object-contain" style="width: 200px;" />
                      </a>

                  </div>

                  <div class="h-full overflow-y-auto">

                      <ul class="accordion menu menu-sm gap-1 p-3">
                          @if(auth()->user() && auth()->user()->role === 'admin')
                          <li>
                              <a href="{{ url('/dashboard') }}" class="menu-active inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--dashboard] size-4.5"></span>
                                  <span>Dashboard</span>
                              </a>
                          </li>
                          @endif

                          <!-- Catalog Section (Admin Only) -->
                          @if(auth()->user() && auth()->user()->role === 'admin')
                          <li class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                              Catalog
                          </li>
                          <li>
                              <a href="{{ route('admin.categories.index') }}" class="inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--category] size-4.5"></span>
                                  <span>Categories</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('admin.products.index') }}" class="inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--package] size-4.5"></span>
                                  <span>Products</span>
                              </a>
                          </li>
                          @endif

                          <!-- Sales Section -->
                          <li class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                              Sales
                          </li>
                          
                          <!-- Orders Section -->
                          <li class="accordion-item" id="order">
                              <button class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                  aria-controls="order-collapse-order" aria-expanded="false">
                                  <span class="flex size-6 items-center justify-center">
                                      <span class="icon-[tabler--receipt] size-4.5"></span>
                                  </span>
                                  <span class="grow">Orders</span>
                                  <span class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                              </button>

                              <div id="order-collapse-order" class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                  aria-labelledby="order" role="region">
                                  <ul class="space-y-1">
                                      @if(auth()->user() && auth()->user()->role === 'admin')
                                      <li>
                                          <a href="{{ route('admin.orders.index') }}" class="inline-flex w-full items-center justify-between px-2">
                                              <span>All Orders</span>
                                          </a>
                                      </li>
                                      @else
                                      <li>
                                          <a href="{{ route('orders.index') }}" class="inline-flex w-full items-center justify-between px-2">
                                              <span>My Orders</span>
                                          </a>
                                      </li>
                                      @endif
                                  </ul>
                              </div>
                          </li>

                          @if(auth()->user() && auth()->user()->role === 'admin')
                          <li>
                              <a href="#" class="inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--currency-dollar] size-4.5"></span>
                                  <span>Payments</span>
                              </a>
                          </li>

                          <!-- People Section -->
                          <li class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                              People
                          </li>
                          <li>
                              <a href="#" class="inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--users] size-4.5"></span>
                                  <span>Customers</span>
                              </a>
                          </li>

                          <!-- System Section -->
                          <li class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                              System
                          </li>
                          <li>
                              <a href="#" class="inline-flex w-full items-center px-2">
                                  <span class="icon-[tabler--settings] size-4.5"></span>
                                  <span>Settings</span>
                              </a>
                          </li>
                          @endif

                          <!-- Others -->
                          <li class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                              Others
                          </li>
                          <li>
                              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-flex w-full items-center px-2">
                                  <span class="flex size-6 items-center justify-center">
                                      <span class="icon-[tabler--logout] size-4.5"></span>
                                  </span>
                                  <span>Logout</span>
                              </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                          </li>

                      </ul>

                  </div>



              </div>

          </div>

      </aside>
