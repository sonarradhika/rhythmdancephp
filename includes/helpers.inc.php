<?php
function html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
function htmlout($text) {
    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
function markdownout($text) {
    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); // simple safe fallback
}