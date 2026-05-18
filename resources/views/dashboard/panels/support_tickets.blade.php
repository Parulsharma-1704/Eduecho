<div class="panel" id="panel-support-tickets">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
        <div>
            <div class="eyebrow" style="color:var(--rose)">System Management</div>
            <div style="font-family:var(--font-head); font-size:20px; font-weight:900; color:var(--navy)">Support Tickets & Queries</div>
        </div>
        <div style="display:flex; gap:12px;">
            <div class="tb-search" style="width:240px; margin:0;">
                <i class="ti ti-filter"></i>
                <select id="ticket-filter" onchange="filterTickets()" style="border:none; background:transparent; outline:none; font-family:var(--font-body); font-size:13px; width:100%; color:var(--navy); cursor:pointer;">
                    <option value="all">All Tickets</option>
                    <option value="pending">Pending Only</option>
                    <option value="resolved">Resolved Only</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tickets List Layout -->
    <div style="display:flex; flex-direction:column; gap:20px;">
        @forelse($supportTickets ?? [] as $ticket)
            @php /** @var \App\Models\SupportTicket $ticket */ @endphp
            <div class="card ticket-item" data-status="{{ $ticket->status }}" style="padding:24px; transition:transform 0.2s, box-shadow:0 10px 30px rgba(0,0,0,0.05); display:flex; flex-direction:column; gap:16px; border-left:4px solid {{ $ticket->status === 'resolved' ? 'var(--teal)' : 'var(--amber)' }};">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
                    <div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:6px;">
                            <span style="font-weight:800; color:var(--navy); font-size:16px;">{{ $ticket->title }}</span>
                            @php
                                $isResolved = $ticket->status === 'resolved';
                                $badgeColor = $isResolved ? 'var(--teal)' : 'var(--amber)';
                                $badgeBg = $isResolved ? 'var(--teal-l)' : 'var(--al)';
                            @endphp
                            <span style="padding:4px 10px; border-radius:100px; font-size:10px; font-weight:800; background:{{ $badgeBg }}; color:{{ $badgeColor }}; text-transform:uppercase;">
                                {{ $ticket->status }}
                            </span>
                        </div>
                        <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--gray);">
                            <i class="ti ti-user" style="font-size:14px;"></i>
                            <span style="font-weight:700; color:var(--navy);">{{ $ticket->user->name ?? 'Unknown Filer' }}</span>
                            <span style="background:var(--teal-ll); color:var(--teal); font-weight:800; font-size:9px; padding:2px 6px; border-radius:4px; text-transform:uppercase;">
                                {{ $ticket->user ? ucfirst(str_replace('_', ' ', $ticket->user->roles->first()->name ?? 'User')) : 'User' }}
                            </span>
                            <span>•</span>
                            <i class="ti ti-clock" style="font-size:14px;"></i>
                            <span>Filed {{ $ticket->created_at->diffForHumans() }} ({{ $ticket->created_at->format('M d, Y \a\t h:i A') }})</span>
                        </div>
                    </div>

                    <!-- Action controls -->
                    <div style="display:flex; gap:8px;">
                        <form method="POST" action="{{ route('support-tickets.update-status', $ticket->id) }}">
                            @csrf
                            @method('PATCH')
                            @if($ticket->status === 'pending')
                                <input type="hidden" name="status" value="resolved">
                                <button type="submit" class="btn-teal" style="background:var(--teal); color:#fff; border:none; padding:8px 16px; font-size:12px; border-radius:8px; display:flex; align-items:center; gap:6px;">
                                    <i class="ti ti-check"></i> Solve & Resolve
                                </button>
                            @else
                                <input type="hidden" name="status" value="pending">
                                <button type="submit" class="btn-teal" style="background:var(--gray-b); color:var(--navy); border:none; padding:8px 16px; font-size:12px; border-radius:8px; display:flex; align-items:center; gap:6px;">
                                    <i class="ti ti-rotate-clockwise"></i> Reopen Ticket
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                <div style="background:var(--gray-l); border-radius:8px; padding:16px; font-size:13.5px; color:var(--navy); line-height:1.6; border:1px solid var(--teal-ll);">
                    <div style="font-size:10px; font-weight:800; text-transform:uppercase; color:var(--gray); letter-spacing:1px; margin-bottom:6px;">Query Description:</div>
                    {{ $ticket->description }}
                </div>
            </div>
        @empty
            <div class="card" style="text-align:center; padding:60px; color:var(--gray);">
                <i class="ti ti-headset" style="font-size:60px; display:block; margin-bottom:16px; color:var(--gray-b);"></i>
                <p style="font-size:16px; font-weight:700; color:var(--navy); margin-bottom:6px;">No Support Tickets Found</p>
                <p style="font-size:13px;">Everything is running smoothly! No users have filed help requests.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function filterTickets() {
        const filterVal = document.getElementById('ticket-filter').value;
        const tickets = document.querySelectorAll('.ticket-item');
        
        tickets.forEach(ticket => {
            const status = ticket.getAttribute('data-status');
            if (filterVal === 'all' || status === filterVal) {
                ticket.style.display = 'flex';
            } else {
                ticket.style.display = 'none';
            }
        });
    }
</script>
