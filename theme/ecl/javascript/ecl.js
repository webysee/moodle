// theme_ecl — JS premium
// - Hero animé sur page d'accueil
// - Numéros de chapitre auto sur sections de cours
// - Barre de progression cours
// - Animations de complétion
// Inspired by Coursera / Klass / OpenClassrooms UX.

(function() {
    'use strict';

    // ── COMPTEURS ANIMÉS ────────────────────────────────────
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

    // ── HERO PAGE D'ACCUEIL — Injection auto ────────────────
    function initHeroStats() {
        var pageHeader = document.querySelector('#page-site-index #page-header');
        if (!pageHeader) return;
        if (pageHeader.querySelector('.hero-stats-bar')) return;

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

    // ── NUMÉROS DE CHAPITRE DANS LE DRAWER ──────────────────
    function injectChapterNumbersDrawer() {
        var sections = document.querySelectorAll('.courseindex .courseindex-section');
        if (!sections.length) return;
        sections.forEach(function(section, idx) {
            var title = section.querySelector('.courseindex-sectiontitle, .courseindex-link, .courseindex-name');
            if (!title || title.querySelector('.ecl-chapter-num')) return;

            var num = document.createElement('span');
            num.className = 'ecl-chapter-num';
            num.textContent = (idx).toString().padStart(2, '0');
            title.insertBefore(num, title.firstChild);
        });
    }

    // ── NUMÉROS DE CHAPITRE SUR LE CONTENU DU COURS ─────────
    function injectChapterNumbersMain() {
        var sections = document.querySelectorAll('.course-content li.section.main, .course-content > ul > li.section');
        if (!sections.length) return;

        sections.forEach(function(section, idx) {
            var nameEl = section.querySelector('.sectionname, .section-header h3, .section-title-action');
            if (!nameEl || nameEl.querySelector('.ecl-section-num')) return;

            var num = document.createElement('span');
            num.className = 'ecl-section-num';
            // Idx 0 = "Général" (section 0) → on l'affiche aussi
            num.textContent = (idx).toString().padStart(2, '0');
            nameEl.insertBefore(num, nameEl.firstChild);
        });
    }

    // ── BARRE DE PROGRESSION DU COURS ───────────────────────
    function injectCourseProgress() {
        // S'applique uniquement aux pages de cours
        if (!document.body.classList.contains('path-course-view') &&
            !document.body.classList.contains('path-course')) return;

        var header = document.querySelector('#page-header');
        if (!header) return;
        if (header.querySelector('.ecl-course-progress')) return;

        // Cherche un % de progression natif Moodle (block_completion_progress, etc.)
        var pct = null;
        var nativeProgress = document.querySelector('.progress-bar[aria-valuenow], [data-progress-percent]');
        if (nativeProgress) {
            pct = parseInt(nativeProgress.getAttribute('aria-valuenow') || nativeProgress.dataset.progressPercent, 10);
        }
        if (isNaN(pct) || pct === null) {
            // Estime via activités complétées
            var total = document.querySelectorAll('.activity-item, li.activity').length;
            var done = document.querySelectorAll('.activity-item.completed, li.activity.completed').length;
            if (total > 0) {
                pct = Math.round((done / total) * 100);
            } else {
                pct = 0;
            }
        }

        var wrap = document.createElement('div');
        wrap.className = 'ecl-course-progress';
        wrap.innerHTML =
            '<span class="ecl-course-progress-label">Progression</span>' +
            '<div class="ecl-course-progress-bar"><div class="ecl-course-progress-fill" style="width:0%"></div></div>' +
            '<span class="ecl-course-progress-pct">0%</span>';
        header.appendChild(wrap);

        // Anim
        setTimeout(function() {
            var fill = wrap.querySelector('.ecl-course-progress-fill');
            var label = wrap.querySelector('.ecl-course-progress-pct');
            fill.style.width = pct + '%';
            animateCounter(label, pct, 1200);
            label.dataset.suffix = '%';
        }, 300);
    }

    // ── DÉTECTION COMPLÉTION VISUELLE ───────────────────────
    function markCompletedActivities() {
        document.querySelectorAll('.activity-item, li.activity').forEach(function(item) {
            // 1. data-test ou class déjà présents
            if (item.classList.contains('completed')) return;
            // 2. Cherche un indicateur natif (checkmark, "Terminé", etc.)
            var done = item.querySelector('[data-region="completion-icon"][data-value="1"], .autocompletion img[alt*="Terminé"], .autocompletion img[alt*="Complete"], .completion-icon.completed');
            if (done) item.classList.add('completed');
        });
    }

    // ── PROGRESSION CIRCLE (dashboard) ──────────────────────
    function initProgressCircles() {
        document.querySelectorAll('.progress-circle[data-pct]').forEach(function(circle) {
            var pct = parseInt(circle.dataset.pct, 10);
            circle.style.setProperty('--pct', pct + '%');
        });
    }

    // ── REVEAL ON SCROLL (subtil) ───────────────────────────
    function initScrollReveal() {
        if (!('IntersectionObserver' in window)) return;
        var targets = document.querySelectorAll('.formation-card, .h-card, .activity-item, li.section.main, .dashboard-stat-card');
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

    // ── INIT ────────────────────────────────────────────────
    function ready() {
        initHeroStats();
        initProgressCircles();
        markCompletedActivities();
        injectChapterNumbersDrawer();
        injectChapterNumbersMain();
        injectCourseProgress();
        initScrollReveal();
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ready);
    } else {
        ready();
    }

})();
