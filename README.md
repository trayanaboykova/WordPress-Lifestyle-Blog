# WordPress-Lifestyle-Blog
This project was created as part of the [WordPress for Developers Course](https://softuni.bg/trainings/4782/wordpress-for-developers-october-2024#lesson-80300). The goal was to build a WordPress-based website with a custom theme and plugin to demonstrate the practical application of the concepts learned. 

## Project Overview

The **WordPress-Lifestyle-Blog** is a fully functional WordPress-based website tailored to share engaging lifestyle content. This project showcases the practical implementation of WordPress development principles through a custom-built theme and plugin, meeting all course requirements. The website utilizes dynamic WordPress features such as custom post types, custom taxonomies, and AJAX for a seamless user experience. 

### Key Features

1. **Custom Theme**  
   - Built from scratch using the [Spurgeon HTML Template](https://themewagon.com/themes/spurgeon/) under the GPL license.
   - Dynamic implementation of WordPress features like `WP_Query()` and `The_Loop()`.
   - Separate template files for header and footer, supporting dynamic `<title>` and enqueued styles/scripts.
   - Custom page templates for:
     - Homepage, pulling dynamic content (blog posts, pages, custom post types).
     - Single blog post view.
     - Single custom post type view.
     - Listing all posts from a custom post type.
   - Dedicated archive templates for date-based and author-based blog post archives.
   - Registered WordPress menu and sidebar with widget support.

2. **Custom Plugin**  
   - Custom post type registered for additional content flexibility.
   - Custom taxonomy linked to the custom post type for enhanced categorization.
   - Metabox built using native WordPress functions with custom post-meta options.
   - Advanced metabox/dashboard field implemented with ACF.
   - Options page with a custom toggle feature for displaying or hiding elements.
   - AJAX functionality for dynamic filtering and sorting of content.
   - Modularized functions for clean and reusable code.
   - Shortcode functionality to display custom post type data with attributes.
   - Filters to manipulate native WordPress elements like post titles or content.

3. **Coding Standards and Debugging**  
   - Debugging methodology applied: no PHP warnings or errors from custom code.
   - Code adheres to WordPress Coding Standards, ensuring secure and maintainable development.

4. **Version Control**  
   - `.gitignore` file configured to exclude sensitive data like database credentials and WordPress Core files.
   - Well-documented Git repository with commits reflecting the development phases.
---

## References

- Here you can check out the HTML template that I used for my project: [HTML Template](https://themewagon.com/themes/spurgeon/)
- Here you can see the live demo of the template: [Live Demo](https://themewagon.github.io/spurgeon/)
