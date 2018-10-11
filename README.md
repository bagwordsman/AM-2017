# AM-2017
## Custom WordPress Theme
 - A custom WordPress Theme based on skeleton css, which uses Advanced Custom Fields
 - Theme Settings include company details, affiliate logos, custom widgets
 - Not designed to use Gutenberg (pre-conception), but may integrate in the future

### Maintainance Notes:
 - Plugins are included in the repo as updates can make things break
 - If updating Advanced Custom Fields, expect to update `scss/admin/_in-page.scss`, `scss/admin/_admin-base.scss`, and  
  `js/admin/admin-pages.js` while matching IDs to checkbox groups, as these change colours and helper content  
 on the admin side
 - Server side caching and gzip compression is delivered through `.htaccess` file. This is excluded from the repo
