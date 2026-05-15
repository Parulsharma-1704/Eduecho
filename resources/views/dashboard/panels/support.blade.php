<div class="panel" id="panel-support">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--rd)">Help Center</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Support & Reporting</div>
        </div>
    </div>
    
    <div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:24px;">
        <div class="card" style="padding:24px;">
            <h3 style="font-size:15px; font-weight:700; color:var(--navy); margin-bottom:16px;">Submit a Ticket</h3>
            <form method="POST" action="{{ route('support-tickets.store') }}">
                @csrf
                <div style="display:flex; flex-direction:column; gap:16px;">
                    <div>
                        <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Issue Title</label>
                        <input type="text" name="title" required placeholder="e.g. Can't access my course" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="font-size:12px; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;">Description</label>
                        <textarea name="description" required rows="5" placeholder="Please describe your issue in detail..." style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; font-family:var(--font-body); font-size:14px; outline:none; box-sizing:border-box; resize:none;"></textarea>
                    </div>
                    <button type="submit" class="btn-teal" style="background:var(--rose);">Submit Ticket</button>
                </div>
            </form>
        </div>
        <div class="card" style="padding:0; overflow:hidden;">
            <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9; font-weight:700; color:var(--navy);">My Support History</div>
            <div style="max-height:400px; overflow-y:auto;">
                @forelse($supportTickets ?? [] as $ticket)
                    <div style="padding:16px 24px; border-bottom:1px solid #f1f5f9;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                            <span style="font-weight:700; color:var(--navy); font-size:14px;">{{ $ticket->title }}</span>
                            @php
                                $statusStyles = [
                                    'pending' => ['bg' => 'var(--al)', 'color' => 'var(--ad)'],
                                    'open' => ['bg' => 'var(--bl)', 'color' => 'var(--blue)'],
                                    'resolved' => ['bg' => 'var(--teal-ll)', 'color' => 'var(--teal)'],
                                    'closed' => ['bg' => 'var(--gray-b)', 'color' => 'var(--gray)'],
                                ];
                                $ss = $statusStyles[$ticket->status] ?? ['bg' => '#f1f5f9', 'color' => '#888'];
                            @endphp
                            <span class="pill" style="background:{{ $ss['bg'] }}; color:{{ $ss['color'] }}; font-size:9px; border:none;">{{ ucfirst($ticket->status) }}</span>
                        </div>
                        <p style="font-size:12px; color:var(--gray); line-height:1.4; margin-bottom:8px;">{{ Str::limit($ticket->description, 100) }}</p>
                        <span style="font-size:10px; color:var(--gray-d);">Submitted {{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div style="padding:40px; text-align:center; color:var(--gray);">
                        <p>No support tickets submitted yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
