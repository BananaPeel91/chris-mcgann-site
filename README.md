# Chris McGann - Painter & Decorator Website

A beautiful one-page website for Chris McGann Painter & Decorator, built with Laravel and featuring Instagram integration.

## Features

- 🎨 Modern, responsive one-page design
- 📱 Mobile-friendly with sticky header navigation
- 📸 Instagram gallery via Basic Display API (no image storage)
- 🔄 12-hour caching of Instagram images
- ⚡ Fast loading with lazy-loaded images
- 🖼️ Lightbox for image viewing
- 💾 No database required - uses file cache only

## Requirements

- PHP 8.1+
- Composer
- Instagram Basic Display API credentials

## Installation

1. **Install dependencies:**
   ```bash
   composer install
   ```

2. **Create environment file:**
   ```bash
   copy .env.example .env
   ```

3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

4. **Configure Instagram API credentials in `.env`:**
   ```env
   INSTAGRAM_APP_ID=your_instagram_app_id
   INSTAGRAM_APP_SECRET=your_instagram_app_secret
   ```
   Note: The access token is stored in the database, not in .env.

5. **Run the development server:**
   ```bash
   php artisan serve
   ```

6. **Visit:** http://localhost:8000

## Instagram Setup

### Getting Instagram API Credentials

1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Create a new app with "Consumer" type
3. Add the "Instagram Basic Display" product
4. Configure OAuth redirect URIs
5. Add your Instagram account as a test user
6. Generate an access token

### Getting Your Long-Lived Token

Once you have a short-lived access token, exchange it for a long-lived token:

```bash
php artisan instagram:refresh-token --exchange --token=YOUR_SHORT_LIVED_TOKEN
```

This will automatically save the long-lived token to the database.

### Token Refresh (Every 60 Days)

Long-lived tokens expire after 60 days. To refresh:

```bash
php artisan instagram:refresh-token
```

The new token is automatically saved to the database.

**Tip:** Set a calendar reminder to refresh the token every 50 days.

## Caching

- Instagram images are cached for **12 hours**
- No images are stored locally - only URLs from Instagram
- Cache is file-based (stored in `storage/framework/cache`)

To clear the cache manually:
```bash
php artisan cache:clear
```

## Artisan Commands

```bash
# Refresh existing long-lived token (outputs new token for .env)
php artisan instagram:refresh-token

# Exchange short-lived token for long-lived token
php artisan instagram:refresh-token --exchange --token=YOUR_SHORT_LIVED_TOKEN

# Clear all cache
php artisan cache:clear
```

## Customization

### Contact Information

Edit `resources/views/home.blade.php`:
- Phone number (search for `tel:`)
- Email address (search for `mailto:`)
- Instagram profile link

### Colors & Styling

Edit the CSS variables in `resources/views/home.blade.php`:

```css
:root {
    --color-cream: #F5F1EB;
    --color-charcoal: #2C2C2C;
    --color-sage: #7D9181;
    --color-terracotta: #C67B5C;
    --color-gold: #C9A962;
}
```

## File Structure

```
├── app/
│   ├── Console/Commands/
│   │   └── RefreshInstagramToken.php  # Token refresh command
│   ├── Http/Controllers/
│   │   └── HomeController.php         # Main controller
│   └── Services/
│       └── InstagramService.php       # Instagram API (12hr cache)
├── config/
│   └── services.php                   # Instagram config
├── resources/views/
│   └── home.blade.php                 # Complete frontend
├── routes/
│   └── web.php                        # Single route
└── storage/framework/cache/           # File-based cache
```

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan view:cache`
5. Set up SSL certificate
6. Point web server to `public/` folder

## License

© 2024 Chris McGann Painter & Decorator. All rights reserved.
