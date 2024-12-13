<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ 'PT' }}</a>
            <a href="#" class="simple-text logo-normal">{{ 'PERUSAHAAN' }}</a>
        </div>
        @if (auth()->user()->role_id == 1)
            <ul class="nav">
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt"></i> <!-- Ikon Dashboard -->
                        <p>{{ 'Dashboard' }}</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#example"
                        aria-expanded="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? '' : 'collapsed' }}">
                        <i class="fas fa-users-cog"></i> <!-- Ikon User Configurasi -->
                        <span class="nav-link-text">{{ 'User Configurasi' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'show' : '' }}"
                        id="example">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'profile') class="active " @endif>
                                <a href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user"></i> <!-- Ikon User Profile -->
                                    <p>{{ 'User Profile' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'users') class="active " @endif>
                                <a href="{{ route('user.index') }}">
                                    <i class="fas fa-users"></i> <!-- Ikon User Management -->
                                    <p>{{ 'User Management' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'roles') class="active " @endif>
                                <a href="{{ route('role.index') }}">
                                    <i class="fas fa-user-tag"></i> <!-- Ikon Role Management -->
                                    <p>{{ 'Role Management' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#checklist_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'CHECKLIST P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'show' : '' }}"
                        id="checklist_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'input_inspeksi') class="active " @endif>
                                <a href="{{ route('inspeksi.create') }}">
                                    <i class="fas fa-tasks"></i> <!-- Ikon Manage Uraian -->
                                    <p>{{ 'Input Inspeksi' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'riwayat_inspeksi') class="active " @endif>
                                <a href="{{ route('inspeksi.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Inspeksi' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#pemakaian_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'PEMAKAIAN P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'show' : '' }}"
                        id="pemakaian_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'riwayat_pemakaian') class="active " @endif>
                                <a href="{{ route('pemakaian.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Pemakaian' }}</p>
                                </a>
                            </li>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#manage_sidebar"
                        aria-expanded="{{ in_array($pageSlug, ['manage_barang', 'manage_kondisi', 'manage_kotak']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['manage_barang', 'manage_kondisi', 'manage_kotak']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'MANAGE DATA' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['manage_barang', 'manage_kondisi', 'manage_kotak']) ? 'show' : '' }}"
                        id="manage_sidebar">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'manage_barang') class="active " @endif>
                                <a href="{{ route('barang.index') }}">
                                    <i class="fas fa-tasks"></i> <!-- Ikon Manage Uraian -->
                                    <p>{{ 'Manage Barang' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'manage_kondisi') class="active " @endif>
                                <a href="{{ route('kondisi.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Manage Kondisi' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'manage_kotak') class="active " @endif>
                                <a href="{{ route('kotak.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Manage Kotak' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        @endif
        @if (auth()->user()->role_id == 2)
            <ul class="nav">
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt"></i> <!-- Ikon Dashboard -->
                        <p>{{ 'Dashboard' }}</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#example"
                        aria-expanded="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? '' : 'collapsed' }}">
                        <i class="fas fa-users-cog"></i> <!-- Ikon User Configurasi -->
                        <span class="nav-link-text">{{ 'User Configurasi' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'show' : '' }}"
                        id="example">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'profile') class="active " @endif>
                                <a href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user"></i> <!-- Ikon User Profile -->
                                    <p>{{ 'User Profile' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#checklist_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'CHECKLIST P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'show' : '' }}"
                        id="checklist_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'riwayat_inspeksi') class="active " @endif>
                                <a href="{{ route('inspeksi.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Inspeksi' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#pemakaian_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'PEMAKAIAN P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'show' : '' }}"
                        id="pemakaian_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'riwayat_pemakaian') class="active " @endif>
                                <a href="{{ route('pemakaian.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Pemakaian' }}</p>
                                </a>
                            </li>
                    </div>
                </li>
            </ul>
        @endif
        @if (auth()->user()->role_id == 3)
            <ul class="nav">
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt"></i> <!-- Ikon Dashboard -->
                        <p>{{ 'Dashboard' }}</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#example"
                        aria-expanded="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? '' : 'collapsed' }}">
                        <i class="fas fa-users-cog"></i> <!-- Ikon User Configurasi -->
                        <span class="nav-link-text">{{ 'User Configurasi' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'show' : '' }}"
                        id="example">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'profile') class="active " @endif>
                                <a href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user"></i> <!-- Ikon User Profile -->
                                    <p>{{ 'User Profile' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#checklist_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'CHECKLIST P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['input_inspeksi', 'riwayat_inspeksi']) ? 'show' : '' }}"
                        id="checklist_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'input_inspeksi') class="active " @endif>
                                <a href="{{ route('inspeksi.create') }}">
                                    <i class="fas fa-tasks"></i> <!-- Ikon Manage Uraian -->
                                    <p>{{ 'Input Inspeksi' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'riwayat_inspeksi') class="active " @endif>
                                <a href="{{ route('inspeksi.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Inspeksi' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#pemakaian_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'PEMAKAIAN P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'show' : '' }}"
                        id="pemakaian_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'riwayat_pemakaian') class="active " @endif>
                                <a href="{{ route('pemakaian.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Pemakaian' }}</p>
                                </a>
                            </li>
                    </div>
                </li>
            </ul>
        @endif
        @if (auth()->user()->role_id == 4)
            <ul class="nav">

                <li>
                    <a data-toggle="collapse" href="#pemakaian_p3k"
                        aria-expanded="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['riwayat_pemakaian']) ? '' : 'collapsed' }}">
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'PEMAKAIAN P3K' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['riwayat_pemakaian']) ? 'show' : '' }}"
                        id="pemakaian_p3k">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'riwayat_pemakaian') class="active " @endif>
                                <a href="{{ route('pemakaian.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Riwayat Pemakaian' }}</p>
                                </a>
                            </li>
                    </div>
                </li>

            </ul>
        @endif
    </div>
</div>
