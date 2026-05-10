# Hybrid Theme - Visual Reference Guide

## 🎨 Color Palette Quick Reference

```
PRIMARY COLORS:
├─ Indigo (#312E81)      → Headings, secondary buttons, trust/authority
├─ Teal (#14B8A6)        → Primary buttons, highlights, interactive elements
├─ Lavender (#F3EEFF)    → Backgrounds, subtle accents, soft touch
└─ Coral (#F97316)       → Alerts, security actions, attention

SECONDARY COLORS:
├─ Mint (#10B981)        → Success states, positive feedback
├─ Peach (#FB923C)       → Warm accents, notifications
└─ Off-White (#FCFCFD)   → Neutral backgrounds
```

---

## 🔘 Button Styles

### Primary Button (Teal) - Main CTA
```blade
<button class="px-8 py-4 rounded-2xl bg-teal-500 text-white font-black 
               shadow-lg shadow-teal-300/30 hover:bg-teal-600 
               hover:shadow-lg transition-all transform hover:-translate-y-1">
    Create Account
</button>
```
**Usage**: Registration, Login, Send Actions

### Secondary Button (Indigo) - Confirmation
```blade
<button class="px-8 py-4 rounded-2xl bg-indigo-700 text-white font-black 
               shadow-lg shadow-indigo-300/30 hover:bg-indigo-800 
               hover:shadow-lg transition-all transform hover:-translate-y-1">
    Confirm
</button>
```
**Usage**: Password Reset, Confirm Actions

### Tertiary Button (Slate Border)
```blade
<button class="py-3 px-4 rounded-2xl border-2 border-slate-300 
               text-slate-700 font-bold hover:bg-slate-50 transition-colors">
    Sign Out
</button>
```
**Usage**: Secondary/Logout Actions

---

## 📝 Form Input Styles

### Standard Text Input
```blade
<input type="email" 
       class="block w-full rounded-2xl border-2 border-lavender-100 
              focus:border-teal-500 focus:ring-teal-500 
              px-4 py-2 transition-all bg-white text-slate-900"
       placeholder="you@example.com">
```

### Disabled Input (Read-Only)
```blade
<input type="email" 
       class="block w-full rounded-2xl border-2 border-lavender-100 
              bg-slate-50 text-slate-700 cursor-not-allowed"
       disabled>
```

### Select Dropdown
```blade
<select class="block w-full border-2 border-lavender-100 rounded-2xl 
              focus:border-teal-500 focus:ring-teal-500 
              px-4 py-2 transition-all bg-white text-slate-900">
    <option>-- Select --</option>
</select>
```

### Checkbox
```blade
<input type="checkbox" class="rounded border-2 border-lavender-100 accent-teal-500">
```

---

## 📦 Info Box Styles

### Teal Info Box (General Information)
```blade
<div class="bg-teal-50 border-2 border-teal-200 rounded-2xl p-4">
    <p class="text-sm text-slate-700 leading-relaxed">
        Your message here
    </p>
</div>
```

### Lavender Info Box (Default)
```blade
<div class="bg-lavender-50 border-2 border-lavender-200 rounded-2xl p-4">
    <p class="text-sm text-slate-700 leading-relaxed">
        Your message here
    </p>
</div>
```

### Mint Info Box (Success)
```blade
<div class="bg-mint-50 border-2 border-mint-200 rounded-2xl p-4">
    <p class="text-sm font-bold text-mint-700">
        ✓ Your success message
    </p>
</div>
```

### Coral Info Box (Security)
```blade
<div class="bg-coral-50 border-2 border-coral-200 rounded-2xl p-4">
    <p class="text-sm text-slate-700 leading-relaxed">
        Your security message
    </p>
</div>
```

---

## 📄 Page Layout Structure

### Authentication Page (Standard)
```
┌─────────────────────────────┐
│    Logo + Branding          │  (Top center, 72px)
├─────────────────────────────┤
│                             │
│  Page Title (Indigo)        │  Large, bold heading
│  Subtitle (Slate)           │  Smaller, descriptive
│                             │
├─────────────────────────────┤
│  Form Container             │  
│  ├─ Input Fields (Lavender) │  2px borders, rounded-2xl
│  ├─ Labels (Indigo)         │  Font-bold
│  └─ Error Messages          │  Red/pink color
│                             │
├─────────────────────────────┤
│  Primary Button (Teal)      │  Full width, lifted on hover
│                             │
├─────────────────────────────┤
│  Link to Other Page         │  Teal text, bold
│                             │
└─────────────────────────────┘
  Copyright (Slate 500)
```

---

## 🎯 Typography System

### Heading Sizes & Weights
```
h2.text-4xl.font-black.text-indigo-700    = 36px, black, indigo (Main title)
h3.text-lg.font-black.text-indigo-700      = 18px, black, indigo (Section)
.font-bold.text-indigo-700                 = medium, bold, indigo (Label)
.text-sm.text-slate-600                    = 14px, regular, slate (Body)
.text-xs.text-slate-500                    = 12px, regular, slate (Helper)
```

### Font Families
- **Headings**: Poppins, 800 weight
- **Body**: Inter, 400-700 weight

---

## ✨ Interactive Effects

### Hover States on Buttons
```
Base:         bg-teal-500 shadow-lg shadow-teal-300/30
Hover:        bg-teal-600 shadow-lg transform -translate-y-1
Transition:   transition-all (200ms default)
```

### Focus States on Inputs
```
Base:   border-lavender-100
Focus:  border-teal-500 ring-teal-500
Ring:   focus:ring-teal-500 (visible focus outline)
```

### Label Hover
```
Base:       text-slate-600
Hover:      text-slate-900
Transition: transition-colors
```

---

## 🌐 Background & Atmosphere

### Page Background
- **Color**: Gradient from slate-50 to lavender
- **Decoration**: 3 animated blobs (lavender, indigo, teal)
- **Animation**: float 20s infinite alternate (subtle movement)

### Card Background
- **Color**: White (#FFFFFF)
- **Border**: 2px solid lavender-100
- **Radius**: 24px (rounded-2xl)
- **Shadow**: shadow-lg shadow-indigo-300/40 (warm, soft shadow)

---

## 📐 Spacing System

```
Form Fields Spacing:  space-y-6 (24px between fields)
Input Padding:        px-4 py-2 (16px x 8px)
Button Padding:       px-8 py-4 (32px x 16px)
Container Padding:    p-10 or p-12 (40px or 48px)
Border Radius:        rounded-2xl (24px)
Border Width:         border-2 (8px)
```

---

## 🎭 Role-Based UI Elements

### For Students
- ♿ Accessibility profile section
- Disability type dropdown
- Support devices textarea
- Severity level selection
- **Primary Color**: Teal

### For Educators
- 🎓 Teaching specializations
- Experience years input
- Specialization checkboxes
- **Primary Color**: Indigo

### For Staff
- Regular registration
- **Primary Color**: Indigo

### For Guests
- 👨‍🏫 Invitation notice
- Expired notice with ⏰ emoji
- **Primary Color**: Teal

---

## 🔍 Accessibility Checklist

✅ WCAG AA Color Contrast Compliance
✅ Large Touch Targets (44x44px minimum)
✅ Clear Focus Indicators
✅ Semantic HTML Structure
✅ Descriptive Label Text
✅ Error Message Clarity
✅ Keyboard Navigation Support
✅ Meaningful Emoji Usage
✅ High Contrast Borders
✅ Readable Font Sizes (16px minimum)

---

## 🚀 Implementation Quick Start

### Copy-Paste Button
```blade
<button class="px-8 py-4 rounded-2xl bg-teal-500 text-white font-black 
               shadow-lg shadow-teal-300/30 hover:bg-teal-600 
               hover:shadow-lg transition-all transform hover:-translate-y-1">
    Your Button Text
</button>
```

### Copy-Paste Input
```blade
<input type="text" 
       class="block w-full rounded-2xl border-2 border-lavender-100 
              focus:border-teal-500 focus:ring-teal-500 
              px-4 py-2 transition-all bg-white text-slate-900"
       placeholder="Placeholder text">
```

### Copy-Paste Info Box
```blade
<div class="bg-teal-50 border-2 border-teal-200 rounded-2xl p-4">
    <p class="text-sm text-slate-700 leading-relaxed">
        Information text here
    </p>
</div>
```

---

## 📱 Responsive Breakpoints

```
Mobile:     < 640px   (Single column, full-width buttons)
Tablet:     640-1024px (2 column layouts available)
Desktop:    > 1024px  (Multi-column, expanded spacing)
```

All auth pages use `sm:max-w-md` (responsive centering)

---

**Theme Status**: ✅ Production Ready  
**Version**: 1.0 (Hybrid Warm + Professional)  
**Last Updated**: 2024
