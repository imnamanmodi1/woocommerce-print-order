<?php

// get "wcpo" data and include template
if ($_GET['wcpo_data']) {
    $wcpo_template_json = urldecode($_GET['wcpo_data']);
    $wcpo_template_data = json_decode($wcpo_template_json);

    include_once('../templates/templates-print-content.php');
}