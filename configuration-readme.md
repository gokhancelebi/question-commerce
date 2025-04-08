# Migrating from Tailwind CDN to Laravel Vite Setup

This guide outlines the steps to migrate from a CDN-based Tailwind CSS setup to a proper Laravel Vite integration.

## Common Issues We Encountered

1. **CDN to Vite Migration Issues**
   - Using CDN (`<script src="https://cdn.tailwindcss.com/3.4.16"></script>`) alongside Vite causes conflicts
   - Inline Tailwind configuration in blade files doesn't work with Vite
   - `@tailwind` directives not being recognized in `app.css`

2. **Configuration File Issues**
   - Missing required configuration files
   - Incorrect module exports syntax
   - Incomplete content paths in Tailwind config

## Step-by-Step Migration Guide

### 1. Remove CDN and Inline Configuration
Remove these from your blade layout file:
```html
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>
    tailwind.config = {
        // your inline config
    }
</script>
```

### 2. Set Up Required Files

#### a. Create postcss.config.js
```javascript
export default {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
```

#### b. Update tailwind.config.js
```javascript
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            // Your theme extensions
            colors: {
                primary: '#E37D10',
                // other colors...
            },
            borderRadius: {
                'none': '0px',
                'sm': '4px',
                DEFAULT: '8px',
                // other border radius values...
            },
            // other theme extensions...
        },
    },
    plugins: [],
}
```

#### c. Update vite.config.js
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

### 3. Update resources/css/app.css
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    /* Base styles */
}

@layer components {
    /* Component styles */
}

@layer utilities {
    /* Utility styles */
}

/* Custom styles outside of Tailwind */
```

### 4. Update Layout File
Replace CDN scripts with Vite directive in your blade layout:
```html
<head>
    <!-- ... other head elements ... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
```

### 5. Install Dependencies
```bash
npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
```

### 6. Build Assets
```bash
npm run build
```

For development:
```bash
npm run dev
```

## Common Gotchas and Solutions

1. **Border Radius Not Working**
   - Ensure border radius configuration is in `tailwind.config.js`
   - Make sure you're using the correct class names (`rounded-button`, `rounded-lg`, etc.)
   - Check for any CSS that might be overriding the border radius

2. **Styles Not Updating**
   - Clear your browser cache
   - Rebuild assets with `npm run build`
   - In development, ensure `npm run dev` is running

3. **@tailwind Directives Not Working**
   - Verify PostCSS configuration is correct
   - Ensure Vite is properly configured
   - Check that all dependencies are installed

4. **Module Export Syntax**
   - Use `export default` instead of `module.exports` when using Vite
   - This applies to both `tailwind.config.js` and `postcss.config.js`

## Best Practices

1. **Organization**
   - Use `@layer` directives in `app.css` to organize styles
   - Keep custom styles separate from Tailwind utilities
   - Use theme extension in `tailwind.config.js` for custom values

2. **Performance**
   - Specify content paths accurately to avoid bloated CSS
   - Use JIT (Just-In-Time) mode (enabled by default in Tailwind CSS v3+)

3. **Development**
   - Use `npm run dev` during development for hot reloading
   - Check browser console for any CSS compilation errors
   - Use browser dev tools to inspect applied styles

## Troubleshooting

If styles are not applying:
1. Check browser console for errors
2. Verify all configuration files are in the correct locations
3. Ensure all dependencies are installed correctly
4. Clear browser cache and rebuild assets
5. Check if classes are being purged by checking the built CSS file

Remember to run `npm run build` after making changes to configuration files. 
