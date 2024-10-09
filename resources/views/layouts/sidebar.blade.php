<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ \Storage::url($dataWebsite->logo_website) }}" alt="logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon icon ion-md-pulse"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    @can('view-any', App\Models\Organizer::class)
                        <li class="nav-item">
                            <a href="{{ route('organizers.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-person-lines-fill"></i>
                                <p>Penyelenggara</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\Event::class)
                        <li class="nav-item">
                            <a href="{{ route('events.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-calendar-date-fill"></i>
                                <p>Acara</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\AdressEvent::class)
                        <li class="nav-item">
                            <a href="{{ route('address-events.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-cursor-fill"></i>
                                <p>Alamat Acara</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\Ticket::class)
                        <li class="nav-item">
                            <a href="{{ route('tickets.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-ticket-perforated-fill"></i>
                                <p>Tiket</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\Contact::class)
                        <li class="nav-item">
                            <a href="{{ route('contacts.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-person-lines-fill"></i>
                                <p>Kontak</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\TransactionHeaders::class)
                        <li class="nav-item">
                            <a href="{{ route('all-transaction-headers.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-card-checklist"></i>
                                <p>Catatan Transaksi</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\TransactionDetail::class)
                        <li class="nav-item">
                            <a href="{{ route('transaction-details.index') }}" class="nav-link">
                                <i class="nav-icon icon bi bi-cash-stack"></i>
                                <p>Detail Transaksi</p>
                            </a>
                        </li>
                    @endcan
                    @can('view-any', App\Models\Refund::class)
                        <li class="nav-item">
                            <a href="{{ route('refunds.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Refunds</p>
                            </a>
                        </li>
                    @endcan


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon icon bi bi-file-earmark-code-fill"></i>
                            <p>
                                C.R.U.D
                                <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Post::class)
                                <li class="nav-item">
                                    <a href="{{ route('posts.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-file-earmark-post"></i>
                                        <p>Artikel</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Topic::class)
                                <li class="nav-item">
                                    <a href="{{ route('topics.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-clipboard-fill"></i>
                                        <p>Semua Topic</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\TopicMix::class)
                                <li class="nav-item">
                                    <a href="{{ route('topic-mixes.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-clipboard-fill"></i>
                                        <p>Topik Gabungan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Format::class)
                                <li class="nav-item">
                                    <a href="{{ route('formats.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-file-earmark-fill"></i>
                                        <p>Semua Format</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\FormatMix::class)
                                <li class="nav-item">
                                    <a href="{{ route('format-mixes.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-file-earmark-fill"></i>
                                        <p>Format Gabungan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Galery::class)
                                <li class="nav-item">
                                    <a href="{{ route('galeries.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-card-image"></i>
                                        <p>Galeri</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Juragan::class)
                                <li class="nav-item">
                                    <a href="{{ route('juragans.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-code-slash"></i>
                                        <p>Data Juragan</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon icon ion-md-apps"></i>
                            <p>
                                Lainnya
                                <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                            </p>

                        </a>
                        <ul class="nav nav-treeview">
                            @can('view-any', App\Models\User::class)
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-person-circle"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Partner::class)
                                <li class="nav-item">
                                    <a href="{{ route('partners.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-people-fill"></i>
                                        <p>Mitra</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Visitors::class)
                                <li class="nav-item">
                                    <a href="{{ route('all-visitors.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-bar-chart-fill"></i>
                                        <p>Pengunjung Artikel</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\City::class)
                                <li class="nav-item">
                                    <a href="{{ route('cities.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-buildings-fill"></i>
                                        <p>Kota</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Payment::class)
                                <li class="nav-item">
                                    <a href="{{ route('payments.index') }}" class="nav-link">
                                        <i class="nav-icon icon bi bi-grid-fill"></i>
                                        <p>Pembayaran</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                            Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon icon ion-md-key"></i>
                                <p>
                                    Kelola Akses
                                    <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('view-any', Spatie\Permission\Models\Role::class)
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Peran</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view-any', Spatie\Permission\Models\Permission::class)
                                    <li class="nav-item">
                                        <a href="{{ route('permissions.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Izin Akses</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                @endauth


                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon icon ion-md-exit"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
