<div class="panel" id="panel-notifications">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <div>
            <div class="eyebrow" style="color:var(--blue)">Center</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Notifications</div>
        </div>
        <button class="btn-teal" style="background:var(--blue-ll); color:var(--blue)" onclick="markAllRead()"><i class="ti ti-checks"></i> Mark all read</button>
    </div>
    <div class="card" style="padding:0; overflow:hidden;">
        @forelse($notifications ?? [] as $notif)
            <div style="padding:16px; border-bottom:1px solid var(--teal-ll); display:flex; gap:16px; align-items:flex-start; {{ $notif->read_at ? '' : 'background:var(--bl);' }}">
                <div style="width:40px; height:40px; border-radius:10px; background:{{ $notif->read_at ? 'var(--gray-ll)' : 'var(--bl)' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-{{ $notif->data['icon'] ?? 'bell' }}" style="color:{{ $notif->read_at ? 'var(--gray)' : 'var(--blue)' }}; font-size:20px;"></i>
                </div>
                <div style="flex:1;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                        <span style="font-weight:700; color:var(--navy); font-size:14px;">{{ $notif->data['title'] ?? 'Notification' }}</span>
                        <span style="font-size:11px; color:var(--gray);">{{ $notif->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="font-size:13px; color:var(--gray); line-height:1.4;">{{ $notif->data['message'] ?? '' }}</p>
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:40px; color:var(--gray);">
                <i class="ti ti-bell-off" style="font-size:40px; display:block; margin-bottom:12px;"></i>
                <p>No new notifications.</p>
            </div>
        @endforelse
    </div>
</div>
