# JESS Tech Design System - Quick Reference Card

## 🎯 One-Page Cheat Sheet

### Color Palette
```
Primary:    #0ea5e9 (sky-500) - main actions
Dark:       #0284c7 (sky-600) - hover state
Light:      #e0f2fe (sky-100) - backgrounds

Success:    #10b981 (emerald)
Warning:    #f59e0b (amber)
Danger:     #ef4444 (red)

Text Dark:  #0f172a (slate-900)
Text Light: #6b7280 (slate-500)
Border:     #e5e7eb (slate-200)
```

### Spacing Scale
```
xs = 0.375rem (3px)
sm = 0.5rem (4px)
md = 1rem (8px)
lg = 1.5rem (12px) ← DEFAULT for cards
xl = 2rem (16px) ← section gaps
2xl = 2.5rem (20px)
3xl = 3rem (24px)
```

### Typography
```
h1: 2.25rem bold
h2: 1.875rem bold
h3: 1.5rem semibold
h4: 1.25rem semibold
body: 1rem regular
small: 0.875rem regular
```

### Components Quick Use

#### Buttons
```html
<!-- Primary (blue, shadow) -->
<x-button variant="primary">Save</x-button>

<!-- Secondary (gray) -->
<x-button variant="secondary">Copy</x-button>

<!-- Outline (border) -->
<x-button variant="outline">Cancel</x-button>

<!-- Danger (red) -->
<x-button variant="danger">Delete</x-button>

<!-- Sizes -->
<x-button size="sm">Small</x-button>
<x-button size="lg">Large</x-button>
<x-button size="full">Full Width</x-button>
```

#### Forms
```html
<x-form.input name="email" label="Email" type="email" required />
<x-form.textarea name="desc" label="Description" rows="4" />
<x-form.select name="dept" label="Department" :options="$depts" />
<x-form.checkbox name="agree" label="I agree" />
<x-form.radio name="status" label="Active" value="active" />
```

#### Cards
```html
<x-card>
    <div class="card-header">
        <h3>Title</h3>
    </div>
    <div class="card-body">
        Content (auto 1.5rem padding)
    </div>
    <div class="card-footer">
        Footer
    </div>
</x-card>
```

#### Tables
```html
<x-table.table striped>
    <x-table.thead>
        <x-table.th>Header 1</x-table.th>
    </x-table.thead>
    <x-table.tbody>
        <tr>
            <x-table.td>Data</x-table.td>
        </tr>
    </x-table.tbody>
</x-table.table>
```

#### Alerts & Badges
```html
<x-alert type="success" dismissible>Success!</x-alert>
<x-alert type="danger">Error!</x-alert>
<x-badge variant="primary">Label</x-badge>
<x-badge variant="success">Approved</x-badge>
```

#### Navigation
```html
<x-breadcrumb :items="[
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'Employees', 'href' => '/employees'],
    ['label' => 'John Doe']
]" />

<x-status-indicator status="active" label="Active" />
<x-pagination :current="1" :total="10" baseUrl="/employees" />
```

### Common Patterns

#### Page Layout
```html
<x-layouts.app>
    <x-breadcrumb :items="$breadcrumbs" />
    <h1>Page Title</h1>
    
    <x-alert type="success" dismissible>
        @if(session('success'))
            {{ session('success') }}
        @endif
    </x-alert>
    
    <x-card>
        <div class="card-body">
            Content here
        </div>
    </x-card>
</x-layouts.app>
```

#### Grid Layout
```html
<!-- 3 columns desktop, 1 mobile -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-card>Card 1</x-card>
    <x-card>Card 2</x-card>
    <x-card>Card 3</x-card>
</div>
```

#### Flex Layout
```html
<!-- Horizontal buttons -->
<div class="flex gap-3">
    <x-button variant="primary">Save</x-button>
    <x-button variant="outline">Cancel</x-button>
</div>

<!-- Between space -->
<div class="flex justify-between">
    <h3>Title</h3>
    <x-button variant="primary">Action</x-button>
</div>
```

#### Form Section
```html
<div class="space-y-4">
    <x-form.input name="field1" label="Field 1" />
    <x-form.input name="field2" label="Field 2" />
    <x-form.select name="dept" label="Department" :options="$depts" />
</div>
```

### Spacing Examples
```html
<!-- Section spacing -->
<div class="mb-8">Section 1</div>
<div class="mb-8">Section 2</div>

<!-- Form field spacing -->
<x-form.input />
<x-form.input class="mt-4" />

<!-- Grid spacing -->
<div class="gap-6">...</div>

<!-- Card body (already has lg padding) -->
<div class="card-body">Content auto 1.5rem</div>
```

### DO's ✅
- Use component system
- Follow spacing scale
- Use defined colors
- Test on mobile
- Show validation errors
- Use semantic HTML

### DON'Ts ❌
- Don't use emojis
- Don't create custom colors
- Don't use inline styles
- Don't skip mobile testing
- Don't mix component styles
- Don't ignore validation

### Responsive Classes
```
md:  (768px and up)  → tablet
lg:  (1024px and up) → desktop

Example:
<div class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
```

### Hover/Active States
```html
<!-- Automatic with components -->
<x-button>Button</x-button>        <!-- Hover: darker, lifted -->
<x-card hover>Content</x-card>     <!-- Hover: shadow increase -->
<a href="...">Link</a>             <!-- Hover: primary color -->
```

### Form Validation
```html
<!-- Auto error display -->
<x-form.input 
    name="email"
    label="Email"
    error="Email is required"
/>

<!-- Auto old value population -->
<x-form.input 
    name="email"
    value="{{ old('email') }}"
/>

<!-- Auto Laravel validation -->
@if($errors->has('email'))
    Error: {{ $errors->first('email') }}
@endif
```

### Modal Usage
```html
<x-modal title="Confirm Delete" maxWidth="md">
    <p>Are you sure?</p>
    
    <div class="modal-footer">
        <x-button variant="outline" @click="open = false">Cancel</x-button>
        <x-button variant="danger">Delete</x-button>
    </div>
</x-modal>
```

---

## 📁 File Locations

| File | Purpose |
|------|---------|
| `tailwind.config.js` | Colors, spacing, typography config |
| `resources/css/app.css` | Component styles, utilities |
| `resources/views/components/` | All Blade components |
| `resources/views/layouts/app.blade.php` | Main layout wrapper |
| `DESIGN_SYSTEM.md` | Complete documentation |
| `IMPLEMENTATION_GUIDE.md` | Integration steps |

---

## 🚀 Getting Started

### 1. Create a Page
```blade
<x-layouts.app>
    <h1>My Page</h1>
    <!-- Add content here -->
</x-layouts.app>
```

### 2. Add Cards
```blade
<x-card>
    <div class="card-body">
        Content
    </div>
</x-card>
```

### 3. Add Forms
```blade
<x-form.input name="email" label="Email" required />
<x-button type="submit">Submit</x-button>
```

### 4. Add Tables
```blade
<x-table.table striped>
    <!-- table content -->
</x-table.table>
```

---

## ⚡ Pro Tips

1. **Card Padding**: Always use `.card-body` for automatic 1.5rem padding
2. **Spacing**: Use `gap-6` for grids, `mb-6` for sections
3. **Colors**: Reference `tailwind.config.js` for hex codes
4. **Responsive**: Test at 375px (mobile), 768px (tablet), 1024px (desktop)
5. **Icons**: Use Heroicons with `stroke-current` and sizing classes
6. **Validation**: Form components auto-show errors from Laravel
7. **Links**: Use `href` in `x-button` to make it a link
8. **Groups**: Wrap related inputs in `<div class="space-y-4">`

---

**Keep it simple. Keep it consistent. Keep it professional.**

Last Updated: April 30, 2026
