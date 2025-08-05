# Breakout Grid System

A flexible grid layout system that provides three content width options:

## Content Areas

- **Normal Content**: `max-w-4xl` (896px) - Default content width
- **Wide Content**: `1280px` - Wider content area
- **Full Width**: `100%` - Full browser width breakout

## How to Use

1. **Add a Breakout Grid block** - This creates the grid container
2. **Add regular content** - Paragraphs, headings, etc. will automatically be constrained to the normal content width
3. **Add Breakout Section blocks** - For wide or full-width content areas
   - Choose "Wide" for 1280px width
   - Choose "Full" for 100% width breakout

## CSS Grid Implementation

The system uses CSS Grid with named grid lines:

```css
grid-template-columns:
  [full-start] 1fr
  [wide-start] minmax(0, calc((var(--wide-width) - var(--content-width)) / 2))
  [content-start] min(100% - var(--grid-padding), var(--content-width))
  [content-end] minmax(0, calc((var(--wide-width) - var(--content-width)) / 2))
  [wide-end] 1fr
  [full-end];
```

## Responsive Behavior

- On small screens (< 768px), wide content becomes normal content width
- Grid padding adjusts from 2rem to 1rem on mobile
- Row gaps adjust for better mobile spacing

## Block Structure

```
Breakout Grid
├── Paragraph (normal width)
├── Heading (normal width)  
├── Breakout Section (wide)
│   ├── Image
│   └── Caption
├── Paragraph (normal width)
└── Breakout Section (full)
    └── Gallery
``` 