<?php
// Theme ECL - French language strings.

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'ECL — École de Commerce de Lyon';
$string['choosereadme'] = 'Thème officiel de l\'École de Commerce de Lyon (Campus Abidjan). Basé sur Boost, il propose une page d\'accueil personnalisée avec hero, slider d\'annonces, blocs personnalisés et un footer riche multilingue.';
$string['configtitle'] = 'Réglages du thème ECL';

// Tabs.
$string['generalsettings']   = 'Général';
$string['frontpagesettings'] = 'Page d\'accueil';
$string['slidersettings']    = 'Slider d\'annonces';
$string['loginsettings']     = 'Connexion';
$string['footersettings']    = 'Pied de page';

// General.
$string['preset']         = 'Preset du thème';
$string['preset_desc']    = 'Choisissez un preset pour modifier rapidement l\'apparence générale du thème.';
$string['preset_default'] = 'Défaut ECL';
$string['preset_plain']   = 'Sobre';

$string['logo']           = 'Logo';
$string['logo_desc']      = 'Logo affiché dans la barre de navigation, le footer et la page de connexion. Format recommandé : PNG/SVG carré.';
$string['favicon']        = 'Favicon';
$string['favicon_desc']   = 'Icône onglet navigateur.';

$string['primarycolor']        = 'Couleur primaire';
$string['primarycolor_desc']   = 'Couleur principale de la marque (par défaut #002362).';
$string['secondarycolor']      = 'Couleur secondaire';
$string['secondarycolor_desc'] = 'Couleur d\'accent (par défaut rouge #E30613).';
$string['accent1color']        = 'Accent orange';
$string['accent1color_desc']   = 'Couleur d\'accent orange — clin d\'œil au drapeau ivoirien (par défaut #F77F00).';
$string['accent2color']        = 'Accent vert';
$string['accent2color_desc']   = 'Couleur d\'accent vert — clin d\'œil au drapeau ivoirien (par défaut #009E60).';

$string['scsspre']         = 'SCSS personnalisé (avant)';
$string['scsspre_desc']    = 'Variables SCSS personnalisées injectées avant la compilation Boost.';
$string['scsscustom']      = 'SCSS personnalisé (après)';
$string['scsscustom_desc'] = 'CSS/SCSS personnalisé ajouté en fin de feuille pour surcharger n\'importe quel style.';

// Front page / hero.
$string['herotitle']           = 'Titre du Hero';
$string['herotitle_desc']      = 'Titre principal affiché en haut de la page d\'accueil.';
$string['herotitle_default']   = 'Façonnez l\'élite du commerce africain.';
$string['herosubtitle']        = 'Sous-titre du Hero';
$string['herosubtitle_desc']   = 'Texte d\'introduction sous le titre principal.';
$string['herosubtitle_default'] = 'Bienvenue sur la plateforme d\'apprentissage de l\'École de Commerce de Lyon — Campus Abidjan. Programmes Bachelor, Master & Executive en management, finance, marketing digital et entrepreneuriat.';
$string['heroctalabel']        = 'Texte du bouton CTA';
$string['heroctalabel_default'] = 'Accéder à mes cours';
$string['heroctaurl']          = 'URL du bouton CTA';
$string['heroimage']           = 'Image du Hero (optionnelle)';
$string['heroimage_desc']      = 'Image décorative pour la section Hero.';

$string['herobadge']           = 'École labellisée AACSB';
$string['exploreprograms']     = 'Explorer les programmes';
$string['stat_programs']       = 'Programmes';
$string['stat_students']       = 'Étudiants';
$string['stat_employability']  = 'Insertion pro';

$string['announcements']       = 'Annonces & actualités';
$string['announcement']        = 'Annonce';
$string['readmore']            = 'En savoir plus';

$string['highlights']          = 'Points forts (cartes)';
$string['highlights_desc']     = 'Configurez 4 cartes mises en avant sur la page d\'accueil.';
$string['highlighttitle']      = 'Carte {$a} — Titre';
$string['highlightticon']      = 'Carte {$a} — Icône';
$string['highlighticon']       = 'Carte {$a} — Icône (FontAwesome)';
$string['highlighticon_desc']  = 'Classe FontAwesome (ex: fa-graduation-cap, fa-globe).';
$string['highlighttext']       = 'Carte {$a} — Description';
$string['highlighturl']        = 'Carte {$a} — URL';

$string['highlight1title_default'] = 'Excellence académique';
$string['highlight2title_default'] = 'Ouverture internationale';
$string['highlight3title_default'] = 'Réseau Alumni';
$string['highlight4title_default'] = 'Innovation pédagogique';

$string['whychoose']      = 'Pourquoi choisir ECL Abidjan';
$string['whychoose_lead'] = 'Une école française historique au service de la jeunesse africaine, avec une pédagogie moderne, un encadrement de qualité et un fort taux d\'insertion professionnelle.';
$string['learnmore']      = 'Découvrir';

// Slider.
$string['slider']            = 'Slider d\'annonces';
$string['slider_desc']       = 'Configurez les diapositives qui apparaissent en haut de la page d\'accueil. Laissez vide pour masquer une diapositive.';
$string['slidercount']       = 'Nombre de diapositives à afficher';
$string['slidercount_desc']  = 'Choisissez combien de diapositives doivent être visibles (0 pour masquer le slider).';
$string['sliderinterval']    = 'Intervalle (ms)';
$string['sliderinterval_desc'] = 'Durée d\'affichage de chaque diapositive en millisecondes (par défaut 6000).';
$string['slideheading']      = 'Diapositive {$a}';
$string['slideimage']        = 'Image de fond';
$string['slideimage_desc']   = 'Image affichée en fond de la diapositive (idéal 1920×600).';
$string['slidetitle']        = 'Titre';
$string['slidecaption']      = 'Légende / description';
$string['slideurl']          = 'URL du lien';

// Login.
$string['loginbg']        = 'Image de fond (panneau gauche)';
$string['loginbg_desc']   = 'Image affichée en arrière-plan du panneau gauche de la page de connexion.';
$string['logintagline']   = 'Slogan de connexion';
$string['logintagline_desc'] = 'Phrase d\'accroche affichée sur le panneau gauche.';
$string['logintagline_default'] = 'Apprenez. Entreprenez. Rayonnez.';
$string['login_pitch']    = 'Une plateforme moderne pour suivre vos cours, dialoguer avec vos professeurs et préparer votre carrière à l\'international.';
$string['welcomeback']    = 'Bon retour parmi nous';
$string['welcomeback_sub'] = 'Connectez-vous à votre espace étudiant pour accéder à vos cours et ressources.';
$string['help_center']    = 'Centre d\'aide';
$string['contact']        = 'Contact';

// Footer.
$string['footer']         = 'Pied de page';
$string['footer_desc']    = 'Configurez les 4 colonnes du pied de page. Utilisez du HTML pour les liens et icônes.';
$string['footercoltitle'] = 'Colonne {$a} — Titre';
$string['footercolcontent'] = 'Colonne {$a} — Contenu HTML';
$string['footnote']       = 'Mention légale (bas de page)';
$string['footnote_desc']  = 'Texte de copyright affiché tout en bas de la page.';
$string['footer_tagline'] = 'L\'école de commerce qui forme les leaders africains de demain, à Lyon comme à Abidjan.';
$string['poweredby']      = 'Plateforme propulsée par';
$string['allrightsreserved'] = 'Tous droits réservés.';

// Privacy.
$string['privacy:metadata'] = 'Le thème ECL ne stocke aucune donnée personnelle.';
