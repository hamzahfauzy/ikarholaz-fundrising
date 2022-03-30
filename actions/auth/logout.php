<?php

Session::destroy();
header('location:index.php?r=auth/login');
die();