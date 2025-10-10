# Bakery Website Debug & Enhancement TODO

## 1. Debug and Fix Core Functionality
- [x] Fix DB schema: Correct FK in bakery_db.sql (products.category_id -> categories.id)
- [ ] Add error handling to DB queries (e.g., in index.php, products.php)
- [x] Fix paths: Update header.php CSS link to "assets/css/style.css"
- [x] Fix index.php slider start src to existing image (e.g., banner.jpg)
- [x] Implement includes/auth_check.php: Create/enforce session checks on protected pages (cart.php, dashboard.php, etc.)
- [ ] Verify cart/checkout flows: Read and fix add_to_cart.php, place_order.php for bugs

## 2. Enhance Authentication
- [x] Update register.php: Use prepared statements, hash passwords, sanitize inputs, default role to 'user'
- [x] Update login.php: Use password_verify for hashed passwords, add login attempts limit
- [x] Add logout.php: Proper session destroy
- [ ] Secure sessions: Regenerate ID on login, add CSRF tokens to forms
- [x] Protect pages: Include auth_check.php in admin/user pages
- [ ] Update users table: Provide SQL to hash existing passwords

## 3. Professional Styling
- [x] Update style.css: Add Google Fonts, enhance theme (warm palette), transitions, responsive grid
- [x] Update index.php: Move inline styles to CSS, improve slider
- [x] Global: Add loading spinner, better alerts, footer enhancements
- [x] Ensure mobile-first responsiveness

## 4. Additional Improvements
- [x] Add search/filter in products.php
- [x] Secure admin dashboard with role check

## 5. Testing
- [x] Start PHP server: php -S localhost:8000
- [x] Test pages: index, login/register, cart, dashboard
- [x] Check for errors, responsiveness, functionality
- [x] Debug iteratively if issues arise
