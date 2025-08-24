# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a customized Rhymix CMS setup with Docker deployment. Rhymix is a Korean CMS/community platform. The project includes custom layouts, modules, and automated installation scripts for a housing cooperative/association website.

## Architecture

### Directory Structure

- `app/_rhymix/` - Core Rhymix framework (git submodule)
- `app/custom/` - Custom extensions and modifications
  - `layouts/ibs_layout/` - Custom IBS theme layout
  - `modules/install/script/` - Custom installation automation
  - `modules/board/skins/faq/` - Custom FAQ board skin
- `deploy/` - Docker deployment configuration
- `volume/` - Docker persistent volumes (database, backups)

### Key Components

**Custom Installation System**: The `app/custom/modules/install/script/ko.install.php` file contains a comprehensive installation script that:
- Creates site structure with menus and modules
- Sets up board permissions and member groups
- Configures SMTP email settings from `.env` file
- Implements board secret post functionality
- Sets up FCM push notifications
- Creates initial pages and posts from Blade template files

**Content Management**: Template files are stored in:
- `pages/` - Article/page content (overview.blade.php, contact.blade.php, etc.)
- `posts/` - Board post content templates
- `img/` - Associated images for content

## Development Commands

### Docker Operations

```bash
# Build and start all services
cd deploy
docker-compose up -d --build

# View logs
docker-compose logs -f [service_name]

# Stop services
docker-compose down

# Rebuild specific service
docker-compose up -d --build [service_name]
```

### Database Operations

```bash
# Backup database
cd volume/backups
./dump_mariadb.sh

# Restore database  
./restore_mariadb.sh
```

### Configuration

1. **Environment Setup**: Copy and configure `.env` file in `app/custom/modules/install/script/`
2. **SMTP Configuration**: Set email server details in `.env`
3. **FCM Push Notifications**: Add `firebase-key.json` service account file
4. **Docker Environment**: Configure database credentials in `docker-compose.yml`

## Custom Installation Process

The installation script (`ko.install.php`) performs these operations:
1. Creates hierarchical menu structure for housing cooperative
2. Sets up member groups with appropriate permissions
3. Configures board modules with custom permission sets
4. Loads content from Blade template files
5. Applies custom layout and styling
6. Sets up SMTP email integration
7. Configures session management for Kubernetes environments

## Working with Content

- **Page Content**: Edit `.blade.php` files in `pages/` directory
- **Images**: Store in `img/` directory, reference with `./app/custom/modules/install/script/img/filename`
- **Styling**: Inline CSS in Blade files or modify layout CSS files
- **Permissions**: Modify permission arrays in `ko.install.php`

## File References

When referencing code locations, use the format `file_path:line_number` (e.g., `ko.install.php:574` for the createInitDocument function).

## Important Notes

- The installation script includes comprehensive board permission management for different user types (guests, members, admin)
- Custom JavaScript is generated for secret post functionality
- The system includes multi-language support (primarily Korean)
- Docker volumes persist database and file uploads
- Custom layouts and modules are bind-mounted for development

## Security Considerations

- `.env` files contain sensitive credentials and should not be committed
- Firebase service account keys are sensitive
- Database credentials are stored in docker-compose.yml
- File permissions should restrict access to configuration files