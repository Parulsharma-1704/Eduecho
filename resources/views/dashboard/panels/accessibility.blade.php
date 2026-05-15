<div class="panel" id="panel-accessibility">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <div class="eyebrow" style="color:var(--teal)">Inclusivity</div>
            <div style="font-family:var(--font-head);font-size:18px;font-weight:900;color:var(--navy)">Global Accessibility Settings</div>
        </div>
    </div>
    <div class="card" style="padding:24px;">
        <p style="font-size:13px; color:var(--gray); margin-bottom:24px;">These settings apply accessibility overrides to the platform interface immediately.</p>
        
        <div style="display:flex; flex-direction:column; gap:20px;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                <div>
                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Dyslexia Friendly Font</div>
                    <div style="font-size:12px; color:var(--gray);">Uses OpenDyslexic font and optimized spacing.</div>
                </div>
                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                    <input type="checkbox" id="toggle-dyslexia" {{ ($accessibilityProfile->font_family ?? '') === 'Dyslexia' ? 'checked' : '' }} onchange="toggleAccessibility('dyslexia-font', this.checked)" style="opacity:0; width:0; height:0;">
                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                </label>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                <div>
                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">Focus Mode</div>
                    <div style="font-size:12px; color:var(--gray);">Simplifies the interface and minimizes distractions.</div>
                </div>
                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                    <input type="checkbox" id="toggle-focus" {{ ($accessibilityProfile->focus_mode ?? false) ? 'checked' : '' }} onchange="toggleAccessibility('focus-mode', this.checked)" style="opacity:0; width:0; height:0;">
                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                </label>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:20px; border-bottom:1px solid #f1f5f9;">
                <div>
                    <div style="font-weight:700; color:var(--navy); font-size:14px; margin-bottom:4px;">High Contrast Mode</div>
                    <div style="font-size:12px; color:var(--gray);">Increases contrast across text and interactive elements.</div>
                </div>
                <label style="position:relative; display:inline-block; width:44px; height:24px;">
                    <input type="checkbox" id="toggle-contrast" {{ ($accessibilityProfile->high_contrast ?? false) ? 'checked' : '' }} onchange="toggleAccessibility('high-contrast', this.checked)" style="opacity:0; width:0; height:0;">
                    <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#cbd5e1; transition:.4s; border-radius:24px;" class="slider"></span>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAccessibility(setting, isEnabled) {
        const classMap = {
            'high-contrast': 'high-contrast',
            'dyslexia-font': 'font-dyslexia',
            'focus-mode': 'focus-mode'
        };
        
        const className = classMap[setting];
        if (className) {
            if (isEnabled) {
                document.body.classList.add(className);
            } else {
                document.body.classList.remove(className);
            }
        }

        // Save via AJAX (implementation in DashboardController or separate AccessibilityController)
        const dbMap = {
            'high-contrast': 'high_contrast',
            'dyslexia-font': 'font_family',
            'focus-mode': 'focus_mode'
        };

        const dbField = dbMap[setting];
        if (dbField && typeof accessibilityUpdateUrl !== 'undefined') {
            let value = isEnabled;
            if (dbField === 'font_family') value = isEnabled ? 'Dyslexia' : 'Standard';

            fetch(accessibilityUpdateUrl, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ [dbField]: value })
            });
        }
    }
</script>

<style>
    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider { background-color: var(--teal); }
    input:checked + .slider:before { transform: translateX(20px); }
</style>
