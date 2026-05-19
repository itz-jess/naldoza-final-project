# JESS Tech Design System Documentation

**A professional, modern SaaS-style Employee Management System design system**

---

## 📋 Table of Contents

1. [Design Principles](#design-principles)
2. [Color Palette](#color-palette)
3. [Typography](#typography)
4. [Spacing System](#spacing-system)
5. [Components](#components)
6. [Usage Guidelines](#usage-guidelines)
7. [Do's and Don'ts](#dos-and-donts)

---

## 🎨 Design Principles

### Core Values
- **Clean & Minimal**: No decorative elements, every pixel serves a purpose
- **Professional**: Suitable for enterprise/B2B environments
- **Consistent**: Same patterns across all pages and features
- **Accessible**: High contrast, readable fonts, intuitive interactions
- **Responsive**: Mobile-first approach that works on all devices
- **Modern**: Contemporary SaaS aesthetic (Stripe, Linear, Notion inspired)

### Visual Language
- **No Emojis**: Professional icons only (Heroicons, Lucide, SVG)
- **Subtle Animations**: Smooth transitions (150-300ms) for interactions
- **Soft Shadows**: Minimal depth, not heavy gradients
- **Clean Lines**: Rounded corners (md/lg/xl), no sharp angles
- **White Space**: Strategic breathing room for clarity
- **Grid-Based**: Aligned layouts using spacing scale

---

## 🎨 Color Palette

### Primary Color: Professional Blue
```
primary-50:  #f0f9ff   (backgrounds, accents)
primary-100: #e0f2fe
primary-200: #bae6fd
primary-300: #7dd3fc
primary-400: #38bdf8
primary-500: #0ea5e9   (primary action)
primary-600: #0284c7   (primary button, hover)
primary-700: #0369a1   (active state)
primary-800: #075985
primary-900: #0c4a6e
primary-950: #082f49   (very dark, minimal use)
```

**Usage:**
- Primary buttons and CTAs
- Active states and highlights
- Links and key information
- Focus states

### Neutral: Slate Grays
```
slate-50:   #f8fafc   (backgrounds, light areas)
slate-100:  #f1f5f9   (secondary backgrounds)
slate-200:  #e2e8f0   (borders)
slate-300:  #cbd5e1   (form fields, subtle elements)
slate-400:  #94a3b8   (icons, help text)
slate-500:  #64748b   (muted text)
slate-600:  #475569   (secondary text)
slate-700:  #334155   (body text)
slate-800:  #1e293b   (headings)
slate-900:  #0f172a   (very dark text, headings)
slate-950:  #020617   (almost black, rare use)
```

**Usage:**
- All text content
- Backgrounds and sections
- Borders and dividers
- Neutral UI elements

### Semantic Colors
```
success: #10b981  (positive actions, confirmations)
warning: #f59e0b  (warnings, cautions)
danger:  #ef4444  (destructive actions, errors)
info:    #3b82f6  (informational messages)
```

**Usage:**
- Status messages
- Validation feedback
- Alerts and notifications
- Contextual states

### Color Combinations (Don'ts)
❌ Don't use multiple colors together
❌ Don't use gradients (unless specifically designed)
❌ Don't override colors for "personality"
✅ Use the defined palette consistently
✅ Use semantic colors for their intended purpose

---

## 📝 Typography

### Font Family
- **Primary**: Inter (already configured)
- **Fallback**: System sans-serif fonts

### Font Sizes & Usage
```
Text-XS (0.75rem):      Labels, badges, helper text
Text-SM (0.875rem):     Form labels, secondary text
Text-Base (1rem):       Body text, table cells
Text-LG (1.125rem):     Card titles, medium text
Text-XL (1.25rem):      Section titles
Text-2XL (1.5rem):      Page titles
Text-3XL (1.875rem):    Major headings
Text-4XL (2.25rem):     Hero titles
```

### Font Weights
```
300 (Light):     Rarely used, only for emphasis
400 (Regular):   Body text, default
500 (Medium):    Secondary headings, labels
600 (Semibold):  Titles, strong emphasis
700 (Bold):      Headings, important info
```

### Line Heights
```
Headings (h1-h6):     1.25 (tight, compact)
Body text:            1.5  (comfortable reading)
Form inputs:          1.5  (readability)
```

### Typography Examples

**Heading Hierarchy**
```html
<h1>Page Title</h1>           <!-- 2.25rem, bold, slate-900 -->
<h2>Section Title</h2>        <!-- 1.875rem, bold, slate-900 -->
<h3>Subsection Title</h3>     <!-- 1.5rem, semibold, slate-900 -->
<h4>Card Title</h4>           <!-- 1.25rem, semibold, slate-900 -->
<p>Body Text</p>              <!-- 1rem, regular, slate-700 -->
<small>Help Text</small>      <!-- 0.875rem, regular, slate-500 -->
```

---

## 📏 Spacing System

**Consistent spacing scale (based on 0.25rem units)**

```
xs:   0.375rem  (3px)    - minimal spacing
sm:   0.5rem    (4px)    - tight spacing
md:   1rem      (8px)    - default spacing
lg:   1.5rem    (12px)   - comfortable spacing
xl:   2rem      (16px)   - generous spacing
2xl:  2.5rem    (20px)   - large sections
3xl:  3rem      (24px)   - major sections
```

### Padding Guidelines
- **Cards**: 1.5rem (lg) padding on all sides
- **Buttons**: 0.625rem (vertical) x 1rem (horizontal)
- **Form inputs**: 0.625rem (vertical) x 1rem (horizontal)
- **Sections**: 2-3rem top/bottom padding
- **Containers**: 1.5rem (lg) horizontal padding

### Margin Guidelines
- **Bottom margins** between sections: 1.5rem-2rem (lg-xl)
- **Between form groups**: 1.5rem (lg)
- **Between list items**: 0.5rem (sm)
- **Page top/bottom**: 2rem (xl)

### Gap Guidelines
- **Between cards/items**: 1.5rem-2rem (lg-xl)
- **Between columns**: 1.5rem (lg)
- **Flex items**: 0.5rem-1rem (sm-md)

---

## 🧩 Components

### Buttons

**Variants:**
```
primary   - Main action (blue background)
secondary - Secondary action (gray background)
outline   - Non-primary action (bordered)
danger    - Destructive action (red background)
success   - Positive action (green background)
warning   - Warning action (yellow background)
ghost     - Minimal action (text only)
```

**Sizes:**
```
sm  - Small buttons (compact, toolbar)
md  - Default size (most common)
lg  - Large buttons (prominent actions)
full - Full width buttons
```

**Usage Example:**
```html
<!-- Primary Button -->
<x-button variant="primary">Save Changes</x-button>

<!-- Outline Button -->
<x-button variant="outline">Cancel</x-button>

<!-- Danger Button -->
<x-button variant="danger" size="sm">Delete</x-button>

<!-- Link Button -->
<x-button variant="ghost" href="/dashboard">Go to Dashboard</x-button>
```

### Cards

Used for grouping related content.

**Structure:**
```html
<x-card>
    <div class="card-body">
        Content here
    </div>
</x-card>

<!-- With header and footer -->
<x-card>
    <div class="card-header">
        <h3>Card Title</h3>
    </div>
    <div class="card-body">
        Content here
    </div>
    <div class="card-footer">
        Footer content
    </div>
</x-card>
```

**Properties:**
```
hover  - Add hover shadow effect
```

### Forms

**Form Groups (label + input + help text + error)**

```html
<x-form.input
    label="Email Address"
    name="email"
    type="email"
    placeholder="you@example.com"
    help="We'll never share your email"
    required
/>

<x-form.textarea
    label="Description"
    name="description"
    rows="4"
    placeholder="Enter description..."
/>

<x-form.select
    label="Department"
    name="department"
    :options="['hr' => 'Human Resources', 'it' => 'Information Technology']"
    placeholder="Select department"
/>

<x-form.checkbox
    label="I agree to terms"
    name="agree"
/>

<x-form.radio
    label="Active"
    name="status"
    value="active"
/>
```

**Error States:**
- Automatically shows validation errors from Laravel
- Border color changes to danger
- Error message appears below input
- Helper text is replaced with error

### Tables

Used for displaying data (employee records, attendance, etc.).

```html
<x-table.table striped>
    <x-table.thead>
        <x-table.th>Employee Name</x-table.th>
        <x-table.th>Department</x-table.th>
        <x-table.th>Status</x-table.th>
        <x-table.th>Actions</x-table.th>
    </x-table.thead>
    <x-table.tbody>
        @foreach($employees as $employee)
            <tr>
                <x-table.td>{{ $employee->name }}</x-table.td>
                <x-table.td>{{ $employee->department }}</x-table.td>
                <x-table.td>
                    <x-status-indicator status="active" label="Active" />
                </x-table.td>
                <x-table.td>
                    <x-button variant="ghost" size="sm">Edit</x-button>
                </x-table.td>
            </tr>
        @endforeach
    </x-table.tbody>
</x-table.table>
```

### Badges

Small labels for status, categories, etc.

```html
<x-badge variant="primary">New</x-badge>
<x-badge variant="success">Approved</x-badge>
<x-badge variant="danger">Rejected</x-badge>
<x-badge variant="warning">Pending</x-badge>
<x-badge variant="slate">Default</x-badge>
```

### Alerts

Feedback messages (success, error, warning, info).

```html
<!-- Success Alert -->
<x-alert type="success" dismissible>
    Employee record saved successfully!
</x-alert>

<!-- Danger Alert -->
<x-alert type="danger">
    Please fix the errors below.
</x-alert>

<!-- Warning Alert -->
<x-alert type="warning" dismissible>
    This action cannot be undone.
</x-alert>

<!-- Info Alert -->
<x-alert type="info">
    The system will be down for maintenance on Sunday.
</x-alert>
```

### Modals

Dialog for important actions or forms.

```html
<x-modal title="Delete Employee" maxWidth="md">
    <p>Are you sure you want to delete this employee? This action cannot be undone.</p>
    
    <div class="modal-footer">
        <x-button variant="outline" @click="open = false">Cancel</x-button>
        <x-button variant="danger">Delete</x-button>
    </div>
</x-modal>
```

### Status Indicator

Show current status with visual indicator.

```html
<!-- Active -->
<x-status-indicator status="active" label="Active" />

<!-- Inactive -->
<x-status-indicator status="inactive" label="Inactive" />

<!-- Pending -->
<x-status-indicator status="pending" label="Processing" />
```

### Breadcrumbs

Navigation trail for page location.

```html
<x-breadcrumb :items="[
    ['label' => 'Dashboard', 'href' => '/dashboard'],
    ['label' => 'Employees', 'href' => '/employees'],
    ['label' => 'John Doe'],
]" />
```

### Pagination

Navigate through paginated data.

```html
<x-pagination 
    :current="$current" 
    :total="$total" 
    baseUrl="/employees"
/>
```

---

## 🎯 Usage Guidelines

### Layout Structure

**Every page should follow:**
```html
<x-layouts.app>
    <!-- Page Header with Breadcrumb -->
    <div class="mb-6">
        <x-breadcrumb :items="$breadcrumbs" />
        <h1 class="mt-4">Page Title</h1>
    </div>

    <!-- Alerts/Messages -->
    @if(session('success'))
        <x-alert type="success" dismissible>
            {{ session('success') }}
        </x-alert>
    @endif

    <!-- Page Content -->
    <div class="grid-responsive">
        <!-- Cards, forms, tables, etc. -->
    </div>

    <!-- Footer/Actions -->
</x-layouts.app>
```

### Button Placement

```
Primary Actions:     Right/end of page
Secondary Actions:   Left/start, or inline
Destructive Actions: Danger variant, right-aligned
```

### Form Layout

```
Single Column (default):
- Each form group takes full width
- Labels above inputs (vertical)
- Error messages below inputs

Multi-Column (grid):
- Max 2 columns on desktop
- Stack to 1 column on mobile
- Related fields grouped
```

### Table Guidelines

```
Columns:      3-7 columns max (scroll on mobile)
Cell Height:  40-50px (enough for readability)
Alternating:  Use striped variant for long tables
Actions:      Right-aligned, 2-3 buttons max
Pagination:   Below table if needed
```

### Card Layouts

```
Single Card:   Max 600px width, centered
Multiple:      Use grid-responsive (3 columns desktop, 1 mobile)
Sidebar:       Card width 300-350px, content area flexible
Dashboard:     4-6 stat cards in grid, 2-3 per row
```

---

## ✅ Do's and Don'ts

### ✅ DO's

✅ Use the defined color palette
✅ Keep layouts aligned to grid/spacing system
✅ Use Heroicons for all icons
✅ Apply consistent padding (1.5rem in cards)
✅ Use proper semantic HTML
✅ Show loading states during actions
✅ Provide clear feedback (success, error messages)
✅ Make buttons easily clickable (min 44x44px)
✅ Use focus states for keyboard navigation
✅ Test responsiveness on mobile/tablet

### ❌ DON'Ts

❌ Don't use emojis anywhere
❌ Don't create custom colors outside palette
❌ Don't use gradients (unless explicitly designed)
❌ Don't mix button styles on same page
❌ Don't use heavy shadows (stick to defined shadows)
❌ Don't overcrowd pages with content
❌ Don't use more than 2 accent colors
❌ Don't create custom form inputs
❌ Don't disable buttons without clear reason
❌ Don't hide important information behind modals

### Spacing Mistakes (❌ Common Errors)

❌ Inconsistent padding (card-body should always be 1.5rem)
❌ Too much whitespace (hard to scan)
❌ Too little whitespace (cluttered)
❌ Random margins on elements
❌ Nested spacing that compounds
❌ Different spacing on similar elements

### Icon Usage (✅ Correct)

✅ Use Heroicons (outline style)
✅ Size 20-24px for most uses
✅ Color with `stroke-current` and text-* classes
✅ Stroke width: 1.5-2
✅ Pair with descriptive text labels

---

## 📦 Component Quick Reference

| Component | Usage | Example |
|-----------|-------|---------|
| Button | Actions | `<x-button variant="primary">Save</x-button>` |
| Card | Content groups | `<x-card><div class="card-body">...</div></x-card>` |
| Input | Text entry | `<x-form.input name="email" label="Email" />` |
| Select | Choose options | `<x-form.select name="dept" :options="$depts" />` |
| Checkbox | Yes/No | `<x-form.checkbox name="agree" label="I agree" />` |
| Table | Data display | `<x-table.table>...</x-table.table>` |
| Modal | Dialogs | `<x-modal title="Confirm">...</x-modal>` |
| Alert | Messages | `<x-alert type="success">Done!</x-alert>` |
| Badge | Labels | `<x-badge variant="primary">New</x-badge>` |
| Status | Indicators | `<x-status-indicator status="active" />` |

---

## 🔧 Configuration Files

### Tailwind Config
Location: `tailwind.config.js`
- Color palette extended
- Spacing scale added
- Font sizes configured
- Border radius defaults
- Box shadows defined

### CSS Components
Location: `resources/css/app.css`
- Component utility classes
- Base styles
- Responsive utilities
- Animation classes

---

## 📱 Responsive Design

**Breakpoints:**
```
Mobile:  < 768px (base styles)
Tablet:  768px - 1024px
Desktop: > 1024px
```

**Classes to use:**
```
md:  (768px and up)
lg:  (1024px and up)

Example: <div class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
```

**Mobile First Approach:**
- Start with mobile/compact styles
- Add larger layouts with md:/lg: prefixes
- Always test on actual devices

---

## 🎬 Transitions & Animations

**Timing:**
```
fast:    150ms  (quick feedback)
normal:  200ms  (default)
slow:    300ms  (noticeable change)
```

**Easing:**
```
cubic-bezier(0.4, 0, 0.2, 1)  (smooth)
```

**Where to use:**
- Hover states on buttons/links
- Modal open/close
- Card hover effects
- Form focus states
- Dropdown animations

---

## 📄 Code Examples

### Employee Table with Actions
```html
<x-card>
    <div class="card-header">
        <h3>Employees</h3>
    </div>
    <x-table.table striped>
        <x-table.thead>
            <x-table.th>Name</x-table.th>
            <x-table.th>Email</x-table.th>
            <x-table.th>Department</x-table.th>
            <x-table.th>Status</x-table.th>
            <x-table.th>Actions</x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach($employees as $emp)
                <tr>
                    <x-table.td>{{ $emp->name }}</x-table.td>
                    <x-table.td>{{ $emp->email }}</x-table.td>
                    <x-table.td>{{ $emp->department }}</x-table.td>
                    <x-table.td>
                        <x-status-indicator status="active" />
                    </x-table.td>
                    <x-table.td>
                        <x-button variant="ghost" size="sm">Edit</x-button>
                    </x-table.td>
                </tr>
            @endforeach
        </x-table.tbody>
    </x-table.table>
</x-card>
```

### Employee Form
```html
<x-card>
    <div class="card-header">
        <h3>Add New Employee</h3>
    </div>
    <form method="POST" action="/employees" class="card-body space-y-6">
        @csrf
        
        <x-form.input
            label="Full Name"
            name="name"
            required
        />

        <x-form.input
            label="Email Address"
            name="email"
            type="email"
            required
        />

        <x-form.select
            label="Department"
            name="department"
            :options="['hr' => 'HR', 'it' => 'IT', 'ops' => 'Operations']"
            required
        />

        <x-form.checkbox
            label="Active Employee"
            name="active"
        />

        <div class="flex gap-2">
            <x-button type="submit" variant="primary">Save Employee</x-button>
            <x-button variant="outline" href="/employees">Cancel</x-button>
        </div>
    </form>
</x-card>
```

---

## 🚀 Implementation Checklist

- [ ] Updated Tailwind config with color palette
- [ ] Created CSS component classes in app.css
- [ ] Created all Blade components
- [ ] Updated layouts (app.blade.php, navigation)
- [ ] Created example pages (dashboard, employee list, forms)
- [ ] Applied design system to welcome page
- [ ] Tested responsive design on mobile/tablet/desktop
- [ ] Validated all color combinations
- [ ] Tested accessibility (keyboard nav, color contrast)
- [ ] Documented all component usage
- [ ] Created style guide/brand guide

---

**Version**: 1.0
**Last Updated**: April 30, 2026
**Project**: JESS Tech Employee Management System
**Status**: Ready for Implementation
