<div class="panel" id="panel-settings">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--gray)">Preferences</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">System Settings</div>
        </div>
    </div>
    
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px;">
        <div class="card" style="padding:24px;">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                <div style="width:36px; height:36px; border-radius:8px; background:var(--teal-ll); display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-moon" style="color:var(--teal)"></i>
                </div>
                <h3 style="font-weight:700; color:var(--navy); font-size:16px;">Appearance</h3>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid #f1f5f9;">
                <span style="font-size:14px; color:var(--navy)">Dark Mode</span>
                <button class="tb-icon-btn" onclick="document.body.classList.toggle('dark-mode')"><i class="ti ti-power"></i></button>
            </div>
        </div>

        <div class="card" style="padding:24px;">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                <div style="width:36px; height:36px; border-radius:8px; background:var(--bl); display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-bell" style="color:var(--blue)"></i>
                </div>
                <h3 style="font-weight:700; color:var(--navy); font-size:16px;">Notifications</h3>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid #f1f5f9;">
                <span style="font-size:14px; color:var(--navy)">Email Alerts</span>
                <span style="color:var(--teal); font-size:12px; font-weight:700;">Enabled</span>
            </div>
        </div>
    </div>
</div>
