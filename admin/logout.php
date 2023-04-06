<?php
session_start();
// destroy
session_destroy();
// redirect to login page
header('Location: ' . base_url(''));
