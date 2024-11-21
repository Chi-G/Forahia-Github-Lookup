# Forahia Github Lookup

A React application to search GitHub users and display their profile information. 

## Updates

### Q: How do I remove the user stats scroll bars on mobile?
Fix implemented in [User.jsx](src/pages/User.jsx).

### BUG: Alert text is not visible
This issue occurs with the default light theme from DaisyUI. Fixes in [Alert.jsx](src/components/layout/Alert.jsx) ensure the alert component adapts to theme changes and prevents content shift.

### Q: Why doesn't Craco work?
`craco` is not required with `react-scripts` version 5 or greater. Follow the Tailwind setup for the relevant version:
- Version 5+: [Tailwind version 3 Setup](https://tailwindcss.com/docs/guides/create-react-app)
- Version 4: [Tailwind version 2 Setup](https://v2.tailwindcss.com/docs/guides/create-react-app)

### BUG: Linking to users' websites
Ensure external links are constructed correctly by checking if the URL starts with `http`. See [User.jsx](src/pages/User.jsx#L48).

### BUG: Light theme RepoItem background is too dark
Fix applied using `base-200` and `base-300` background classes for proper color scheme adaptation.

## Setup

1. Rename **_.env.example_** to **_.env_**.
2. Add your GitHub personal access token to the `.env` file (optional).

Demo [forahia-github-lookup](https://githublookup.forahia.org.ng/).

### Install Dependencies

```bash
npm install

## Author
Created by Chijindu Nwokeohuru.