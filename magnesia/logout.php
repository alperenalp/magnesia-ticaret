<?php
require "config.php";
session_destroy();
header("refresh:2, url=index.php");
