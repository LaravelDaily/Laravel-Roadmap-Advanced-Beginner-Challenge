<div>
    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
        <a class="nav-link dropdown-toggle hide-arrow {{ $showNotification }}" href="" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" aria-expanded="true">
            <i class="bx bx-bell bx-sm"></i>
            <span class="badge bg-danger rounded-pill badge-notifications" style="position: relative;right:14px;bottom: 10px;">{{ count($notifications) }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0 {{ $showNotification }}" data-bs-popper="none">
            <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                    <h5 class="text-body mb-0 me-auto">Notifications</h5>
                    <a wire:click="markAllAsRead" class="dropdown-notifications-all text-body"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="" style="cursor: pointer;"
                        data-bs-original-title="Mark all as read" aria-label="Mark all as read"><i
                            class="bx fs-4 bx-envelope-open"></i></a>
                </div>
            </li>
            <li class="dropdown-notifications-list scrollable-container ps">
                <ul class="list-group list-group-flush">
                    @forelse ($notifications as $notification)
                    <li
                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read" style="width: 350px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <span class="avatar-initial rounded-circle bg-label-{{ $notification->data['color'] }}"><i
                                            class="bx bx-{{ $notification->data['icon'] }}"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $notification->data['message'] }}</h6>
                                <p class="mb-0">{{ $notification->data['name'] .' '. $notification->data['type'] }}</p>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions" title="Mark As Read" style="cursor: pointer;">
                                <a wire:click="markAsRead('{{ $notification->id }}')" class="dropdown-notifications-archive"><span
                                        class="bx bx-x"></span></a>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li
                        class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read" style="width: 350px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <span class="avatar-initial rounded-circle bg-label-success"><i
                                            class="bx bx-pie-chart-alt"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mt-2">There Is No New Notifications For You</h6>
                            </div>
                        </div>
                    </li>
                    @endforelse
                </ul>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </li>
        </ul>
    </li>
</div>
