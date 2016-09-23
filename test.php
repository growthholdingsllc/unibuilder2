<?php
exec('service postfix restart', $output);
echo '<pre>';print_r($output);
