# Thème Moodle ECL — École de Commerce de Lyon (Campus Abidjan)

Thème Moodle premium pour l'**École de Commerce de Lyon — Campus Abidjan**, inspiré de l'architecture `boost_universite`.
Basé sur **Boost**. Compatible **Moodle 4.x et 5.x+**.

---

## ✨ Fonctionnalités

- 🎨 **Navbar premium** : dégradé bleu marine `#002362 → #003a99` + bordure rouge `#cc0000`
- 🔥 **Hero animé** : compteurs (Étudiants, Programmes, Insertion pro, Pays partenaires) avec animation au chargement, bouton CTA rouge
- 🃏 **Cartes de cours enrichies** : hover translateY + shadow gradient
- 🎯 **Dashboard gamifié** : streak, badges, stat cards à bordure couleur
- 🌓 **Mode sombre automatique** (`prefers-color-scheme: dark`) + classes `.force-dark` / `.force-light`
- 🏛️ **Footer institutionnel** : sombre `#001a4d`, colonnes responsive, icônes sociales, bandeau drapeau ivoirien (orange/blanc/vert)
- 📄 **Bloc page d'accueil prêt à coller** (`BLOC_PAGE_ACCUEIL.html`) : bannière de bienvenue + 6 cartes de programmes (Management, Finance, Marketing Digital, Commerce International, Entrepreneuriat, Droit)
- 🚫 **Masquage automatique** des mentions Moodle natives (Powered by Moodle, app mobile, thème standard, etc.)
- 📱 **Mobile-first** : burger styling, masquage du bouton édition pour les non-admins
- 🇫🇷🇬🇧 **Multilingue** Français + Anglais

---

## 📦 Installation

### Via l'interface admin Moodle (recommandé)

1. Téléchargez le fichier `ecl_v1.1.0.zip`
2. Connectez-vous en **administrateur Moodle**
3. **Administration du site → Plugins → Installer des plugins**
4. Glissez-déposez le ZIP dans la zone d'upload
5. Cliquez sur **Installer le plugin depuis le fichier ZIP**
6. Suivez l'assistant jusqu'à la fin

### Via FTP / SSH

```bash
cd /chemin/vers/moodle/theme/
unzip ecl_v1.1.0.zip
# Vous obtenez : moodle/theme/ecl/
```

Puis dans Moodle : **Administration du site → Notifications** → l'install se déclenche.

---

## 🎨 Activation du thème

1. **Administration du site → Apparence → Thèmes → Sélecteur de thème**
2. Cliquez sur **Modifier le thème** sur la ligne « Default »
3. Sélectionnez **ECL — École de Commerce de Lyon**
4. **Utiliser le thème**

---

## 📄 Activer le bloc Page d'accueil (Bienvenue + Programmes)

1. **Administration du site → Page d'accueil → Réglages**
2. Cochez **Mode édition activé** (en haut à droite)
3. Sur la page d'accueil, cliquez **Ajouter une activité ou ressource → Étiquette (Label)**
4. Dans l'éditeur, basculez en **mode source HTML** (icône `</>`)
5. **Copiez-collez** tout le contenu de `BLOC_PAGE_ACCUEIL.html` (fourni dans le thème)
6. **Enregistrer** → la bannière + la grille des programmes apparaissent

---

## 🛠️ Personnalisation

Toutes les couleurs sont définies dans **`lib.php`** (fonction `theme_ecl_get_extra_scss`). Modifiez les codes hex pour adapter à votre charte :

| Variable | Valeur | Usage |
|---|---|---|
| `#002362` | Bleu primaire ECL | Navbar, titres, accents |
| `#003a99` | Bleu secondaire | Dégradé navbar |
| `#001a4d` | Bleu foncé | Footer, dropdowns |
| `#cc0000` | Rouge accent | Bordures, hovers, CTA |
| `#F77F00` | Orange CI | Drapeau / warning |
| `#009E60` | Vert CI | Drapeau / success |

Pour ajuster les compteurs hero : modifiez `javascript/ecl.js` (lignes `data-target=...`).

---

## 🗂️ Structure

```
ecl/
├── config.php                  # Configuration du thème
├── version.php                 # Version + dépendances
├── lib.php                     # CSS injecté + variables SCSS
├── BLOC_PAGE_ACCUEIL.html      # Bloc à coller dans Moodle
├── style/
│   ├── navbar.css              # Override CSS chargé en dernier
│   └── moodle.css              # Fallback minimal
├── javascript/
│   └── ecl.js                  # Hero animé + dashboard
├── classes/output/
│   └── core_renderer.php       # Nettoyage footer Moodle natif
├── pix/
│   ├── logo.png                # Logo ECL Abidjan
│   ├── favicon.png             # Favicon
│   └── screenshot.png          # Aperçu pour le sélecteur
└── lang/
    ├── fr/theme_ecl.php
    └── en/theme_ecl.php
```

---

## 🛠️ Dépannage

**Le thème n'apparaît pas dans la liste ?**
→ Purgez les caches : `Administration du site → Développement → Purger toutes les caches`

**Les couleurs ne s'appliquent pas ?**
→ Le CSS est mis en cache. Purgez après chaque modification du code.
→ En dev, ajoutez `$CFG->themedesignermode = true;` dans `config.php` (Moodle, pas le thème).

**Le hero ne s'affiche pas avec les compteurs ?**
→ Le JS injecte le hero uniquement sur la page d'accueil (`#page-site-index #page-header`). Vérifiez que vous êtes bien sur la page racine du site.

**Mode sombre actif alors que je ne le veux pas ?**
→ Le mode sombre suit la préférence OS. Pour forcer un mode, ajoutez la classe `force-light` ou `force-dark` au `<body>` via un JS ou un block HTML personnalisé.

---

## 📄 Licence

GPL v3 — © 2026 École de Commerce de Lyon.
Ce thème étend `theme_boost` officiel de Moodle.
