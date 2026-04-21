<?= $this->extend('frontend/layouts/landing') ?>

<?= $this->section('content') ?>

<?php foreach ($enabledSections as $section): ?>
    <?= $this->include("frontend/pages/home/sections/{$section}") ?>
<?php endforeach; ?>

<?= $this->endSection() ?>
