![shoutzor-logo](./xorinzor/shoutzor/shoutzor-logo.png)

[![Travis](https://img.shields.io/travis/xorinzor/shoutzor.svg?maxAge=2592000&style=flat)]()
[![Github All Releases](https://img.shields.io/github/downloads/xorinzor/shoutzor/total.svg?maxAge=2592000&style=flat)]()
[![GitHub release](https://img.shields.io/github/release/xorinzor/shoutzor.svg?maxAge=2592000&style=flat)]()

This version of shoutzor is built as an module and theme for Pagekit.

Shoutzor is a central music playing system that allows your LAN-party (or other kind of event) to have centralized music!

*Keep in mind this module and theme are not designed to work nice with other modules and/or themes, they're intended as a standalone app.*

##How to install:

0. Download the latest release from the "releases tab"
1. Copy the "xorinzor" directory into your pagekit's "packages" directory
2. Enable the "Shoutzor" module and set your theme to the "shoutzor-theme" theme.
3. Go to your site's pages and set the shoutzor dashboard page to be your homepage
4. Move any pages you want to be shown in the sidebar to the "main" menu parent
5. Configure your "main" menu parent to be the "main" menu.
6. The website's front-end now is configured, next set-up the back-end
7. Use `chmod +x` on `/shoutzor-requirements/acoustid/fpcalc` to make it executable
8. Follow the steps in `/shoutzor/readme.md` to install liquidsoap
9. Make sure you configure the correct directories in the admin panel for Shoutz0r to use
10. Start shoutzor from the admin panel in the `system` tab, everything should be up and running now!
11. optionally visit the ShoutzorVisualizer repository, download the jar, run it on a computer with a beamer for visual effects at your location
