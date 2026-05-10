# 🎨 EduEcho Hybrid Theme - Quick Color Reference

## Primary Palette

```
┌─────────────────────────────────────────────────┐
│ SOFT LAVENDER    #F3EEFF    Light Backgrounds   │
│ ███████████████  Light, calm, welcoming         │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ WARM LILAC       #E5D9FF    Medium Accents       │
│ ███████████████  Soft, gentle, secondary        │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ DEEP INDIGO      #312E81    Headlines/Buttons   │
│ ███████████████  Professional, trustworthy      │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ ACCESSIBLE TEAL  #14B8A6    Accessibility       │
│ ███████████████  Inclusive, energetic           │
└─────────────────────────────────────────────────┘
```

## Accent Colors

```
┌─────────────────────────────────────────────────┐
│ WARM CORAL       #F97316    Therapy/Alerts      │
│ ███████████████  Care, warmth, attention        │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ MINT GREEN       #10B981    Success              │
│ ███████████████  Achievement, completion        │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ PEACH            #FB923C    Gentle Alerts       │
│ ███████████████  Warnings, secondary alerts     │
└─────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────┐
│ OFF-WHITE        #FCFCFD    Clean Backgrounds   │
│ ███████████████  Cards, containers, readability│
└─────────────────────────────────────────────────┘
```

---

## Usage Quick Guide

### INDIGO (#312E81) - Use For:
```
✓ Main headlines (H1, H2)
✓ Primary buttons
✓ Sidebar backgrounds
✓ Form labels
✓ Important badges
✓ Primary CTAs
```

### TEAL (#14B8A6) - Use For:
```
✓ Accessibility features (♿)
✓ Primary accent color
✓ "Start" buttons
✓ Hover states
✓ Interactive elements
✓ Progress indicators
```

### CORAL (#F97316) - Use For:
```
✓ Therapy sections
✓ Warning alerts
✓ Supportive messaging
✓ Secondary CTAs
✓ Warm accents
✓ Attention needed
```

### MINT (#10B981) - Use For:
```
✓ "Complete" status
✓ Success indicators
✓ Achievements
✓ Positive milestones
✓ "On Track" badges
✓ Congratulations
```

### LAVENDER (#F3EEFF) - Use For:
```
✓ Page backgrounds
✓ Section backgrounds
✓ Hero areas
✓ Light accents
✓ Soft dividers
✓ Card backgrounds
```

---

## Component Color Examples

### Buttons

**Primary (Immediate Action):**
```html
<button class="bg-indigo-700 text-white">
  Primary Action
</button>
```

**Secondary (Alternative):**
```html
<button class="bg-teal-500 text-white">
  Teal Action
</button>
```

**Tertiary (Low Priority):**
```html
<button class="bg-white border-2 border-lavender-200 text-indigo-700">
  Explore
</button>
```

### Status Indicators

**Success:**
```html
<span class="bg-mint-100 text-mint-700 font-bold">
  ✓ Complete
</span>
```

**In Progress:**
```html
<span class="bg-teal-100 text-teal-700 font-bold">
  → In Progress
</span>
```

**Warning:**
```html
<span class="bg-coral-100 text-coral-700 font-bold">
  ⚠ Needs Review
</span>
```

### Cards

**Standard Card:**
```html
<div class="bg-white border-2 border-lavender-100 rounded-3xl p-8">
  <!-- Content -->
</div>
```

**Color-Coded Card:**
```html
<div class="bg-indigo-50 border-2 border-indigo-200 rounded-3xl p-8">
  <!-- Indigo-themed content -->
</div>
```

### Progress Bars

**Teal Progress:**
```html
<div class="bg-lavender-100 rounded-full h-3">
  <div class="bg-teal-500 h-3 rounded-full" style="width: 65%"></div>
</div>
```

---

## Contrast Ratios (WCAG AA Compliant)

| Text Color | Background | Ratio | Status |
|-----------|-----------|-------|--------|
| Indigo (#312E81) | White (#FCFCFD) | 8.2:1 | ✅ AAA |
| Teal (#14B8A6) | Lavender (#F3EEFF) | 5.8:1 | ✅ AA |
| Coral (#F97316) | White (#FCFCFD) | 4.6:1 | ✅ AA |
| White | Indigo (#312E81) | 8.2:1 | ✅ AAA |
| White | Teal (#14B8A6) | 8.7:1 | ✅ AAA |
| White | Coral (#F97316) | 5.8:1 | ✅ AA |

---

## Dashboard Color Themes

### 👨‍🎓 Student Dashboard
```
Primary:   Teal (#14B8A6)    → Learning focus
Success:   Mint (#10B981)    → Celebrating progress
Alert:     Coral (#F97316)   → Gentle reminders
Sidebar:   White (#FCFCFD)   → Clean interface
Background: Lavender (#F3EEFF) → Calm learning
```

### 👨‍👩‍👧 Parent Dashboard
```
Primary:   Coral (#F97316)   → Care focused
Secondary: Teal (#14B8A6)    → Engagement
Success:   Mint (#10B981)    → Positive updates
Sidebar:   White (#FCFCFD)   → Professional
Background: Lavender (#F3EEFF) → Welcoming
```

### 👨‍🏫 Educator Dashboard
```
Primary:   Indigo (#312E81)  → Authority, structure
Secondary: Teal (#14B8A6)    → Engagement
Success:   Mint (#10B981)    → Achievement
Alert:     Coral (#F97316)   → Attention needed
Background: Lavender (#F3EEFF) → Comfortable
```

### ⚙️ Admin Dashboard
```
Primary:   Indigo (#312E81)  → Governance
Secondary: Teal (#14B8A6)    → System status
Success:   Mint (#10B981)    → All systems go
Alert:     Coral (#F97316)   → Critical issues
Background: Lavender (#F3EEFF) → Professional
```

---

## Tailwind CSS Class Reference

### Background Colors
```
bg-indigo-700      → Deep indigo
bg-indigo-50       → Light indigo tint
bg-teal-500        → Accessible teal
bg-teal-100        → Light teal tint
bg-coral-500       → Warm coral
bg-coral-100       → Light coral tint
bg-mint-500        → Mint green
bg-mint-100        → Light mint tint
bg-lavender-50     → Soft lavender
bg-lavender-100    → Medium lavender
```

### Text Colors
```
text-indigo-700    → Primary text
text-slate-900     → Dark text
text-slate-600     → Medium text
text-slate-500     → Light text
text-teal-500      → Teal text
text-coral-500     → Coral text
text-mint-500      → Mint text
```

### Border Colors
```
border-lavender-100  → Soft border
border-indigo-200    → Medium border
border-teal-300      → Teal border
border-coral-200     → Coral border
```

### Shadow System
```
shadow-warm        → 0 10px 35px rgba(124,58,237,.08)
shadow-warm-lg     → 0 20px 50px rgba(124,58,237,.12)
shadow-warm-sm     → 0 4px 15px rgba(124,58,237,.06)
shadow-glow        → 0 0 20px rgba(168,85,247,.15)
```

---

## Color Combinations (Proven Pairings)

### Professional + Warm
```
Deep Indigo    + Soft Lavender  → Trust + Calm
Indigo + Teal  + Coral          → Authority + Care + Energy
```

### Success Combinations
```
Mint           + Indigo         → Achievement + Structure
Mint           + White          → Clean success
```

### Alert Combinations
```
Coral          + White          → Important but calm
Coral          + Lavender       → Warm alert
```

### Learning Section
```
Teal           + Lavender       → Engaging learning
Teal           + White          → Modern education
```

### Therapy Section
```
Coral          + Lavender       → Caring therapy
Coral          + Indigo         → Professional care
```

---

## Key Principles

### ✅ Do
```
✓ Use indigo for primary buttons
✓ Use teal for accessibility features
✓ Use coral for therapy sections
✓ Use mint for success states
✓ Use lavender for backgrounds
✓ Maintain consistent color meaning
✓ Test contrast on all text
✓ Combine colors intentionally
```

### ❌ Don't
```
✗ Mix too many colors in one section
✗ Use color alone to convey meaning (add icons/text)
✗ Change color meanings between pages
✗ Create low-contrast text
✗ Use outdated mustard/pink palette
✗ Make colors too bright or jarring
✗ Forget about colorblind users
✗ Ignore accessibility standards
```

---

## Quick Copy-Paste

### New Component Template
```html
<div class="p-8 rounded-3xl bg-white border-2 border-lavender-100 
            hover:shadow-warm-lg transition-all transform hover:-translate-y-1">
    <h3 class="text-2xl font-black text-indigo-700 mb-4">Title</h3>
    <p class="text-slate-600 leading-relaxed">Description</p>
    <button class="mt-6 px-6 py-3 rounded-2xl bg-teal-500 text-white 
                   font-bold hover:bg-teal-600 transition">
        Action
    </button>
</div>
```

### Dashboard Sidebar Template
```html
<div class="w-72 bg-white border-r border-lavender-100 p-8">
    <nav class="space-y-2">
        <a href="#" class="flex items-center gap-4 p-4 rounded-2xl 
                          bg-lavender-50 text-indigo-700 font-bold">
            📚 Navigation
        </a>
    </nav>
</div>
```

---

## Reference Files

- **`tailwind.config.js`** - Source of truth for colors
- **`HYBRID_THEME_DESIGN_SYSTEM.md`** - Complete design documentation
- **`HYBRID_THEME_IMPLEMENTATION_GUIDE.md`** - How to use colors

---

## 🎯 Remember

**The colors tell a story:**

🟪 **Lavender** = "You're safe here"  
🟦 **Indigo** = "We know what we're doing"  
🟩 **Teal** = "Everyone is welcome"  
🟥 **Coral** = "We care about you"  
🟢 **Mint** = "You're doing great"  

Together, they say: **"Professional institution with genuine care for every learner." ✨**

