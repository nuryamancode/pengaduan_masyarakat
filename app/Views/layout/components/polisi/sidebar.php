<div class="data-scrollbar" data-scroll="1">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="side-menu">
            <li class="sidebar-layout <?= current_url() === base_url('/dashboard') ? ' active' : '' ?>">
                <a href="<?= base_url('/polisi/dashboard') ?>" class="svg-icon">
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
            <li class=" sidebar-layout <?= current_url() === base_url('/tindakan') ? ' active' : '' ?>">
                <a href="<?= base_url('/tindakan') ?>" class="svg-icon">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </i><span class="ml-2">Tindakan</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="pt-5 pb-5"></div>
</div>