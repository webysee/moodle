# PRD — Thème Moodle ECL (École de Commerce de Lyon, Campus Abidjan)

## Problème initial
> "Saurais-tu développer un thème Moodle pour une université ?"
> Choix utilisateur :
> - Vrai thème Moodle PHP basé sur Boost (parent)
> - Nom : École de Commerce de Lyon — Campus Abidjan
> - Couleur primaire : #002362 (bleu marine)
> - Couleur secondaire : rouge
> - Moodle 5.2+
> - Fonctionnalités : Slider d'annonces, blocs personnalisés, footer riche, page d'accueil personnalisée, multilingue
> - Logo fourni (avec drapeau ivoirien orange/vert)

## Architecture
- **Type** : thème Moodle enfant (child theme) basé sur `theme_boost`
- **Compatibilité** : Moodle 4.5 LTS et 5.x+ (`$plugin->requires = 2024100700`)
- **Stack** : PHP 8+, SCSS, Mustache (templates), JS (Bootstrap 5 carousel)
- **Localisation** : `/app/theme/ecl/` (source) et `/app/theme/ecl_v1.0.0.zip` (livrable installable)

## Personas
- **Étudiant** : consulte cours, annonces, accède au tableau de bord
- **Enseignant** : édite cours, accès via interface Boost classique
- **Administrateur** : configure logo, couleurs, slider, footer via panneau dédié à 5 onglets

## Core requirements (statiques)
- Charte : `#002362` primaire, `#E30613` rouge, accents `#F77F00` orange + `#009E60` vert
- Page d'accueil avec hero (titre, sous-titre, CTA, stats animées)
- Slider carousel jusqu'à 5 slides paramétrables
- 4 cartes "Points forts" avec icônes FontAwesome
- Page de connexion split-screen
- Footer 4 colonnes HTML personnalisable + bandeau drapeau CI
- Navbar avec logo, menu, langue, user menu
- Multilingue FR + EN (extensible)

## Implémenté (10 jan 2026)
- ✅ Structure complète Moodle (`config.php`, `version.php`, `lib.php`, `settings.php`)
- ✅ SCSS modulaire 10 fichiers (`_variables`, `_navbar`, `_buttons`, `_cards`, `_frontpage`, `_slider`, `_blocks`, `_login`, `_footer`, `_dark`)
- ✅ Layouts : `drawers` (héritage Boost), `frontpage` (custom), `login` (custom split-screen), `secure`, `embedded`, `maintenance`, `columns1`
- ✅ Templates Mustache : `frontpage.mustache`, `login.mustache`
- ✅ Renderer custom : `theme_ecl\output\core_renderer` (logo & favicon)
- ✅ 5 onglets de réglages admin : Général, Page d'accueil, Slider, Connexion, Footer
- ✅ 50+ chaînes de langue FR + EN
- ✅ Logo ECL Abidjan intégré (`/pix/logo.png`, `/pix/favicon.png`, `/pix/screenshot.png`)
- ✅ ZIP installable : `/app/theme/ecl_v1.0.0.zip` (160 KB)
- ✅ Aperçu HTML statique à `/app/theme/preview.html` (validation visuelle avant install)
- ✅ Fonts custom : Fraunces (display) + Outfit (body) — non-AI-slop
- ✅ Tricolore CI subtil (top navbar + top footer + accents cards)
- ✅ Validation syntaxe PHP : 0 erreur

## Backlog (P1 / P2)
- P1 : Page de cours (course/view) custom layout
- P1 : Dashboard étudiant avec widgets ECL (progrès, échéances, prochains cours)
- P2 : Mode sombre dédié ECL (au-delà du Boost preference)
- P2 : Bloc dashboard "Pulse" avec actualités flux RSS
- P2 : Composant "Programme finder" sur la page d'accueil
- P2 : Animations Lottie / micro-interactions hero
- P2 : Plus de presets (Plain, Heritage, Vibrant)
- P2 : Espagnol + Arabe (extension multilingue)

## Next tasks (à valider avec l'utilisateur)
1. Tester l'installation sur l'instance Moodle de l'université
2. Affiner les contenus par défaut (textes, stats) selon données réelles ECL
3. Ajouter screenshots officiels du campus pour le slider
4. Configurer SAML / SSO si auth fédérée requise
5. Préparer la livraison à l'équipe IT
