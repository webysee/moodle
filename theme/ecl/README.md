# Thème Moodle ECL — École de Commerce de Lyon (Campus Abidjan)

Thème Moodle officiel pour l'**École de Commerce de Lyon — Campus Abidjan**, basé sur le thème parent **Boost**.
Compatible Moodle **4.5 LTS / 5.x+**.

---

## ✨ Fonctionnalités

- 🎨 **Charte graphique ECL** (bleu `#002362` + rouge `#E30613`) avec accents tricolores ivoiriens (orange `#F77F00`, vert `#009E60`)
- 🏠 **Page d'accueil personnalisée** avec :
  - Hero plein-écran avec titre, sous-titre, CTA et statistiques
  - **Slider d'annonces** carrousel (jusqu'à 5 diapositives, intervalle paramétrable)
  - **4 cartes "Points forts"** (icône + titre + description + lien)
- 🔐 **Page de connexion split-screen** (panneau de marque + formulaire)
- 📑 **Footer riche** à 4 colonnes paramétrables (HTML, liens, réseaux sociaux)
- 🌍 **Multilingue** Français + English (extensible)
- ⚙️ **Panneau d'administration complet** : couleurs, logo, hero, slider, footer
- 🌓 Compatible avec le **mode sombre** Boost (préférences utilisateur)
- 📱 **100% responsive**
- 🎓 Compatible avec tous les blocs Moodle natifs

---

## 📦 Installation

### Méthode 1 — Via l'interface admin Moodle

1. Téléchargez le fichier `theme_ecl_v1.0.0.zip`.
2. Connectez-vous en tant qu'administrateur Moodle.
3. Allez dans **Administration du site → Plugins → Installer des plugins**.
4. Glissez-déposez le ZIP dans la zone d'upload.
5. Cliquez sur **Installer le plugin depuis le fichier ZIP**.
6. Suivez l'assistant jusqu'à la fin.

### Méthode 2 — Via FTP / SSH

```bash
# Décompressez le ZIP dans le dossier theme/ de votre Moodle :
cd /chemin/vers/moodle/theme/
unzip theme_ecl_v1.0.0.zip
# Vous devez avoir : moodle/theme/ecl/
```

Puis dans Moodle : **Administration du site → Notifications** → l'installation se déclenche automatiquement.

---

## 🎨 Activation du thème

1. **Administration du site → Apparence → Thèmes → Sélecteur de thème**
2. Cliquez sur **Modifier le thème** sur la ligne « Default ».
3. Sélectionnez **ECL — École de Commerce de Lyon**.
4. Cliquez sur **Utiliser le thème**.

---

## ⚙️ Configuration

Allez dans **Administration du site → Apparence → ECL — École de Commerce de Lyon**.
Vous y trouverez 5 onglets :

| Onglet | Contenu |
|---|---|
| **Général** | Logo, favicon, couleurs (primaire, secondaire, accents), SCSS personnalisé |
| **Page d'accueil** | Hero (titre, sous-titre, CTA), 4 cartes Points forts |
| **Slider d'annonces** | Jusqu'à 5 diapositives (image, titre, description, lien), intervalle |
| **Connexion** | Image de fond, slogan |
| **Pied de page** | 4 colonnes HTML personnalisables, mention légale |

---

## 🗂️ Structure du thème

```
ecl/
├── config.php          # Configuration du thème (parents, layouts)
├── version.php         # Version + dépendances
├── lib.php             # Fonctions PHP (SCSS, fichiers, helpers)
├── settings.php        # Réglages admin
├── pix/
│   └── logo.png        # Logo par défaut
├── scss/
│   ├── preset/         # Presets (default, plain)
│   └── ecl/            # Composants SCSS modulaires
├── layout/             # drawers, frontpage, login, secure...
├── lang/               # FR + EN
├── templates/          # Mustache (frontpage, login)
└── classes/output/     # core_renderer
```

---

## 🛠️ Dépannage

**Le thème n'apparaît pas dans la liste ?**
→ Purgez les caches : `Administration du site → Développement → Purger toutes les caches`.

**Les couleurs ne s'appliquent pas ?**
→ Le SCSS est mis en cache. Purgez les caches après chaque modification.
→ En mode dev, ajoutez `$CFG->themedesignermode = true;` dans `config.php` (Moodle).

**Le slider ne défile pas ?**
→ Vérifiez que le « nombre de diapositives » est ≥ 1 dans les réglages, et qu'au moins une diapositive a un titre.

---

## 📄 Licence

GPL v3 — © 2026 École de Commerce de Lyon.

Ce thème étend le thème Boost officiel de Moodle.
