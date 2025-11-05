# Elementor Custom Table Widget

A comprehensive, responsive table widget for Elementor with extensive styling options and mobile-friendly card layout.

## Features

### Content Management
- **Dynamic Headers**: Add/remove/reorder table headers
- **Flexible Rows**: Easy row management with comma-separated values
- **Pre-loaded Data**: Comes with sample aviation training data matching your screenshots

### Styling Options

#### Table Container
- Width controls (responsive)
- Background colors
- Borders and border radius
- Box shadows
- Padding and margins

#### Header Styling
- Background and text colors
- Typography controls
- Padding and alignment
- Border options

#### Cell Styling
- Normal and hover states
- Typography controls
- Padding and alignment
- Border customization

#### Advanced Features
- **Alternating Rows**: Enable/disable with custom colors
- **Responsive Breakpoint**: Customizable mobile/tablet breakpoint
- **Mobile Card Layout**: Fully styled card view for mobile devices
- **Hover Effects**: Smooth animations and transitions

### Responsive Design
- **Desktop**: Traditional table layout with horizontal scrolling
- **Mobile/Tablet**: Card-based layout matching your screenshot
- **Customizable Breakpoint**: Set when mobile layout activates

### Accessibility
- Full keyboard navigation support
- ARIA labels and roles
- High contrast mode support
- Screen reader friendly

### Additional Features
- Optional table sorting (click headers)
- Fade-in animations
- RTL language support
- Print-friendly styles
- CSV export functionality

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The "Custom Table" widget will appear in Elementor's General category

## Usage

### In Elementor:
1. Drag the "Custom Table" widget to your page
2. Edit content in the **Content** tab:
   - Modify headers
   - Add/edit table rows (comma-separated values)
3. Customize styling in the **Style** tab:
   - Table Container settings
   - Header styling
   - Cell styling
   - Alternating rows
   - Mobile layout options

### Content Format
For table rows, enter data separated by commas:
```
Year 1, 10-12 Months, ERAU Credits CPL ( +PPL+IR ), 200H Flying + 50H Ground
```

### Mobile Layout
The widget automatically switches to a card-based layout on mobile devices, displaying each row as a styled card with label-value pairs.

## Customization

### CSS Classes
- `.custom-table-container`: Main container
- `.custom-table`: Desktop table
- `.table-mobile`: Mobile card container
- `.table-card`: Individual mobile cards

### JavaScript Hooks
The widget includes a `CustomTableWidget` class that can be extended for additional functionality.

## Browser Support
- Chrome (latest)
- Firefox (latest) 
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Changelog

### Version 1.0.0
- Initial release
- Responsive table with card layout
- Extensive styling options
- Accessibility features
- Interactive enhancements# elementor-table-by-uchit
