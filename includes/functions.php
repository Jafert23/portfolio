<?php
// includes/functions.php

function get_project_by_id($projects, $id) {
    foreach ($projects as $project) {
        if ($project['id'] === $id) {
            return $project;
        }
    }
    return null;
}
