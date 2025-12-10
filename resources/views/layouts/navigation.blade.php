<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 sm:hidden">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Abrir menú</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap ml-2 dark:text-white">HPEP Móvil</span>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-900 border-r border-gray-800" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900 text-white">
      
      <a href="#" class="flex items-center ps-2.5 mb-8 mt-2">
         <div class="p-2 bg-blue-600 rounded-lg mr-3 shadow-lg shadow-blue-500/30">
             <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
         </div>
         <div class="flex flex-col">
             <span class="text-lg font-bold tracking-wide text-gray-100">Recursos Físicos</span>
             <span class="text-xs text-gray-400 font-medium">Hospital El Peral</span>
         </div>
      </a>

      <div class="px-3 py-3 mb-6 bg-gray-800 rounded-lg border border-gray-700 flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold text-white shadow-md border border-gray-600">
              {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
          </div>
          <div class="flex flex-col overflow-hidden w-full">
              <span class="text-sm font-medium text-white truncate" title="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
              </span>
              
              <span class="text-[10px] text-blue-300 uppercase tracking-wider font-bold truncate">
                  {{ Auth::user()->roles->first()?->title ?? 'Usuario' }}
              </span>

              @if(Auth::user()->taller)
                  <span class="text-[10px] text-gray-400 flex items-center mt-0.5 truncate">
                      <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                      {{ Str::limit(Auth::user()->taller->name, 15) }}
                  </span>
              @endif
          </div>
      </div>

      <ul class="space-y-1 font-medium">
         
         {{-- TÍTULO DE GESTIÓN (Solo si tiene algún permiso administrativo) --}}
         @if(Auth::user()->hasPermission('dashboard_view') || Auth::user()->hasPermission('ticket_bandeja_view') || Auth::user()->hasPermission('user_index'))
             <li class="px-3 pt-2 pb-2 text-xs font-bold text-gray-500 uppercase tracking-widest mt-2">
                 Gestión
             </li>
         @endif

         {{-- 1. DASHBOARD --}}
         @if(Auth::user()->hasPermission('dashboard_view'))
             <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white group transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                   </svg>
                   <span class="ms-3">Dashboard</span>
                </a>
             </li>
         @endif

         {{-- 2. BANDEJA DE TICKETS --}}
         @if(Auth::user()->hasPermission('ticket_bandeja_view'))
             <li>
                <a href="{{ route('rrff.tickets.index') }}" 
                   class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white group transition-all duration-200 {{ request()->routeIs('rrff.tickets.index') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('rrff.tickets.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                   </svg>
                   <span class="ms-3">Bandeja de Tickets</span>
                   
                   @php $openCount = \App\Models\Ticket::where('status_id', 1)->count(); @endphp
                   @if($openCount > 0)
                       <span class="inline-flex items-center justify-center px-2 py-0.5 ms-auto text-xs font-bold text-blue-800 bg-blue-100 rounded-full">
                           {{ $openCount }}
                       </span>
                   @endif
                </a>
             </li>
         @endif

         {{-- 3. USUARIOS --}}
         @if(Auth::user()->hasPermission('user_index'))
             <li>
               <a href="{{ route('rrff.users.index') }}" 
                  class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white group transition-all duration-200 {{ request()->routeIs('rrff.users.*') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                  <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('rrff.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                   </svg>
                  <span class="ms-3">Usuarios</span>
               </a>
            </li>
         @endif

         {{-- 4. CONFIGURACIÓN --}}
         @if(Auth::user()->hasPermission('settings_manage'))
             <li>
                <a href="{{ route('rrff.settings.index') }}" 
                   class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white group transition-all duration-200 {{ request()->routeIs('rrff.settings.index') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                   <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('rrff.settings.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                   <span class="ms-3">Configuración</span>
                </a>
             </li>
         @endif

         {{-- GRUPO: OPERATIVO --}}
         @if(Auth::user()->hasPermission('ticket_execution'))
             
             <li class="px-3 pt-4 pb-2 text-xs font-bold text-gray-500 uppercase tracking-widest mt-2 border-t border-gray-800">
                 Operativo
             </li>

             <li>
               <a href="{{ route('technician.index') }}" 
                  class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white group transition-all duration-200 {{ request()->routeIs('technician.*') ? 'bg-green-700 text-white shadow-md' : '' }}">
                  <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('technician.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                  <span class="ms-3">Mis Tareas</span>
               </a>
            </li>
         @endif

 

         <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center p-3 text-gray-300 rounded-lg hover:bg-red-900/50 hover:text-red-300 group transition-all duration-200">
                   <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                   <span class="ms-3 whitespace-nowrap">Cerrar Sesión</span>
                </button>
            </form>
         </li>
      </ul>
   </div>
</aside>