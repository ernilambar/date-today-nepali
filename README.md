# Date Today Nepali

![WordPress Plugin: Requires WP 6.3](https://img.shields.io/badge/WordPress%20Plugin-Requires%20WP%206.3-blue.svg)
![Tested up to: WP 6.9](https://img.shields.io/badge/Tested%20up%20to-WP%206.9-brightgreen.svg)
![PHP: Requires PHP 7.4](https://img.shields.io/badge/PHP-Requires%20PHP%207.4-8892BF.svg)
![License: GPLv2 or later](https://img.shields.io/badge/License-GPLv2%20or%20later-yellowgreen.svg)

Date Today Nepali is a small WordPress plugin for displaying Nepali date in your website. This plugin converts current date to BS (Bikram Sambat) and displays in the widget. You can either display it in English or Nepali language. Several date formats are available.

## Usage

### Block

Add the **Date Today Nepali** block via the block inserter (search "Nepali"). Configure language and date format in the block sidebar.

### Widget

Go to **Appearance > Widgets**, add the **Date Display Widget** to any widget area, and configure language and date format from the widget settings.

### Date Formats

| Format | Example |
|--------|---------|
| `d F Y` | १८ जेठ २०७७ |
| `F d, Y` | जेठ १८, २०७७ |
| `Y F d` | २०७७ जेठ १८ |
| `l, d F Y` | आइतबार, १८ जेठ २०७७ |
| `d.m.y` | १८.०२.७७ |
| `Y.m.d` | २०७७.०२.१८ |
| `D, d F` | आइत, १८ जेठ |
| `Y F d, l` | २०७७ जेठ १८, आइतबार |

## Development

### Requirements

- Node.js >= 22
- pnpm >= 11
- PHP >= 7.4
- Composer

### Setup

```sh
git clone https://github.com/ernilambar/date-today-nepali.git
cd date-today-nepali
pnpm install
composer install
```

### Commands

| Command | Description |
|---------|-------------|
| `pnpm run dev` | Start webpack in watch mode |
| `pnpm run build` | Production build |
| `pnpm run deploy` | Build and package for release |
| `pnpm run lint:js` | Lint JavaScript |
| `pnpm run format` | Format files with Prettier |
| `pnpm run pot` | Generate translation template |

## License

This project is licensed under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).
