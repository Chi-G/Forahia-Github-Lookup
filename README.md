# DevRadar

**DevRadar** is an intelligent platform constructed to explore and analyze Github developers, providing a streamlined high-performance analytics dashboard.

Originally conceptualized as a React application, this platform has been comprehensively refactored into a highly efficient, backend-driven **Laravel** ecosystem.

### 🔗 Demo Link
Explore DevRadar live at: **[devradar.laravel.cloud](https://devradar.laravel.cloud)**

---

## Tech Stack Overview
- **Framework**: [Laravel 11](https://laravel.com)
- **Dynamic Rendering**: [Livewire 3](https://livewire.laravel.com) & Alpine.js
- **Styling Engine**: [Tailwind CSS v4](https://tailwindcss.com) & DaisyUI
- **Analytics Subsystem**: Native PHP implementation for repository metadata parsing
- **Deployment**: Containerized via [Laravel Sail](https://laravel.com/docs/sail)

## Premium Features
- **Tech Stack Analyzer**: Dynamically inspects global codebase composition and calculates usage percentage across repositories for immediate visualization.
- **Hero Discovery Suite**: Predictive search architecture designed to source profiles via Github's massive user dataset seamlessly.
- **Responsive Paginated Intelligence**: High-performance server-side paging systems tracking activity feeds across all screen factors.
- **Modern Visual Ambient Layers**: Full-spectrum glassmorphism UI with deep-slate aesthetic controls.

---

## Getting Started

Launch the development server using Laravel Sail:

```bash
# Copy sample environment configuration
cp .env.example .env

# Install application dependencies
composer install && npm install

# Fire up the Sail containers
./vendor/bin/sail up -d

# Bootstrap database schemas
./vendor/bin/sail artisan migrate
```

Visit **http://localhost:8000** to open your development instance.

---
&copy; 2026 **Forahia Solutions**
