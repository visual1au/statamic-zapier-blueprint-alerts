# Publishing to GitHub and Packagist

This document explains how to publish this Statamic addon to GitHub and make it available via Composer.

## Step 1: Create GitHub Repository

1. **Create a new repository on GitHub:**
   - Go to https://github.com/visual1au
   - Click "New repository"
   - Name: `statamic-zapier-blueprint-alerts`
   - Description: "Shows alerts on Statamic form blueprint edit pages when Zapier webhooks are configured"
   - Make it public
   - Don't initialize with README (we already have one)

2. **Push the addon code:**

```bash
# Navigate to the addon directory
cd addons/zapier-blueprint-alerts

# Initialize git repository
git init

# Add all files
git add .

# Make initial commit
git commit -m "Initial release of Zapier Blueprint Alerts addon"

# Add GitHub remote
git remote add origin git@github.com:visual1au/statamic-zapier-blueprint-alerts.git

# Push to GitHub
git branch -M main
git push -u origin main
```

## Step 2: Create a Release

1. **Tag your first release:**

```bash
git tag -a v1.0.0 -m "Release version 1.0.0"
git push origin v1.0.0
```

2. **Create release on GitHub:**
   - Go to your repository on GitHub
   - Click "Releases" → "Create a new release"
   - Choose tag: `v1.0.0`
   - Release title: `v1.0.0 - Initial Release`
   - Description:
     ```
     ## Features
     - Automatic detection of Zapier webhooks on Statamic forms
     - Warning alerts on form blueprint edit pages
     - Clean integration with Statamic's design system
     - Safe fallback when Zapier addon is not installed
     ```

## Step 3: Publish to Packagist

1. **Go to Packagist:**
   - Visit https://packagist.org
   - Sign in with your GitHub account

2. **Submit your package:**
   - Click "Submit" in the top navigation
   - Enter your repository URL: `https://github.com/visual1au/statamic-zapier-blueprint-alerts`
   - Click "Check" to validate
   - Click "Submit" to publish

3. **Set up auto-updating (optional but recommended):**
   - Go to your package page on Packagist
   - Click the "Settings" tab
   - Enable "GitHub Service Hook"
   - This will automatically update Packagist when you push new releases

## Step 4: Test Installation

Test the package can be installed via Composer:

```bash
# In a fresh Statamic project
composer require visual1au/statamic-zapier-blueprint-alerts
```

## Future Releases

For future updates:

1. **Update version in composer.json** (optional, but good practice)
2. **Update CHANGELOG.md**
3. **Commit changes:**
   ```bash
   git add .
   git commit -m "Release version 1.1.0"
   ```
4. **Create new tag:**
   ```bash
   git tag -a v1.1.0 -m "Release version 1.1.0"
   git push origin v1.1.0
   ```
5. **Create release on GitHub**

## Package Structure

Your final package structure should be:

```
statamic-zapier-blueprint-alerts/
├── .github/
│   └── workflows/
│       └── tests.yml
├── src/
│   └── ServiceProvider.php
├── resources/
│   └── views/
│       ├── alert.blade.php
│       └── forms/blueprints/
│           └── edit.blade.php
├── .gitignore
├── CHANGELOG.md
├── LICENSE
├── README.md
├── composer.json
└── PUBLISHING.md (this file)
```

## Notes

- Make sure your composer.json `name` field matches your GitHub repository: `visual1au/statamic-zapier-blueprint-alerts`
- The package will be available at: https://packagist.org/packages/visual1au/statamic-zapier-blueprint-alerts
- Users can then install it with: `composer require visual1au/statamic-zapier-blueprint-alerts`