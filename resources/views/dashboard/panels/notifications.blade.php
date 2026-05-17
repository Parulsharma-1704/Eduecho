<div class="panel" id="panel-notifications">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow" style="color:var(--blue)">Center</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Notifications</div>
        </div>
        @if(isset($notifications) && $notifications->where('is_read', false)->count() > 0)
            <form id="mark-all-read-form" method="POST" action="{{ route('notifications.mark-all-read') }}" style="display:none;">
                @csrf
            </form>
            <button class="btn-teal" style="background:var(--blue-ll); color:var(--blue); border:none;" onclick="event.preventDefault(); document.getElementById('mark-all-read-form').submit();">
                <i class="ti ti-checks"></i> Mark all read
            </button>
        @endif
    </div>

    @if(Auth::user()->hasRole('admin'))
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; align-items:flex-start;">
            
            <!-- Left: Broadcast Form -->
            <div class="card" style="padding:24px;">
                <h3 style="font-family:var(--font-head); font-size:15px; font-weight:800; color:var(--navy); margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-broadcast" style="color:var(--blue); font-size:20px;"></i>
                    Broadcast Notification
                </h3>
                <p style="font-size:12px; color:var(--gray); margin-bottom:20px;">Send a role-wise or global system notification</p>
                
                <form method="POST" action="{{ route('admin.notifications.store') }}">
                    @csrf
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Target Role Audience</label>
                            <select name="target" required style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff;">
                                <option value="all">Broadcast to Everyone (All Roles)</option>
                                <option value="student">Students Only</option>
                                <option value="special_educator">Special Educators Only</option>
                                <option value="therapist">Therapists Only</option>
                            </select>
                        </div>
                        
                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Notification Class/Type</label>
                            <select name="notification_type" required style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; background:#fff;">
                                <option value="announcement">Announcement (General Info)</option>
                                <option value="alert">Alert (Urgent Attention)</option>
                                <option value="reminder">Reminder (Task or Action)</option>
                                <option value="info">System Info</option>
                            </select>
                        </div>

                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Notification Title</label>
                            <input type="text" name="title" required placeholder="e.g. Schedule Update or Maintenence Alert" style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none;">
                        </div>

                        <div>
                            <label style="font-size:11px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Detailed Message</label>
                            <textarea name="message" rows="4" required placeholder="Enter the description/announcement detail..." style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:13px; outline:none; resize:vertical;"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-teal" style="width:100%; margin-top:20px; padding:12px; background:var(--blue); font-size:13px;">
                        <i class="ti ti-send"></i> Send Broadcast Notification
                    </button>
                </form>
            </div>

            <!-- Right: Recent Sent Logs -->
            <div class="card" style="padding:0; overflow:hidden;">
                <div style="padding:16px; border-bottom:1px solid var(--teal-ll); font-weight:800; color:var(--navy); font-size:14px; background:var(--bl);">
                    Recent Notifications Log
                </div>
                @forelse($notifications ?? [] as $notif)
                    <div style="padding:16px; border-bottom:1px solid var(--teal-ll); display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:36px; height:36px; border-radius:8px; background:var(--bl); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            @php
                                $ico = match($notif->notification_type) {
                                    'alert'        => 'alert-circle',
                                    'reminder'     => 'clock',
                                    'announcement' => 'megaphone',
                                    default        => 'bell'
                                };
                            @endphp
                            <i class="ti ti-{{ $ico }}" style="color:var(--blue); font-size:18px;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2px;">
                                <span style="font-weight:700; color:var(--navy); font-size:13px;">{{ $notif->title ?? $notif->data['title'] ?? 'Notification' }}</span>
                                <span style="font-size:10px; color:var(--gray);">{{ $notif->created_at->diffForHumans() }}</span>
                            </div>
                            <p style="font-size:12px; color:var(--gray); line-height:1.4;">{{ $notif->message ?? $notif->data['message'] ?? '' }}</p>
                            <span style="font-size:9px; color:var(--teal); font-weight:800; text-transform:uppercase; margin-top:4px; display:inline-block; background:var(--teal-ll); padding:2px 6px; border-radius:4px;">
                                {{ $notif->notification_type ?? 'info' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center; padding:40px; color:var(--gray);">
                        <i class="ti ti-bell-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                        <p>No notifications broadcasted yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    @else
        <!-- Standard View for other roles (Full Width Feed) -->
        <div class="card" style="padding:0; overflow:hidden;">
            @forelse($notifications ?? [] as $notif)
                <div style="padding:16px; border-bottom:1px solid var(--teal-ll); display:flex; gap:16px; align-items:flex-start; {{ $notif->is_read ? '' : 'background:var(--bl);' }}">
                    <div style="width:40px; height:40px; border-radius:10px; background:{{ $notif->is_read ? 'var(--gray-ll)' : 'var(--bl)' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        @php
                            $ico = match($notif->notification_type ?? '') {
                                'alert'        => 'alert-circle',
                                'reminder'     => 'clock',
                                'announcement' => 'megaphone',
                                default        => 'bell'
                            };
                        @endphp
                        <i class="ti ti-{{ $ico }}" style="color:{{ $notif->is_read ? 'var(--gray)' : 'var(--blue)' }}; font-size:20px;"></i>
                    </div>
                    <div style="flex:1;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                            <span style="font-weight:700; color:var(--navy); font-size:14px;">{{ $notif->title ?? $notif->data['title'] ?? 'Notification' }}</span>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <span style="font-size:11px; color:var(--gray);">{{ $notif->created_at->diffForHumans() }}</span>
                                @if(!$notif->is_read)
                                    <form method="POST" action="{{ route('admin.notifications.mark-read', $notif->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="background:none; border:none; color:var(--blue); cursor:pointer; padding:0; display:flex; align-items:center; gap:2px;" title="Mark as read">
                                            <i class="ti ti-check" style="font-size:16px; font-weight:800;"></i>
                                            <span style="font-size:11px; font-weight:600;">Read</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p style="font-size:13px; color:var(--gray); line-height:1.4;">{{ $notif->message ?? $notif->data['message'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <div style="text-align:center; padding:40px; color:var(--gray);">
                    <i class="ti ti-bell-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                    <p>No new notifications.</p>
                </div>
            @endforelse
        </div>
    @endif
</div>

