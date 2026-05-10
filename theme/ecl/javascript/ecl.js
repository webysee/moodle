// theme_ecl — JS premium v1.3
// - Hero animé page d'accueil
// - Numéros de chapitre auto (drawer + sections)
// - Barre de progression cours
// - Animations de complétion
// - VUE TUILES (Notion gallery / format_tiles inspired)
// Inspired by Coursera / Klass / OpenClassrooms / Notion UX.

(function() {
    'use strict';

    var TILE_EMOJIS = ['🚀','📊','💡','🎯','🌍','💼','📈','🧠','⚡','🎓','💎','🔬','📚','🎨','⚙️','🏆'];
    var TILE_COUNT = 12; // number of color variants in CSS

    function animateCounter(el, target, duration) {
        var step = target / (duration / 16);
        var current = 0;
        var timer = setInterval(function() {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(current).toLocaleString('fr-FR') + (el.dataset.suffix || '');
        }, 16);
    }

    // ── HERO PAGE D'ACCUEIL ─────────────────────────────────
    function initHeroStats() {
        var pageHeader = document.querySelector('#page-site-index #page-header');
        if (!pageHeader || pageHeader.querySelector('.hero-stats-bar')) return;

        var statsBar = document.createElement('div');
        statsBar.className = 'hero-stats-bar';
        statsBar.innerHTML = [
            '<div class="hero-stat-item"><span class="hero-stat-num" data-target="3000" data-suffix="+">&nbsp;</span><span class="hero-stat-lbl">Étudiants</span></div>',
            '<div class="hero-stat-item"><span class="hero-stat-num" data-target="25" data-suffix="+">&nbsp;</span><span class="hero-stat-lbl">Programmes</span></div>',
            '<div class="hero-stat-item"><span class="hero-stat-num" data-target="94" data-suffix="%">&nbsp;</span><span class="hero-stat-lbl">Insertion pro</span></div>',
            '<div class="hero-stat-item"><span class="hero-stat-num" data-target="42" data-suffix="">&nbsp;</span><span class="hero-stat-lbl">Pays partenaires</span></div>'
        ].join('');

        var cta = document.createElement('div');
        cta.style.textAlign = 'center';
        cta.innerHTML = '<a href="/course/" class="hero-cta-btn">Découvrir les programmes</a>';

        pageHeader.appendChild(statsBar);
        pageHeader.appendChild(cta);

        setTimeout(function() {
            statsBar.querySelectorAll('.hero-stat-num').forEach(function(el) {
                animateCounter(el, parseInt(el.dataset.target, 10), 1800);
            });
        }, 400);
    }

    // ── NUMÉROS CHAPITRE DRAWER ─────────────────────────────
    function injectChapterNumbersDrawer() {
        document.querySelectorAll('.courseindex .courseindex-section').forEach(function(section, idx) {
            var title = section.querySelector('.courseindex-sectiontitle, .courseindex-link, .courseindex-name');
            if (!title || title.querySelector('.ecl-chapter-num')) return;
            var num = document.createElement('span');
            num.className = 'ecl-chapter-num';
            num.textContent = idx.toString().padStart(2, '0');
            title.insertBefore(num, title.firstChild);
        });
    }

    // ── NUMÉROS DE SECTION (contenu principal) ──────────────
    function injectChapterNumbersMain() {
        document.querySelectorAll('.course-content li.section.main, .course-content > ul > li.section').forEach(function(section, idx) {
            var nameEl = section.querySelector('.sectionname, .section-header h3, .section-title-action');
            if (!nameEl || nameEl.querySelector('.ecl-section-num')) return;
            var num = document.createElement('span');
            num.className = 'ecl-section-num';
            num.textContent = idx.toString().padStart(2, '0');
            nameEl.insertBefore(num, nameEl.firstChild);
        });
    }

    // ── DÉCOR TUILES (couleur cyclique + emoji + dots) ──────
    function decorateTiles() {
        var sections = document.querySelectorAll('.course-content li.section.main, .course-content > ul > li.section');
        sections.forEach(function(section, idx) {
            if (section.dataset.tilecolor) return;
            // Color cycle (skip section 0 visually if you want — here we cycle from idx)
            section.dataset.tilecolor = (idx % TILE_COUNT).toString();

            // Watermark emoji
            if (!section.querySelector('.ecl-tile-emoji')) {
                var em = document.createElement('span');
                em.className = 'ecl-tile-emoji';
                em.textContent = TILE_EMOJIS[idx % TILE_EMOJIS.length];
                section.appendChild(em);
            }

            // Stats badge (activity count)
            var activities = section.querySelectorAll('.activity-item, li.activity');
            var done = section.querySelectorAll('.activity-item.completed, li.activity.completed').length;
            if (!section.querySelector('.ecl-tile-stats') && activities.length) {
                var stats = document.createElement('span');
                stats.className = 'ecl-tile-stats';
                stats.innerHTML = '<i class="fa fa-layer-group"></i> ' + activities.length + ' activités';
                section.appendChild(stats);
            }

            // Progress dots
            if (!section.querySelector('.ecl-tile-dots') && activities.length) {
                var dots = document.createElement('div');
                dots.className = 'ecl-tile-dots';
                for (var i = 0; i < activities.length; i++) {
                    var dot = document.createElement('span');
                    dot.className = 'ecl-tile-dot' + (i < done ? ' done' : '');
                    dots.appendChild(dot);
                }
                section.appendChild(dots);
            }

            // Banner div inside (used in expanded state for gradient header)
            if (!section.querySelector('.ecl-tile-banner')) {
                var banner = document.createElement('div');
                banner.className = 'ecl-tile-banner';
                section.insertBefore(banner, section.firstChild);
            }
        });
    }

    // ── TOGGLE LISTE / TUILES ────────────────────────────────
    function initViewToggle() {
        // Only on course pages
        if (!document.body.classList.contains('path-course-view')) return;

        var regionMain = document.querySelector('#region-main') || document.querySelector('[role="main"]');
        if (!regionMain) return;

        // Find the course content list to know if we have sections
        var hasSections = document.querySelectorAll('.course-content li.section.main, .course-content > ul > li.section').length > 0;
        if (!hasSections) return;

        // Avoid duplicate toggle
        if (document.querySelector('.ecl-view-toggle')) return;

        var toggle = document.createElement('div');
        toggle.className = 'ecl-view-toggle';
        toggle.innerHTML =
            '<button type="button" data-view="list"><i class="fa fa-list-ul"></i> Liste</button>' +
            '<button type="button" data-view="tiles"><i class="fa fa-table-cells-large"></i> Tuiles</button>';

        // Insert at the very top of region-main
        var insertionPoint = regionMain.querySelector('.secondary-navigation, h1, .page-header-headings');
        if (insertionPoint && insertionPoint.parentNode) {
            insertionPoint.parentNode.insertBefore(toggle, insertionPoint.nextSibling);
        } else {
            regionMain.insertBefore(toggle, regionMain.firstChild);
        }

        // Restore saved view
        var saved = null;
        try { saved = localStorage.getItem('ecl_view_pref'); } catch(e) {}
        applyView(saved === 'tiles' ? 'tiles' : 'list', toggle);

        toggle.addEventListener('click', function(e) {
            var btn = e.target.closest('button[data-view]');
            if (!btn) return;
            var view = btn.dataset.view;
            applyView(view, toggle);
            try { localStorage.setItem('ecl_view_pref', view); } catch(e) {}
        });
    }

    function applyView(view, toggle) {
        toggle.querySelectorAll('button').forEach(function(b) {
            b.classList.toggle('active', b.dataset.view === view);
        });
        document.body.classList.toggle('ecl-view-tiles', view === 'tiles');
        document.body.classList.remove('has-open-tile');
        // Close any open tile when switching
        document.querySelectorAll('.ecl-tile-open').forEach(function(t) {
            t.classList.remove('ecl-tile-open');
            var back = t.querySelector('.ecl-tile-back');
            if (back) back.remove();
        });
        if (view === 'tiles') decorateTiles();
    }

    // ── CLICK TUILE → ouvrir / fermer ───────────────────────
    function initTileClick() {
        document.addEventListener('click', function(e) {
            if (!document.body.classList.contains('ecl-view-tiles')) return;

            // Back button
            var backBtn = e.target.closest('.ecl-tile-back');
            if (backBtn) {
                e.preventDefault();
                e.stopPropagation();
                var openTile = document.querySelector('.ecl-tile-open');
                if (openTile) {
                    openTile.classList.remove('ecl-tile-open');
                    backBtn.remove();
                    document.body.classList.remove('has-open-tile');
                    openTile.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return;
            }

            // Don't trigger when user clicks on an actual activity link inside an expanded tile
            if (e.target.closest('.ecl-tile-open .activity-item')) return;
            if (e.target.closest('.ecl-tile-open a')) return;

            var tile = e.target.closest('li.section.main, .course-content > ul > li.section');
            if (!tile) return;
            if (tile.classList.contains('ecl-tile-open')) return; // already open

            e.preventDefault();

            // Close any other open tile
            document.querySelectorAll('.ecl-tile-open').forEach(function(t) {
                t.classList.remove('ecl-tile-open');
                var b = t.querySelector('.ecl-tile-back');
                if (b) b.remove();
            });

            tile.classList.add('ecl-tile-open');
            document.body.classList.add('has-open-tile');

            // Inject back button if missing
            if (!tile.querySelector('.ecl-tile-back')) {
                var back = document.createElement('button');
                back.type = 'button';
                back.className = 'ecl-tile-back';
                back.innerHTML = '<i class="fa fa-arrow-left"></i> Retour aux tuiles';
                tile.insertBefore(back, tile.firstChild.nextSibling);
            }

            setTimeout(function() {
                tile.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        });
    }

    // ── PROGRESS BAR COURS ──────────────────────────────────
    function injectCourseProgress() {
        if (!document.body.classList.contains('path-course-view') &&
            !document.body.classList.contains('path-course')) return;
        var header = document.querySelector('#page-header');
        if (!header || header.querySelector('.ecl-course-progress')) return;

        var pct = null;
        var nativeProgress = document.querySelector('.progress-bar[aria-valuenow], [data-progress-percent]');
        if (nativeProgress) {
            pct = parseInt(nativeProgress.getAttribute('aria-valuenow') || nativeProgress.dataset.progressPercent, 10);
        }
        if (isNaN(pct) || pct === null) {
            var total = document.querySelectorAll('.activity-item, li.activity').length;
            var done = document.querySelectorAll('.activity-item.completed, li.activity.completed').length;
            pct = total > 0 ? Math.round((done / total) * 100) : 0;
        }

        var wrap = document.createElement('div');
        wrap.className = 'ecl-course-progress';
        wrap.innerHTML =
            '<span class="ecl-course-progress-label">Progression</span>' +
            '<div class="ecl-course-progress-bar"><div class="ecl-course-progress-fill" style="width:0%"></div></div>' +
            '<span class="ecl-course-progress-pct">0%</span>';
        header.appendChild(wrap);

        setTimeout(function() {
            wrap.querySelector('.ecl-course-progress-fill').style.width = pct + '%';
            var label = wrap.querySelector('.ecl-course-progress-pct');
            label.dataset.suffix = '%';
            animateCounter(label, pct, 1200);
        }, 300);
    }

    // ── COMPLÉTION VISUELLE AUTO ────────────────────────────
    function markCompletedActivities() {
        document.querySelectorAll('.activity-item, li.activity').forEach(function(item) {
            if (item.classList.contains('completed')) return;
            var done = item.querySelector('[data-region="completion-icon"][data-value="1"], .autocompletion img[alt*="Terminé"], .autocompletion img[alt*="Complete"], .completion-icon.completed');
            if (done) item.classList.add('completed');
        });
    }

    // ── PROGRESS CIRCLE ─────────────────────────────────────
    function initProgressCircles() {
        document.querySelectorAll('.progress-circle[data-pct]').forEach(function(c) {
            c.style.setProperty('--pct', parseInt(c.dataset.pct, 10) + '%');
        });
    }

    // ── SCROLL REVEAL ───────────────────────────────────────
    function initScrollReveal() {
        if (!('IntersectionObserver' in window)) return;
        var targets = document.querySelectorAll('.formation-card, .h-card, .activity-item, .dashboard-stat-card');
        if (!targets.length) return;
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.style.opacity = '1';
                    e.target.style.transform = '';
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        targets.forEach(function(t) {
            t.style.opacity = '0';
            t.style.transform = 'translateY(14px)';
            t.style.transition = 'opacity 0.5s ease, transform 0.5s ease, box-shadow 0.25s ease';
            obs.observe(t);
        });
    }

    function ready() {
        initHeroStats();
        initProgressCircles();
        markCompletedActivities();
        injectChapterNumbersDrawer();
        injectChapterNumbersMain();
        injectCourseProgress();
        initViewToggle();
        initTileClick();
        initScrollReveal();
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ready);
    } else {
        ready();
    }

})();
