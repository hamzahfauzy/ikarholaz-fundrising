<?php

Session::destroy();
header('location:'.routeTo().'auth/login');
die();