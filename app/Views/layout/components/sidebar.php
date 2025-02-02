<div class="data-scrollbar" data-scroll="1">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="side-menu">
            <li class="sidebar-layout <?= current_url() === base_url('/dashboard') ? ' active' : '' ?>">
                <a href="<?= base_url('/admin/dashboard') ?>" class="svg-icon">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </i>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li class="px-3 pt-3 pb-2">
                <span class="text-uppercase small font-weight-bold">Data Master</span>
            </li>
            <li class=" sidebar-layout <?= current_url() === base_url('/kelola-user') ? ' active' : '' ?>">
                <a href="<?= base_url('/kelola-user') ?>" class="svg-icon">
                    <i class="">
                        <svg class="svg-icon" id="iq-user-1-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </i><span class="ml-2">Kelola User</span>
                </a>
            </li>
            <li class=" sidebar-layout <?= current_url() === base_url('/data-latih') ? ' active' : '' ?>">
                <a href="<?= base_url('/data-latih') ?>" class="svg-icon">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </i><span class="ml-2">Kelola Data Latih</span>
                </a>
            </li>
            <li class=" sidebar-layout <?= current_url() === base_url('/kelola-pengaduan') ? ' active' : '' ?>">
                <a href="<?= base_url('/kelola-pengaduan') ?>" class="svg-icon">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </i><span class="ml-2">Kelola Pengaduan</span>
                </a>
            </li>
            <!-- <li class=" sidebar-layout <?= current_url() === base_url('/kelola-tindakan') ? ' active' : '' ?>">
                <a href="<?= base_url('/kelola-tindakan') ?>" class="svg-icon">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </i><span class="ml-2">Kelola Tindakan</span>
                </a>
            </li> -->
        </ul>
    </nav>
    <div class="pt-5 pb-5"></div>
</div>