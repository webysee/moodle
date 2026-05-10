// theme_ecl — JS premium (hero animé + dashboard helpers)
// Inspired by boost_universite, adapted to ECL Abidjan.

(function() {
    'use strict';

    // ── COMPTEURS ANIMÉS ────────────────────────────────────
    function animateCounter(el, target, duration) {
        var start = 0;
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
            var counters = statsBar.querySelectorAll('.hero-stat-num');
            counters.forEach(function(el) {
                var target = parseInt(el.dataset.target, 10);
                animateCounter(el, target, 1800);
            });
        }, 400);
    }

    // ── BARRES DE PROGRESSION CERCLE (dashboard) ────────────
    function initProgressCircles() {
        var circles = document.querySelectorAll('.progress-circle[data-pct]');
        circles.forEach(function(circle) {
            var pct = parseInt(circle.dataset.pct, 10);
            circle.style.setProperty('--pct', pct + '%');
        });
    }

    // ── INIT ────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        initHeroStats();
        initProgressCircles();
    });

})();
