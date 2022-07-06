# Änderungsprotokoll
Das Format basiert auf [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) und vewendet [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
Unveröffentlichte Features und Fixes können auf GitHub eingesehen werden. Klicke hierfür auf [Unreleased].

## [0.4.0] - 2022-07-06

### Added
- Feature: Hookpoints für modified 2.0.6.0, 2.0.7.0, 2.0.7.1 und 2.0.7.2 hinzugefügt
- Feature: Neue Methode unregisterAll() für alle Default Hookpoints hinzugefügt.
- Feature: Neue Methode HookPointManager::unregisterDefault() hinzugefügt.
- Feature: Neue Method HookPointRepository::deleteHookPointByName() hinzugefügt.

### Changed
- Dokumentation: Neue Methoden in der Dokumentation ergänzt.

## [0.3.1] - 2021-11-23

### Changed
- Fix: Fehler behoben, der auftreten kann, wenn das Modul in einem Ordner mit Versionspfad installiert ist. (#5)

## [0.3.0] - 2021-11-12

### Added
- Feature: Neuer Hookpoint `hpm-default-autocomplete-prepare-sql` hinzugefügt.

## [0.2.1] - 2020-10-11

### Changed
- Fix: Includes können jetzt mehere Male geladen werden.
- Fix: Es wurde ein Fehler behoben, der dafür gesort hat, dass der Shoproot nicht gefunde wurde, wenn das Modul per Symlink installiert wurde.

## [0.2.0] - 2020-09-24

### Added
- Feature: Neuer Hookpoint `hpm-default-define-conditions-top` hinzugefügt.

### Changed
- Fix: Es werden jetzt Hashwerte kontrolliert, bevor ein Hookpoint zu einer Datei hinzugefügt wird.

## [0.1.0] - 2020-07-31

### Added
- Feature: Initiale Version.
- Feature: Neuer Hookpoint `hpm-default-create-account-prepare-data` hinzugefügt.
- Feature: Neuer Hookpoint `hpm-default-create-guest-account-prepare-data` hinzugefügt.
- Feature: Neuer Hookpoint `hpm-default-admin-categories-view-small-buttons` hinzugefügt.
- Feature: Neuer Hookpoint `hpm-default-admin-categories-view-side-buttons` hinzugefügt.
- Feature: Neuer Hookpoint `hpm-default-admin-new-product-buttons` hinzugefügt.


[Unreleased]: https://github.com/RobinTheHood/hook-point-manager/compare/0.4.0...HEAD
[0.4.0]: https://github.com/RobinTheHood/hook-point-manager/compare/0.3.1...0.4.0
[0.3.1]: https://github.com/RobinTheHood/hook-point-manager/compare/0.3.0...0.3.1
[0.3.0]: https://github.com/RobinTheHood/hook-point-manager/compare/0.2.1...0.3.0
[0.2.1]: https://github.com/RobinTheHood/hook-point-manager/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/RobinTheHood/hook-point-manager/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/RobinTheHood/hook-point-manager/releases/tag/0.1.0
